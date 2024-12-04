<?php
namespace Modules\Core\Controllers;

class Migration extends BaseController
{
    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->thema->setLayout('');

        $migrations = \Config\Services::migrations();
        $migrations->setNamespace('')->latest();

        $cCms = core_config_cms();

        $data = [];
        $data['message']    = '모듈 DB 업데이트가 완료되었습니다.';
        $data['href']       = $this->request->getGet($cCms->redirectURLName) ?? site_to('core_main');
        return $this->render($data);
    }
}
