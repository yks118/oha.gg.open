<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_main'));

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        $api = nexon_mabinogi_heroes_services_api();
        try
        {
            $data['data']['notice'] = $api->getNotice()['notice'] ?? null;
            $data['data']['patch']  = $api->getNoticePatch()['patch_notice'] ?? null;
            $data['data']['event']  = $api->getNoticeEvent()['event_notice'] ?? null;
        }
        catch (\Exception $e)
        {
            $data['message'] = $e->getMessage();
            return $this->error($data);
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
