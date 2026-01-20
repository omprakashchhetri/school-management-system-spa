<?php

namespace App\Controllers\Web\ExaminationModulePages;
use App\Controllers\BaseController;

class ExaminationModuleController extends BaseController
{

    public function create_exam_routine() {
        return view('templates/sidebar-employee')
            .  view('templates/topbar')
            .  view('pages/examination-module-pages/create-exam-routine')
        ;
    }
    
}