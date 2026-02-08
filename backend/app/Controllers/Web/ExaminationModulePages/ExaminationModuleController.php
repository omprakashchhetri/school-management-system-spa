<?php
namespace App\Controllers\Web\ExaminationModulePages;

use App\Controllers\BaseController;
use App\Controllers\Data\ExaminationModulePages\ExaminationController;
use App\Controllers\Data\AdminModulePages\ClassesController;
use App\Controllers\Data\AdminModulePages\SubjectsController;

class ExaminationModuleController extends BaseController
{
    protected $examinationController;
    protected $classesController;
    protected $subjectsController;

    public function __construct()
    {
        $this->examinationController = new ExaminationController();
        $this->classesController = new ClassesController();
        $this->subjectsController = new SubjectsController();
    }

    /**
     * Display create exam routine page.
     */
    public function create_exam_routine()
    {
        $classes = $this->classesController->getAll();
        $subjects = $this->subjectsController->getAll();

        return view('templates/sidebar-academic')
            . view('templates/topbar')
            . view('pages/examination-module-pages/create-exam-routine', [
                'classes' => $classes,
                'subjects' => $subjects
            ]);
    }

    /**
     * Display exam details page.
     *
     * @param int $id - Exam ID from URL segment
     */
    public function exam_details($id)
    {
        // Validate exam ID
        if (!$id || !is_numeric($id)) {
            return redirect()->to('examination/exam-list')->with('error', 'Invalid exam ID');
        }

        // Get exam basic info to check if exists
        $exam = model('ExamsModel')->where('deleted_at', null)->find($id);
        
        if (!$exam) {
            return redirect()->to('examination/exam-list')->with('error', 'Exam not found');
        }

        // Pass exam data to view (detailed data will be loaded via AJAX)
        return view('templates/sidebar-academic')
            . view('templates/topbar')
            . view('pages/examination-module-pages/exam-details', [
                'examDetails' => ['exam' => $exam]
            ]);
    }

    /**
     * Display edit exam routine page.
     *
     * @param int $id
     */
    public function edit_exam_routine($id)
    {
    

        // Get exam
        $exam = model('ExamsModel')->where('deleted_at', null)->find($id);
        
        if (!$exam) {
            return redirect()->to('examination/exam-list')->with('error', 'Exam not found');
        }

        $classes = $this->classesController->getAll();
        $subjects = $this->subjectsController->getAll();

        return view('templates/sidebar-academic')
            . view('templates/topbar')
            . view('pages/examination-module-pages/create-exam-routine', [
                'exam' => $exam,
                'classes' => $classes,
                'subjects' => $subjects
            ]);
    }

    /**
     * Display exam list page.
     */
    public function exam_list()
    {
        $exams = $this->examinationController->getExams();

        return view('templates/sidebar-academic')
            . view('templates/topbar')
            . view('pages/examination-module-pages/exam-list', [
                'exams' => $exams
            ]);
    }
}