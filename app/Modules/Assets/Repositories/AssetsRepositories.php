<?php namespace App\Modules\Assets\Repositories;

use App\Modules\Assets\Models\AssetsModel;
use CodeIgniter\Controller;

class AssetsRepositories extends Controller
{
    private $assetsModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->assetsModel = new AssetsModel();
    }

    public function examplePage()
	{
		$data = [
		    'title' => 'Example Page (Assets)',
            'view' => 'assets/example-page',
            'data' => $this->assetsModel->getAssetsList(),
        ];

		return view('template/layout', $data);
	}
    public function getProvincecProcess()
    {
        $response= $this->assetsModel->getAllprovince();
        // $this->logger->writeApiLogs($request,$response,'user-list');
        return $response;

    }

}
