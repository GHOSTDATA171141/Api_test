<?php namespace App\Modules\CompanyManagement\Controllers;

use App\Modules\CompanyManagement\Repositories\CompanyManagementRepositories;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\APIRequest;
class CompanyManagement extends BaseController
{
    use ResponseTrait;
	private $companymanagementRepositories;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiRequest = new APIRequest();
        $this->companymanagementRepositories = new CompanyManagementRepositories();
    }

    public function apicompanyRegister()
	{
        $rules = [
            'cou_email' => 'required|string',
            'cou_password' => 'required|string',
            'cou_type' => 'required|string',
            'cou_name_th' => 'required|string',
            'cou_name_en' => 'required|string',
        ];
        // dd($rules);
        $request = $this->apiRequest->getRequestInput($this->request);
        if (!$this->apiRequest->validateRequest($request,$rules)) {
            return $this->fail($this->apiRequest->validator->getErrors());
        }
        return $this->setResponseFormat('json')->respond($this->companymanagementRepositories->companyRegister($request), 200);
	}

    public function apicompanyByid()
    {
        $request = $this->apiRequest->getRequestInput($this->request);
        return $this->setResponseFormat('json')->respond($this->companymanagementRepositories->apicompanyById($request), 200);
    }

}
