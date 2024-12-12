<?php
namespace Modules\Nexon\MapleStoryM\Controllers\Character;

use Modules\Nexon\MapleStoryM\Controllers\BaseController;

class Skill extends BaseController
{
    protected string $viewName = 'character/skill';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_maple_story_m_character_skill'));
        $this->html
            ->addTitle('캐릭터 정보 조회')
            ->addTitle($this->request->getGet('character_name'))
            ->addTitle('장착 스킬')
        ;

        $data = [
            'data'  => [
                'get' => $this->request->getGet(),
            ],
        ];

        if (
            ! (
                isset($data['data']['get']['world_name'], $data['data']['get']['character_name'], $data['data']['get']['ocid'])
                && $data['data']['get']['world_name'] && $data['data']['get']['character_name'] && $data['data']['get']['ocid']
            )
        )
        {
            return $this->response->redirect(site_to('nexon_maple_story_m_character_main'));
        }

        try {
            $api = nexon_maple_story_m_services_api();

            $data['data']['response'] = [];
            $data['data']['response']['skillEquipment'] = $api->getCharacterSkillEquipment($data['data']['get']['ocid']);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return $this->error($data);
        }

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
