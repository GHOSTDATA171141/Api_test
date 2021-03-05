<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Modules\User\Models\UserModel;

class UserAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $this->userModel = new UserModel;
        $adminAuth = $this->userModel->getUserAuth();
        if ($adminAuth['resultCode'] !== 200) {
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}