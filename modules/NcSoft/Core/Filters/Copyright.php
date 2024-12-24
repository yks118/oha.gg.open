<?php
namespace Modules\NcSoft\Core\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Copyright implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): void
    {
        $arrCopyrightApi = [];
        $arrCopyrightApi[] = 'This site has no relationship with <a href="https://ncsoft.com/">NCSOFT</a>.';
        $arrCopyrightApi[] = 'Powered by <a href="https://developers.plaync.com/">PLAYNC Developers</a>';
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
