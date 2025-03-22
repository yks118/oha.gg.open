<?php
namespace Modules\Nexon\Mabinogi\Controllers;

class NpcShopList extends BaseController
{
    protected string $viewName = 'npc-shop-list';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_npc_shop_list'));
        $this->html->addTitle('NPC 상점 조회');

        $cacheTime = MINUTE;
        $cApi = nexon_mabinogi_config_api();
        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'serverNames'   => $cApi->serverNames,
                'npcNames'      => $cApi->npcNames,
            ],
        ];

        if (
            isset(
                $data['data']['get']['server_name'],
                $data['data']['get']['npc_name'],
                $data['data']['get']['channel']
            )
        )
        {
            try
            {
                $api = nexon_mabinogi_services_api();
                $data['data']['response'] = $api->getNpcShopList(
                    $data['data']['get']['npc_name'],
                    $data['data']['get']['server_name'],
                    $data['data']['get']['channel']
                );

                $nowTime = time();
                $nextUpdateTime = strtotime($data['data']['response']['date_shop_next_update']);
                if ($nextUpdateTime > $nowTime)
                {
                    $cacheTime = $nextUpdateTime - $nowTime;
                }
            }
            catch (\Exception $e)
            {
                $data['message']  = 'API 오류가 발생했습니다. 잠시후 다시 시도해주세요.' . PHP_EOL;
                $data['message'] .= $e->getMessage() . PHP_EOL;
                return $this->error($data);
            }
        }

        $this->cachePage($cacheTime);
        return $this->render($data);
    }
}
