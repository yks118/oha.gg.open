<?php
namespace Modules\Nexon\CrazyArcade\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_crazy_arcade_main'));

        $api = nexon_crazy_arcade_services_api();
        $data = [
            'data'  => [],
        ];

        try
        {
            $data['data']['notice']     = $api->getNotice()['notice'] ?? null;
            $data['data']['monthly']    = $api->getNoticeMonthly()['monthly_notice'] ?? null;
            $data['data']['event']      = $api->getNoticeEvent()['event_notice'] ?? null;
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
