<?php
namespace Modules\NcSoft\Lineage2M\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends \Modules\NcSoft\Core\Controllers\BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->helpers[] = 'ncsoft_lineage2m';
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->moduleName = 'NcSoft\Lineage2M';
        $this->html->addTitle('리니지2M');
    }
}
