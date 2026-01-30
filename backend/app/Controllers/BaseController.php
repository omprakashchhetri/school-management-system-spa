<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;

/**
 * BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $helpers = [];

    protected $adminRoleManagementController;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->adminRoleManagementController = new AdminRoleManagementController();

        /* -----------------------------------------
           Inject role permissions for EMPLOYEES only
        ----------------------------------------- */
        if (isset($request->user)) {

            if ($request->user->loginType !== 'employee') {
                return;
            }

            // employee record already resolved by filter
            $employee = $request->user->record;

            if (!isset($employee['role_id'])) {
                return;
            }

            $roleToolPermissions = $this->getRoleToolPermissions(
                (int) $employee['role_id']
            );

            service('renderer')->setVar(
                'roleToolPermissions',
                $roleToolPermissions
            );
        }
    }

    /**
     * Get role tool permissions by role ID
     */
    protected function getRoleToolPermissions(int $roleId)
    {
        return $this->adminRoleManagementController->getOne($roleId);
    }
}
