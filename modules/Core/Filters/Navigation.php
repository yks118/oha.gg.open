<?php
namespace Modules\Core\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Navigation implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        \Modules\Core\Config\Services::navigation()->set([
            [
                'name'  => '넥슨',
                'href'  => '',
                'child' => [
                    [
                        'name'  => '마비노기',
                        'href'  => site_to('nexon_mabinogi_main'),
                    ],
                    [
                        'name'  => '마비노기 영웅전',
                        'href'  => site_to('nexon_mabinogi_heroes_main'),
                    ],
                    [
                        'name'  => '바람의나라',
                        'href'  => site_to('nexon_baram_main'),
                    ],
                ],
            ],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
