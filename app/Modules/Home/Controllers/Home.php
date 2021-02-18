<?php
namespace App\Modules\Home\Controllers;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
    }

    public function index()
    {
        return $this->setResponseFormat('json')->respond(
            [
                "statusCode" => 404,
                "error" => "Not Found",
                "message" => "Not Found",
            ],
            404
        );
    }
}