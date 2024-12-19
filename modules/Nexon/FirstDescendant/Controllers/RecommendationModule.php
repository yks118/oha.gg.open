<?php
namespace Modules\Nexon\FirstDescendant\Controllers;

class RecommendationModule extends BaseController
{
    protected string $viewName = 'recommendation-module';

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_recommendation_module'));
        $this->html->addTitle(lang('NexonFirstDescendant.fellow_level_exp'));

        $data = [
            'data'  => [
                'get'           => $this->request->getGet(),
                'descendants'   => [],
                'weapons'       => [],
                'voidBattles'   => [],
                'periods'       => [
                    lang('NexonFirstDescendant.period_day', [7]),
                    lang('NexonFirstDescendant.period_day', [30]),
                    lang('NexonFirstDescendant.period_all'),
                ],
            ],
        ];

        $list = nexon_first_descendant_meta_descendant();
        foreach ($list as $row)
        {
            $data['data']['descendants'][$row['descendant_id']] = $row['descendant_name'];
        }

        $list = nexon_first_descendant_meta_weapon();
        foreach ($list as $row)
        {
            $data['data']['weapons'][$row['weapon_id']] = $row['weapon_name'];
        }

        $list = nexon_first_descendant_meta_void_battle();
        foreach ($list as $row)
        {
            $data['data']['voidBattles'][$row['void_battle_id']] = $row['void_battle_name'];
        }

        ksort($data['data']['descendants']);
        ksort($data['data']['weapons']);
        ksort($data['data']['voidBattles']);

        if (
            isset($data['data']['get']['descendant_id'], $data['data']['get']['weapon_id'], $data['data']['get']['void_battle_id'], $data['data']['get']['period'])
            && $data['data']['get']['descendant_id'] && $data['data']['get']['weapon_id'] && $data['data']['get']['void_battle_id'] && in_array($data['data']['get']['period'], ['0', '1', '2'])
        )
        {
            $api = nexon_first_descendant_services_api();
            try
            {
                $data['data']['response'] = $api->getRecommendationModule(
                    $data['data']['get']['descendant_id'],
                    $data['data']['get']['weapon_id'],
                    $data['data']['get']['void_battle_id'],
                    $data['data']['get']['period']
                );
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
