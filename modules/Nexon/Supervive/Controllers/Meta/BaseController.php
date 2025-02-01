<?php
namespace Modules\Nexon\Supervive\Controllers\Meta;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends \Modules\Nexon\Supervive\Controllers\BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);

        $this->html->addTitle('메타 데이터');
    }
}
