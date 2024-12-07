<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends \Modules\Nexon\Core\Controllers\BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->helpers[] = 'nexon_mabinogi_heroes';
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->moduleName = 'Nexon\MabinogiHeroes';
        $this->html->addTitle('마비노기 영웅전');
    }
}
