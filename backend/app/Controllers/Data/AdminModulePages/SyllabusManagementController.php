<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Models\SyllabusModel;

class SyllabusManagementController extends BaseController
{
    protected $syllabusModel;

    public function __construct()
    {
        $this->syllabusModel = new SyllabusModel();
    }

    public function getSyllabusList(array $postData)
    {
        $draw = intval($postData['draw']);
        $start = intval($postData['start']);
        $length = intval($postData['length']);
        $searchValue = $postData['search']['value'] ?? '';

        /* -------------------------------------------------
           Base Query with ALL required fields
        ------------------------------------------------- */
        $builder = $this->syllabusModel->builder()
            ->select([
                'syllabus.id',
                'syllabus.related_class',
                'syllabus.related_section',
                'syllabus.related_subject',
                'syllabus.related_teacher',
                'syllabus.description',
                'syllabus.uploaded_syllabus_file',
                'syllabus.created_at',

                'c.class_name',
                'sec.section_label',
                'sub.subject_name',
                'emp.firstname AS teacher_firstname',
                'emp.lastname AS teacher_lastname'
            ])
            ->join('classes c', 'c.id = syllabus.related_class', 'left')
            ->join('sections sec', 'sec.id = syllabus.related_section', 'left')
            ->join('subjects sub', 'sub.id = syllabus.related_subject', 'left')
            ->join('employees emp', 'emp.id = syllabus.related_teacher', 'left')
            ->where('syllabus.deleted_at', null);

        /* -------------------------------------------------
           Clone BEFORE pagination (important!)
        ------------------------------------------------- */
        $countBuilder = clone $builder;

        /* -------------------------------------------------
           Searching
        ------------------------------------------------- */
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('c.class_name', $searchValue)
                ->orLike('sec.section_label', $searchValue)
                ->orLike('sub.subject_name', $searchValue)
                ->orLike('emp.firstname', $searchValue)
                ->orLike('emp.lastname', $searchValue)
                ->groupEnd();
        }

        /* -------------------------------------------------
           Ordering (DataTables index based)
        ------------------------------------------------- */
        if (isset($postData['order'][0])) {

            $columns = [
                'syllabus.id',
                'c.class_name',
                'sec.section_label',
                'sub.subject_name',
                'emp.firstname',
                'syllabus.uploaded_syllabus_file',
                'syllabus.created_at'
            ];

            $colIndex = $postData['order'][0]['column'];
            $colDir = $postData['order'][0]['dir'];

            if (isset($columns[$colIndex])) {
                $builder->orderBy($columns[$colIndex], $colDir);
            }

        } else {
            $builder->orderBy('syllabus.id', 'DESC');
        }

        /* -------------------------------------------------
           Pagination
        ------------------------------------------------- */
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        /* -------------------------------------------------
           Fetch Records
        ------------------------------------------------- */
        $records = $builder->get()->getResult();

        /* -------------------------------------------------
           Counts (DataTables requirement)
        ------------------------------------------------- */
        $recordsFiltered = $countBuilder->countAllResults();
        $recordsTotal = $this->syllabusModel
            ->where('deleted_at', null)
            ->countAllResults();

        /* -------------------------------------------------
           Prepare DataTables Rows
        ------------------------------------------------- */
        $data = [];

