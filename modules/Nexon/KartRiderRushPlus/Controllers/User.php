<?php
namespace Modules\Nexon\KartRiderRushPlus\Controllers;

class User extends BaseController
{
    protected string $viewName = 'user';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_kart_rider_rush_plus_user'));
        $this->html->addTitle('계정 정보 조회');

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (isset($data['data']['get']['racer_name']) && $data['data']['get']['racer_name'])
        {
            try
            {
                $api = nexon_kart_rider_rush_plus_services_api();

                if (isset($data['data']['get']['ouid']) && $data['data']['get']['ouid'])
                {
                    $ouid = $data['data']['get']['ouid'];
                    $data['data']['response']['basic']          = $api->getUserBasic($ouid);
                    $data['data']['response']['titleEquipment'] = $api->getUserTitleEquipment($ouid)['title_equipment'] ?? null;
                }
                else
                {
                    $cacheKey = 'nexon_kart_rider_rush_plus_getid_' . base64_encode($data['data']['get']['racer_name']);
                    $response = cache()->get($cacheKey);
                    if (empty($response))
                    {
                        $response = $api->getId($data['data']['get']['racer_name']);
                        cache()->save($cacheKey, $response, MINUTE);
                    }

                    return $this->response->redirect(current_url(true)->addQuery('ouid', $response['ouid_info'][0]['ouid']));
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
