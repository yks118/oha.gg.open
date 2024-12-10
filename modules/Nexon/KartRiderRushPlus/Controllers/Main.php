<?php
namespace Modules\Nexon\KartRiderRushPlus\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_kart_rider_rush_plus_main'));

        $data = [
            'data'  => [],
        ];

        try
        {
            $api = nexon_kart_rider_rush_plus_services_api();
            $data['data']['response']['notice']         = $api->getNotice()['notice'] ?? null;
            $data['data']['response']['noticeSeason']   = $api->getNoticeSeason()['season_notice'] ?? null;
            $data['data']['response']['noticeEvent']    = $api->getNoticeEvent()['event_notice'] ?? null;
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
