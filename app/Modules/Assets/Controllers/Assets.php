<?php namespace App\Modules\Assets\Controllers;

use App\Modules\Assets\Repositories\AssetsRepositories;
use App\Libraries\APIRequest;

class Assets extends BaseController
{
	private $assetsRepositories;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->apiRequest = new APIRequest();
        $this->assetsRepositories = new AssetsRepositories();
    }

    public function getProvince()
	{

		return $this->setResponseFormat('json')->respond($this->assetsRepositories->getProvincecProcess(), 200);
	}

}
