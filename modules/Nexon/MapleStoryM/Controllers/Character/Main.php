<?php
namespace Modules\Nexon\MapleStoryM\Controllers\Character;

use Modules\Nexon\MapleStoryM\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'character/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_maple_story_m_character_main'));
        $this->html->addTitle('캐릭터 정보 조회');

        $cApi = nexon_maple_story_m_config_api();
        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'worldNames'    => $cApi->worldNames,
            ],
        ];

        if (
            isset($data['data']['get']['world_name'], $data['data']['get']['character_name'])
            && $data['data']['get']['world_name'] && $data['data']['get']['character_name']
        )
        {
            try {
                $api = nexon_maple_story_m_services_api();
                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $ocid = $data['data']['get']['ocid'];

                    $data['data']['response'] = [];
                    $data['data']['response']['basic']              = $api->getCharacterBasic($ocid);
                    $data['data']['response']['itemEquipment']      = $api->getCharacterItemEquipment($ocid)['item_equipment'] ?? null;
                    $data['data']['response']['stat']               = $api->getCharacterStat($ocid)['stat'] ?? null;
                    $data['data']['response']['guild']              = $api->getCharacterGuild($ocid)['guild_name'] ?? null;
                    $data['data']['response']['beautyEquipment']    = $api->getCharacterBeautyEquipment($ocid);
                    $data['data']['response']['petEquipment']       = $api->getCharacterPetEquipment($ocid);

                    array_multisort(
                        array_column($data['data']['response']['itemEquipment'], 'item_equipment_slot_name'),
                        SORT_ASC,
                        $data['data']['response']['itemEquipment']
                    );
                }
                else
                {
                    $cacheKey = 'nexon_maple_story_m_getid_' . base64_encode($data['data']['get']['world_name'] . $data['data']['get']['character_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['world_name'], $data['data']['get']['character_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ocid', $response['ocid']));
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
