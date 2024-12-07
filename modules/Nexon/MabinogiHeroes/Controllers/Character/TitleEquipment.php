<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Character;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class TitleEquipment extends BaseController
{
    protected string $viewName = 'character/title-equipment';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_mabinogi_heroes_character_main'));
        $this->html
            ->addTitle('캐릭터 정보 조회')
            ->addTitle($this->request->getGet('character_name'))
            ->addTitle('타이틀/문양 정보 조회')
        ;

        $data = [
            'data'  => [
                'get'   => $this->request->getGet(),
            ],
        ];

        if (
            isset($data['data']['get']['character_name'], $data['data']['get']['ocid'])
            && $data['data']['get']['character_name'] && $data['data']['get']['ocid']
        )
        {
            try
            {
                $api = nexon_mabinogi_heroes_services_api();
                $data['data']['response']['list']       = $api->getCharacterTitle($data['data']['get']['ocid'])['title'];
                $data['data']['response']['equipment']  = $api->getCharacterTitleEquipment($data['data']['get']['ocid'])['title_equipment'];
            }
            catch (\Exception $e)
            {
                $data['message']    = $e->getMessage();
                $data['href']       = site_to('nexon_mabinogi_heroes_character_main');
                return $this->error($data);
            }
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
