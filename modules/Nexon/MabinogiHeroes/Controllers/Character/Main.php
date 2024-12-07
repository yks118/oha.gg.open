<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Character;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'character/main';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_character_main'));
        $this->html->addTitle('캐릭터 정보 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['character_name']) && $data['data']['get']['character_name'])
        {
            try
            {
                $api = nexon_mabinogi_heroes_services_api();

                if (isset($data['data']['get']['ocid']) && $data['data']['get']['ocid'])
                {
                    $ocid = $data['data']['get']['ocid'];
                    $data['data']['response']['basic']  = $api->getCharacterBasic($ocid);
                    $data['data']['response']['stat']   = $api->getCharacterStat($ocid);
                    $data['data']['response']['guild']  = $api->getCharacterGuild($ocid);
                }
                else
                {
                    $cacheKey = 'nexon_mabinogi_heroes_getid_' . base64_encode($data['data']['get']['character_name']);
                    $response = cache()->get($cacheKey);
                    if (is_null($response))
                    {
                        $response = $api->getId($data['data']['get']['character_name']);
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
