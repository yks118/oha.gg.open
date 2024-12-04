<?php
namespace Modules\Nexon\Baram\Controllers;

class Main extends BaseController
{
    protected string $viewName = 'main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_baram_main'));

        $cApi = nexon_baram_config_api();

        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'serverNames'   => $cApi->serverNames,
            ],
        ];

        if (
            isset($data['data']['get']['server_name'], $data['data']['get']['character_name'])
            && $data['data']['get']['server_name'] && $data['data']['get']['character_name']
        )
        {
            try
            {
                $api = nexon_baram_services_api();

                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $data['data']['response']['basic']          = $api->getCharacterBasic($data['data']['get']['ocid']);
                    $data['data']['response']['title']          = $api->getCharacterTitle($data['data']['get']['ocid']);
                    $data['data']['response']['titleEquipment'] = $api->getCharacterTitleEquipment($data['data']['get']['ocid']);
                    $data['data']['response']['itemEquipment']  = $api->getCharacterItemEquipment($data['data']['get']['ocid']);
                    $data['data']['response']['stat']           = $api->getCharacterStat($data['data']['get']['ocid']);
                    $data['data']['response']['guild']          = $api->getCharacterGuild($data['data']['get']['ocid']);

                    array_multisort(
                        array_column($data['data']['response']['itemEquipment']['item_equipment'], 'item_equipment_slot_name'),
                        SORT_ASC,
                        $data['data']['response']['itemEquipment']['item_equipment']
                    );
                }
                else
                {
                    $cacheKey = 'baram_getid_' . base64_encode($data['data']['get']['server_name'] . $data['data']['get']['character_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['server_name'], $data['data']['get']['character_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ocid', $response['ocid']));
                }
            }
            catch (\Exception $e)
            {
                $data['message'] = $e->getMessage();
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
