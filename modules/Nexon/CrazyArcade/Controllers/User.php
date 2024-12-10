<?php
namespace Modules\Nexon\CrazyArcade\Controllers;

class User extends BaseController
{
    protected string $viewName = 'user';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_crazy_arcade_main'));
        $this->html->addTitle('계정 정보 조회');

        $cApi = nexon_crazy_arcade_config_api();
        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'worldNames'    => $cApi->worldNames,
            ],
        ];

        if (
            isset($data['data']['get']['world_name'], $data['data']['get']['user_name'])
            && $data['data']['get']['world_name'] && $data['data']['get']['user_name']
        )
        {
            try {
                $api = nexon_crazy_arcade_services_api();
                if (isset($data['data']['get']['ouid']) && $data['data']['get']['ouid'])
                {
                    $ouid = $data['data']['get']['ouid'];

                    $data['data']['response'] = [];
                    $data['data']['response']['basic']          = $api->getUserBasic($ouid);
                    $data['data']['response']['title']          = $api->getUserTitle($ouid)['title'] ?? null;
                    $data['data']['response']['titleEquipment'] = $api->getUserTitleEquipment($ouid)['title_equipment'] ?? null;
                    $data['data']['response']['itemEquipment']  = $api->getUserItemEquipment($ouid)['item_equipment'] ?? null;
                    $data['data']['response']['guild']          = $api->getUserGuild($ouid)['guild_id'] ?? null;
                }
                else
                {
                    $cacheKey = 'nexon_crazy_arcade_getid_' . base64_encode($data['data']['get']['world_name'] . $data['data']['get']['user_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['user_name'], $data['data']['get']['world_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ouid', $response['ouid']));
                }
            } catch (\Exception $e) {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
