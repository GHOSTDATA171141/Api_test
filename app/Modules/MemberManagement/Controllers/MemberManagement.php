<?php namespace App\Modules\Membermanagement\Controllers;

use App\Modules\Membermanagement\Repositories\MembermanagementRepositories;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\APIRequest;


class Membermanagement extends BaseController
{
    
    use ResponseTrait;
	private $membermanagementRepositories;
    

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiRequest = new APIRequest();
        $this->membermanagementRepositories = new MembermanagementRepositories();
    }
    public function apiAllmember()
    {
        $data = $this->membermanagementRepositories->apiAllmember();
        return $this->respond($data,200);
    }

    public function apimemberById()
    {
        $request = $this->apiRequest->getRequestInput($this->request);
        return $this->setResponseFormat('json')->respond($this->membermanagementRepositories->apimemberById($request), 200);
    }
    public function apimemberRegister()
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
            'repassword' => 'required|matches[password]',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ];

        $request = $this->apiRequest->getRequestInput($this->request);
        if (!$this->apiRequest->validateRequest($request, $rules)) {
            return $this->fail($this->apiRequest->validator->getErrors());
        }
        return $this->setResponseFormat('json')->respond($this->membermanagementRepositories->memberRegister($request), 200);
    }
    public function apimemberEdit()
    {
        $rules = [
            'username' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ];
        $request = $this->apiRequest->getRequestInput($this->request);
        if (!$this->apiRequest->validateRequest($request, $rules)) {
            return $this->fail($this->apiRequest->validator->getErrors());
        }
        return $this->setResponseFormat('json')->respond($this->membermanagementRepositories->apimemberEditById($request), 200);
    }

    public function apideletememberById()
    {
        $request = $this->apiRequest->getRequestInput($this->request);
        return $this->setResponseFormat('json')->respond($this->membermanagementRepositories->apideletememberById($request),200);
    }

}
