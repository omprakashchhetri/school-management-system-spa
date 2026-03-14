<?php
namespace App\Controllers\Data\ExaminationModulePages;

use App\Controllers\BaseController;

class ExaminationController extends BaseController
{
    protected $examsModel;
    protected $examItemsModel;
    protected $classesModel;
    protected $subjectsModel;

    public function __construct()
    {
        $this->examsModel = model('ExamsModel');
        $this->examItemsModel = model('ExamItemsModel');
        $this->classesModel = model('ClassesModel');
        $this->subjectsModel = model('SubjectsModel');
    }

    /**
     * Get all exams (not deleted).
     */
    public function getAllExams()
    {
        $exams = $this->examsModel
            ->where('deleted_at', null)
            ->orderBy('exam_startdate', 'DESC')
            ->findAll();

        return $this->response->setJSON($exams);
    }

     /**
     * Get all exams (not deleted).
     */
    public function getExams()
    {
        $exams = $this->examsModel
            ->where('deleted_at', null)
            ->orderBy('exam_startdate', 'DESC')
            ->findAll();

        return $exams;
    }

    /**
     * Get one exam basic info by ID.
     */
    public function getOneExam()
    {
        $examId = $this->request->getPost('exam_id');

        if (!$examId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam ID is required']);
        }

        $exam = $this->examsModel
            ->where('deleted_at', null)
            ->find($examId);

        if (!$exam) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Exam not found']);
        }

