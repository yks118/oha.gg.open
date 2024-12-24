<?php
namespace Modules\NcSoft\Core\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends \Modules\Core\Controllers\BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->helpers[] = 'ncsoft_core';
    }

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->html->addTitle('NCSOFT');
    }
}
