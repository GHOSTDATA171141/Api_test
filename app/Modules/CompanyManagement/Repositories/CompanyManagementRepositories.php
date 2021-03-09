<?php namespace App\Modules\Companymanagement\Repositories;

use App\Modules\Companymanagement\Models\CompanymanagementModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use DateTime;
use App\Libraries\Logger;
class CompanymanagementRepositories extends Controller
{
    private $companymanagementModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger();
        $this->companymanagementModel = new CompanymanagementModel();
    }
    public function companyRegister($request)
    {
        $data = [
            'cou_type' => $request['payloads']['cou_type'],
            'cou_email' => $request['payloads']['cou_email'],
            'cou_password' => password_hash($request['payloads']['cou_password'], PASSWORD_DEFAULT),
            'cou_name_th' => $request['payloads']['cou_name_th'],
            'cou_name_en' => $request['payloads']['cou_name_en'],
            'province' => $request['payloads']['province'],
            'amphur' => $request['payloads']['amphur'],
            'district' => $request['payloads']['district'],
        ];
        // dd($data);
        $response =  $this->companymanagementModel->getcompanyRegisterModel($data);
        $this->logger->writeApiLogs($request, $response, 'company-register');
        return $response; 
    }
    public function apicompanyById($request)
    {
        $id = $request['payloads']['cou_id'];
        $response= $this->companymanagementModel->getCompanyById($id);
        $this->logger->writeApiLogs($request,$response,'company-list');
        return $response;
    }

}
