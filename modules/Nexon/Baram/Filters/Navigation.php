<?php
namespace Modules\Nexon\Baram\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Navigation implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        \Modules\Core\Config\Services::navigation()->set([
            [
                'name'  => '대시보드',
                'href'  => site_to('nexon_baram_main'),
            ],
            [
                'name'  => '공식 홈페이지',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '바람의나라',
                        'href'  => 'https://baram.nexon.com/',
                    ],
                    [
                        'name'  => 'NEXON Open API',
                        'href'  => 'https://openapi.nexon.com/game/baram/?id=13',
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
