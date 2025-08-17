<?php

namespace App\Controllers\Data\AdminModulePages;

use App\Controllers\BaseController;
use App\Libraries\JwtHandler;

class AdminRoleManagementController extends BaseController
{
    protected $paginationLimit;
    public function __construct(){
        $this->paginationLimit = getenv('PAGINATION_LIMIT');
    }

    public function getListOfRoles($offset=0) {
        $roleModel = model('RolesModel');
        $listOfRoles = $roleModel->findAll($this->paginationLimit, $offset);
        return $listOfRoles;
    }
}