<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\EmployeesModel;
use App\Controllers\Data\AdminModulePages\AdminRoleManagementController;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    protected $employeesModel;
    protected $adminRoleManagementController;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Existing initializations
        $this->employeesModel = new EmployeesModel();
        $this->adminRoleManagementController = new AdminRoleManagementController();

        // ✅ ADD THIS
        if(isset($request->user)){
            if(strtolower($request->user->data->data->loginType) !== 'employee'){
                return;
            }
            $roleToolPermissions = $this->getRoleToolPermissions();
            service('renderer')->setVar('roleToolPermissions', $roleToolPermissions);
        }
    }


    public function getRoleToolPermissions()
    {
        $header = $this->request->getHeaderLine('Authorization');
        $authToken = str_replace('Bearer ', '', $header);
        $employee = $this->employeesModel
            ->select('id, role_id')
            ->where('issued_jwt_token', $authToken)
            ->where('deleted_at', null)
            ->first();
        $roleToolPermissions = $this->adminRoleManagementController->getOne((int) $employee['role_id']);
        return $roleToolPermissions;
    }
}
