<?php

namespace App\Controllers\Web\FeesModulePages;

use App\Controllers\BaseController;
use App\Controllers\Data\AdminModulePages\SectionsController;
use App\Controllers\Data\AdminModulePages\ClassesController;
use App\Controllers\Data\AdminModulePages\FeesManagementController;

class FeesModuleController extends BaseController
{

    protected $classesController;
    protected $sectionsController;
    protected $feesManagementController;

    public function __construct()
    {
        $this->sectionsController = new SectionsController();
        $this->classesController = new ClassesController();
        $this->feesManagementController = new FeesManagementController();
    }

    /* =====================================================
       FEES SLAB LIST PAGE
    ===================================================== */
    public function slabList()
    {

        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();

        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
        ];

        return view('templates/sidebar-fees')
            . view('templates/topbar')
            . view('pages/fees-module-pages/slab-list', $passToView);
    }



    /* =====================================================
       FEES PAYMENT TRANSACTION PAGE
    ===================================================== */
    public function feesPaymentsList()
    {

        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();

        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
        ];

        return view('templates/sidebar-fees')
            . view('templates/topbar')
            . view('pages/fees-module-pages/fees-payments-list', $passToView);
    }



    /* =====================================================
       FEES SLAB DATATABLE
    ===================================================== */
    public function getFeesSlabList()
    {
        $postData = $this->request->getPost();

        return $this->feesManagementController->getFeesSlabList($postData);
    }



    /* =====================================================
       ADD FEES SLAB
    ===================================================== */
    public function addFeesSlab()
    {
        $details = $this->request->getPost();

        return json_encode(
            $this->feesManagementController->addFeesSlab($details)
        );
    }



    /* =====================================================
       EDIT FEES SLAB
    ===================================================== */
    public function editFeesSlab()
    {
        $details = $this->request->getPost();

        return json_encode(
            $this->feesManagementController->editFeesSlab($details)
        );
    }



    /* =====================================================
       DELETE FEES SLAB
    ===================================================== */
    public function deleteFeesSlab()
    {
        $id = $this->request->getPost('id');

        return json_encode(
            $this->feesManagementController->deleteFeesSlab($id)
        );
    }



    /* =====================================================
       GET SECTIONS BY CLASS
    ===================================================== */
    public function getSectionsByClass()
    {
        $classId = $this->request->getPost('class_id');

        return json_encode(
            $this->feesManagementController->getSectionsByClass($classId)
        );
    }



    /* =====================================================
       GET STUDENTS BY CLASS + SECTION
    ===================================================== */
    public function getStudentsByClassSection()
    {

        $classId = $this->request->getPost('class_id');
        $sectionId = $this->request->getPost('section_id');

        return json_encode(
            $this->feesManagementController
                ->getStudentsByClassSection($classId, $sectionId)
        );
    }



    /* =====================================================
       GET STUDENT FEES LEDGER
    ===================================================== */
    public function getStudentFeesLedger()
    {

        $studentId = $this->request->getPost('student_id');

        return json_encode(
            $this->feesManagementController
                ->getStudentFeesLedger($studentId)
        );
    }



    /* =====================================================
       RECORD PAYMENT
    ===================================================== */
    public function recordPayment()
    {

        $postData = $this->request->getPost();

        return json_encode(
            $this->feesManagementController
                ->recordPayment($postData)
        );
    }

    public function generateFees()
    {
        $data = $this->request->getPost();

        return json_encode(
            $this->feesManagementController->generateFees($data)
        );
    }
    
    /* =====================================================
    FEE RECEIPT PAGE (Public)
    Access: /fees/receipt/6  OR  /fees/receipt?payment_id=6
    ===================================================== */
    public function feeReceipt($paymentId = null)
    {
        // Accept from URI segment or query string
        $paymentId = $paymentId ?? $this->request->getGet('payment_id');

        if (!$paymentId || !is_numeric($paymentId)) {
            return redirect()->to('/')->with('error', 'Invalid receipt reference.');
        }

        $result = $this->feesManagementController->getReceiptData((int) $paymentId);

        if (isset($result['error'])) {
            return redirect()->to('/')->with('error', $result['error']);
        }

        return view('pages/fees-module-pages/fee_receipt', $result);
    }

    /* =====================================================
    FEES GENERATION LIST PAGE
    ===================================================== */
    public function feesGenerationList()
    {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();

        $passToView = [
            'classes'  => $classesData,
            'sections' => $sectionList,
        ];

        return view('templates/sidebar-fees')
            . view('templates/topbar')
            . view('pages/fees-module-pages/fees-generation-list', $passToView);
    }


    /* =====================================================
    FEES GENERATION DATATABLE
    ===================================================== */
    public function getFeesGenerationList()
    {
        $postData = $this->request->getPost();

        return $this->feesManagementController->getFeesGenerationList($postData);
    }

}