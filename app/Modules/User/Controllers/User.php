<?php

namespace App\Modules\User\Controllers;

use App\Libraries\APIRequest;
use App\Modules\User\Repositories\UserRepositories;

class User extends BaseController
{
    public function __construct()
    {
        $this->apiRequest = new APIRequest();
        $this->UserRepositories = new UserRepositories();
    }

    public function userInfo()
    {
        //  Have rule for validation
        // $rules = [
        // 'password' => 'required|string|min_length[8]',
        // 'repeatPassword' => 'required|matches[password]|min_length[8]',
        // ];

        // $request = $this->apiRequest->getRequestInput($this->request);
        // if (!$this->apiRequest->validateRequest($request, $rules)) {
        // return $this->fail($this->apiRequest->validator->getErrors());
        // }

        $request = $this->apiRequest->getRequestInput($this->request);
        return $this->setResponseFormat('json')->respond($this->UserRepositories->getUserInfo($request), 200);
    }

    public function userRegis()
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
        return $this->setResponseFormat('json')->respond($this->UserRepositories->userRegister($request), 200);
    }

    public function userLogin()
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
        $request = $this->apiRequest->getRequestInput($this->request);
        if (!$this->apiRequest->validateRequest($request, $rules)) {
            return $this->fail($this->apiRequest->validator->getErrors());
        }

        return $this->setResponseFormat('json')->respond($this->UserRepositories->loginProcess($request), 200);
    }

    public function userList()
    {
        // $rules = [
        //     'username' => 'required|string',
        //     'firstname' => 'required|string',
        //     'lastname' => 'required|string',
        // ];

        $request = $this->apiRequest->getRequestInput($this->request);
        // return $this->setResponseFormat('json')->respond($request,200);
        return  $this->setResponseFormat('json')->respond($this->UserRepositories->getUserProcess($request),200);
    }
    public function userReFresh()
    {
        $request = $this->apiRequest->getRequestInput($this->request);
        // return  $this->setResponseFormat('json')->respond($this->UserRepositories->getUserRefreshProcess($request),200);
        // return $this->UserRepositories->getUserRefreshProcess($request,200);
        return $this->setResponseFormat('json')->respond($this->UserRepositories->getUserRefreshProcess($request) ,200);
    }
}
