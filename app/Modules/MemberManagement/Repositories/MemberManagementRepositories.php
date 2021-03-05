<?php namespace App\Modules\MemberManagement\Repositories;

use App\Modules\MemberManagement\Models\MemberManagementModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use DateTime;
use App\Libraries\Logger;

class MemberManagementRepositories extends Controller
{
    private $membermanagementModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->logger = new Logger();
        $this->membermanagementModel = new MemberManagementModel();
    }
    ///API
    public function apiAllmember()
    {
        return $this->membermanagementModel->getAllMembers();
    }

    public function memberRegister($request)
    {
        $data = [
            'username' => $request['payloads']['username'],
            'password' => password_hash($request['payloads']['password'], PASSWORD_DEFAULT),
            'firstname' => $request['payloads']['firstname'],
            'lastname' => $request['payloads']['lastname'],
            'fullname' => $request['payloads']['firstname']+['lastname'],

        ];
        $response =  $this->membermanagementModel->getmemberRegisterModel($data);
        $this->logger->writeApiLogs($request, $response, 'user-regis');
        return $response; 
    }
    public function apimemberById($request)
    {
        $id = $request['payloads']['id'];
        $response= $this->membermanagementModel->getMemberById($id);
        $this->logger->writeApiLogs($request,$response,'member-list');
        return $response;
    }
    public function apideletememberById($request)
    {
        $id = $request['payloads']['id'];
        $response= $this->membermanagementModel->apiDeletememberById($id);
        $this->logger->writeApiLogs($request,$response,'member-delete');
        return $response;
    }
    public function apimemberEditById($request)
    {
        $id = $request['payloads']['id'];
        $data = [
            'username' => $request['payloads']['username'],
            'firstname' => $request['payloads']['firstname'],
            'lastname' => $request['payloads']['lastname'],
            'province' => $request['payloads']['province'],
            'amphur' => $request['payloads']['amphur'],
            'district' => $request['payloads']['district'],
        ];
        $response =  $this->membermanagementModel->getmemberEditModel($id,$data);
        $this->logger->writeApiLogs($request, $response,'member-edit');
        return $response; 
    }
}
