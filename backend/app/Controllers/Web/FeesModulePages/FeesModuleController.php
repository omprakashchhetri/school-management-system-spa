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
    public function slabList() {
        $classesData = $this->classesController->getAll();
        $sectionList = $this->sectionsController->getAll();
        $passToView = [
            'classes' => $classesData,
            'sections' => $sectionList,
        ];
        // return view('pages/admin-module-pages/role-tool-management', ['roleToolManagement' => $roleToolManagement]);
        return view('templates/sidebar-fees')
            .  view('templates/topbar')
            .  view('pages/fees-module-pages/slab-list', $passToView)
        ;
    }
    public function getFeesSlabList()
    {
        $postData = $this->request->getPost();

        return $this->feesManagementController->getFeesSlabList($postData);
    }

    public function addFeesSlab() {
        $details = $this->request->getPost();
        return json_encode($this->feesManagementController->addFeesSlab($details));
    }

    public function editFeesSlab() {
        $details = $this->request->getPost();
        return json_encode($this->feesManagementController->editFeesSlab($details));
    }

    public function deleteFeesSlab() {
        $SubjectId = $this->request->getPost('id');
        return json_encode($this->feesManagementController->deleteFeesSlab($SubjectId));
    }
    
}