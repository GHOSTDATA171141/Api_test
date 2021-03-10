<?php

namespace App\Modules\User\Controllers;

use App\Libraries\APIRequest;
use App\Modules\User\Repositories\ProfileRepositories;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->apiRequest = new APIRequest();
        $this->profileRepositories = new ProfileRepositories();
    }

    public function userProfileInfo()
    {
        /* Have rule for validation
        $rules = [
        'password' => 'required|string|min_length[8]',
        'repeatPassword' => 'required|matches[password]|min_length[8]',
        ];

        $request = $this->apiRequest->getRequestInput($this->request);
        if (!$this->apiRequest->validateRequest($request, $rules)) {
        return $this->fail($this->apiRequest->validator->getErrors());
        }
         */

        $request = $this->apiRequest->getRequestInput($this->request);
        return $this->setResponseFormat('json')->respond(
            $this->profileRepositories
                ->getUserProfileInfo($request),
            200
        );
    }
}
