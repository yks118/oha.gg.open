<?php
namespace Modules\Nexon\Core\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Copyright implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        $arrCopyrightApi = [];
        $arrCopyrightApi[] = 'This site has no relationship with <a href="https://company.nexon.com/">NEXON Korea</a>.';
        $arrCopyrightApi[] = 'This site was created based on <a href="https://openapi.nexon.com/">NEXON Open API</a>.';
        \Config\Services::renderer()
            ->setData(
                [
                    'copyrightApi'  => implode(' ', $arrCopyrightApi),
                ],
                'raw'
            )
        ;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {}
}
