<?php namespace App\Modules\User\Repositories;

use App\Libraries\Logger;
use CodeIgniter\Controller;

class ProfileRepositories extends Controller
{
    public function __construct()
    {
        $this->logger = new Logger();
    }

    public function getUserProfileInfo($request)
    {
        try {
            $response = [
                'resultCode' => 200,
                'resultMessage' => 'Success',
                'data' => 'User data',
            ];
            $this->logger->writeApiLogs($request, $response, 'get-profile');
            return $response;
        } catch (\Exception $e) {
            $response = [
                'resultCode' => 500,
                'resultMessage' => $e->getMessage(),
            ];
            $this->logger->writeApiLogs($request, $response, 'get-profile');
            return $response;
        }
    }
}