        return $this->response->setJSON($exam);
    }

    /**
     * Get exam items for a specific exam.
     */
    public function getExamItems()
    {
        $examId = $this->request->getPost('exam_id');

        if (!$examId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam ID is required']);
        }

        $items = $this->examItemsModel
            ->where('related_exam', $examId)
            ->where('deleted_at', null)
            ->findAll();

        return $this->response->setJSON($items);
    }

    /**
     * Get exam details with items, classes, and subjects.
     * Used for the exam details page.
     */
    public function getExamDetails()
    {
        $examId = $this->request->getPost('exam_id');

        if (!$examId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam ID is required']);
        }

        // Get exam
        $exam = $this->examsModel
            ->where('deleted_at', null)
            ->find($examId);

        if (!$exam) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Exam not found']);
        }

        // Get exam items
        $examItems = $this->examItemsModel
            ->where('related_exam', $examId)
            ->where('deleted_at', null)
            ->findAll();

        // Get all classes
        $classes = $this->classesModel
            ->where('deleted_at', null)
            ->orderBy('class_name', 'ASC')
            ->findAll();

        // Get all subjects
        $subjects = $this->subjectsModel
            ->where('deleted_at', null)
            ->findAll();

        // Enrich exam items with class and subject names
        foreach ($examItems as &$item) {
            $class = $this->classesModel->find($item['related_class']);
            $subject = $this->subjectsModel->find($item['related_subject']);
            
            $item['class_name'] = $class['class_name'] ?? 'Unknown';
            $item['subject_name'] = $subject['subject_name'] ?? 'Unknown';
        }

        // Add exam items to exam
        $exam['exam_items'] = $examItems;

        return $this->response->setJSON([
            'exam' => $exam,
            'classes' => $classes,
            'subjects' => $subjects
        ]);
    }

    /**
     * Add a new exam (without items). 
     * The methods also handles editing 
     * an existing exam if exam_id is provided in the payload.
     */
    public function addExam()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Invalid input data']);
        }

        // Detect action - check for exam_id instead of id
        $isEdit = !empty($data['exam_id']) && $data['exam_id'] !== '0';
        $examId = $data['exam_id'] ?? null;

        // Validation
        if (empty($data['exam_title'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam title is required']);
        }

        if (empty($data['exam_startdate']) || empty($data['exam_enddate'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Start date and end date are required']);
        }

        if (strtotime($data['exam_startdate']) > strtotime($data['exam_enddate'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Start date must be before end date']);
        }

        // Get user from JWT (set by filter)
        $createdBy = $this->request->user->id ?? null;

        if (!$createdBy) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['error' => 'Unauthorized']);
        }

        // Data to save
        $examData = [
            'exam_title'        => $data['exam_title'],
            'exam_description' => $data['exam_description'] ?? '',
            'exam_startdate'    => $data['exam_startdate'],
            'exam_enddate'      => $data['exam_enddate'],
        ];

        try {

            /* ========== EDIT ========== */
            if ($isEdit) {

                $exam = $this->examsModel->find($examId);

                if (!$exam) {
                    return $this->response
                        ->setStatusCode(404)
                        ->setJSON(['error' => 'Exam not found']);
                }

                // Add updated_at timestamp
                $examData['updated_at'] = date('Y-m-d H:i:s');

                if ($this->examsModel->update($examId, $examData)) {

                    return $this->response
                        ->setStatusCode(200)
                        ->setJSON([
                            'message' => 'Exam updated successfully',
                            'exam_id' => $examId
                        ]);
                }

                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['error' => 'Failed to update exam']);
            }

            /* ========== CREATE ========== */
            else {

                $examData['exam_createdby'] = $createdBy;

                if ($this->examsModel->insert($examData)) {

                    return $this->response
                        ->setStatusCode(201)
                        ->setJSON([
                            'message' => 'Exam created successfully',
                            'exam_id' => $this->examsModel->getInsertID()
                        ]);
                }

                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['error' => 'Failed to create exam']);
            }

        } catch (\Throwable $e) {

            log_message('error', 'AddExam Error: ' . $e->getMessage());

            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'Internal server error']);
        }
    }

    /**
     * Save exam routine (create/update exam items for an exam).
     */
    public function saveExamRoutine()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Invalid input data']);
        }

        if (empty($data['exam_id'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam ID is required']);
        }

        if (empty($data['exam_items']) || !is_array($data['exam_items'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'At least one exam item is required']);
        }

        $examId = $data['exam_id'];

        // Verify exam exists
        $exam = $this->examsModel->find($examId);
        if (!$exam) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Exam not found']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Delete existing exam items for this exam
            $existingItems = $this->examItemsModel
                ->where('related_exam', $examId)
                ->where('deleted_at', null)
                ->findAll();

            foreach ($existingItems as $item) {
                $this->examItemsModel->update($item['id'], [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
            }

            // Insert new exam items
            foreach ($data['exam_items'] as $item) {
                // Validate item fields
                if (
                    empty($item['related_class']) ||
                    empty($item['related_subject']) ||
                    empty($item['exam_date']) ||
                    empty($item['exam_time']) ||
                    empty($item['max_marks'])
                ) {
                    $db->transRollback();
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'All exam item fields are required']);
                }

                // Validate date range
                if (
                    strtotime($item['exam_date']) < strtotime($exam['exam_startdate']) ||
                    strtotime($item['exam_date']) > strtotime($exam['exam_enddate'])
                ) {
                    $db->transRollback();
                    return $this->response
                        ->setStatusCode(400)
                        ->setJSON(['error' => 'Exam date must be within exam date range']);
                }

                $itemData = [
                    'related_exam'    => $examId,
                    'related_subject' => $item['related_subject'],
                    'related_class'   => $item['related_class'],
                    'exam_date'       => $item['exam_date'],
                    'exam_time'       => $item['exam_time'],
                    'max_marks'       => $item['max_marks'],
                    'question_paper'  => $item['question_paper'] ?? null
                ];

                if (!$this->examItemsModel->insert($itemData)) {
                    $db->transRollback();
                    return $this->response
                        ->setStatusCode(500)
                        ->setJSON(['error' => 'Failed to save exam item']);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['error' => 'Transaction failed']);
            }

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'message' => 'Exam routine saved successfully',
                    'exam_id' => $examId
                ]);

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error saving routine: ' . $e->getMessage());
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'An internal server error occurred']);
        }
    }

    /**
     * Delete exam (soft delete).
     */
    public function deleteExam()
    {
        $examId = $this->request->getPost('exam_id');

        if (!$examId) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Exam ID is required']);
        }

        $exam = $this->examsModel->find($examId);
        if (!$exam) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Exam not found']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Soft delete exam
            $this->examsModel->update($examId, [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            // Soft delete related exam items
            $examItems = $this->examItemsModel
                ->where('related_exam', $examId)
                ->where('deleted_at', null)
                ->findAll();

            foreach ($examItems as $item) {
                $this->examItemsModel->update($item['id'], [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON(['error' => 'Transaction failed']);
            }

            return $this->response->setJSON([
                'message' => 'Exam deleted successfully'
            ]);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error deleting exam: ' . $e->getMessage());
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['error' => 'An error occurred while deleting exam']);
        }
    }
}