        foreach ($records as $row) {

            $teacherName = trim($row->teacher_firstname . ' ' . $row->teacher_lastname);
            $fileUrl = base_url('uploads/syllabus/' . $row->uploaded_syllabus_file);

            $data[] = [
                'checkbox' => '<input type="checkbox" value="' . $row->id . '" class="form-check-input">',

                'class' => '<span class="h6 mb-0 fw-medium text-gray-300">' . $row->class_name . '</span>',
                'section' => '<span class="h6 mb-0 fw-medium text-gray-300">' . $row->section_label . '</span>',
                'subject' => '<span class="h6 mb-0 fw-medium text-gray-300">' . $row->subject_name . '</span>',
                'teacher' => '<span class="h6 mb-0 fw-medium text-gray-300">' . $teacherName . '</span>',

                'file' => '<a href="' . $fileUrl . '" target="_blank" class="text-main-600">
                        View File
                       </a>',

                'created_at' => '<span class="h6 mb-0 fw-medium text-gray-300">'
                    . date('M d, Y', strtotime($row->created_at)) .
                    '</span>',

                'actions' => '
                <button 
                    class="edit-syllabus-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill"

                    data-id="' . $row->id . '"
                    data-class-id="' . $row->related_class . '"
                    data-section-id="' . $row->related_section . '"
                    data-subject-id="' . $row->related_subject . '"
                    data-teacher-id="' . $row->related_teacher . '"
                    data-description="' . esc($row->description, 'attr') . '">
                    Edit
                </button>

                <button 
                    data-id="' . $row->id . '" 
                    class="delete-syllabus-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill">
                    Delete
                </button>
            '
            ];
        }

        /* -------------------------------------------------
           Final DataTables JSON
        ------------------------------------------------- */
        return service('response')->setJSON([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }
    public function addSyllabus(array $data): array
    {
        $file = service('request')->getFile('syllabus_file');

        if (!$file || !$file->isValid()) {
            return ['error' => 'Syllabus file is required'];
        }

        $newName = $file->getRandomName();
        $uploadPath = WRITEPATH . '../public/uploads/syllabus';

        if (!$file->move($uploadPath, $newName)) {
            return ['error' => 'Failed to upload syllabus file'];
        }

        $insertData = [
            'related_class' => $data['class_id'],
            'related_section' => $data['section_id'],
            'related_subject' => $data['subject_id'],
            'related_teacher' => $data['teacher_id'],
            'uploaded_syllabus_file' => $newName,
            'description' => $data['description'] ?? null
        ];

        if ($this->syllabusModel->insert($insertData)) {
            return ['message' => 'Syllabus added successfully'];
        }

        return ['error' => 'Failed to add syllabus'];
    }


    public function editSyllabus(array $data): array
    {
        $id = $data['id'] ?? null;
        if (!$id)
            return ['error' => 'Syllabus ID required'];

        $record = $this->syllabusModel->find($id);
        if (!$record)
            return ['error' => 'Syllabus not found'];

        $updateData = [
            'related_class' => $data['class_id'],
            'related_section' => $data['section_id'],
            'related_subject' => $data['subject_id'],
            'related_teacher' => $data['teacher_id'],
            'description' => $data['description'] ?? null
        ];

        $file = service('request')->getFile('syllabus_file');

        if ($file && $file->isValid()) {

            $newName = $file->getRandomName();
            $uploadPath = WRITEPATH . '../public/uploads/syllabus';

            if (!$file->move($uploadPath, $newName)) {
                return ['error' => 'Failed to upload syllabus file'];
            }

            // Delete old file
            if (!empty($record['uploaded_syllabus_file'])) {
                $oldFile = $uploadPath . '/' . $record['uploaded_syllabus_file'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $updateData['uploaded_syllabus_file'] = $newName;
        }

        if ($this->syllabusModel->update($id, $updateData)) {
            return ['message' => 'Syllabus updated successfully'];
        }

        return ['error' => 'Failed to update syllabus'];
    }


    public function deleteSyllabus($id): array
    {
        if (!$id)
            return ['error' => 'Syllabus ID required'];

        $record = $this->syllabusModel->find($id);
        if (!$record)
            return ['error' => 'Syllabus not found'];

        // Soft delete
        $this->syllabusModel->update($id, [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        // Optional: delete file
        if (!empty($record['uploaded_syllabus_file'])) {
            $filePath = WRITEPATH . '../public/uploads/syllabus/' . $record['uploaded_syllabus_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return ['message' => 'Syllabus deleted successfully'];
    }

}
