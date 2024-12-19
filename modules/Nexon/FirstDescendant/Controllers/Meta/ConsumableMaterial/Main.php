<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\ConsumableMaterial;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/consumable-material/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_consumable_material_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.consumable_material'))
        ;

        $data = [
            'data' => [
                'get'                       => $this->request->getGet(),
                'response'                  => [],
                'materialTypes'             => [],
                'acquisitionDetails'        => [],
                'amorphousRewards'          => [],
                'amorphousOpenConditions'   => [],
            ],
        ];

        if (
            ! (
                isset($data['data']['get']['language_code'])
                && $data['data']['get']['language_code']
                && in_array($data['data']['get']['language_code'], nexon_first_descendant_config_api()->languageCodes)
            )
        )
        {
            $data['data']['get']['language_code'] = $this->request->getLocale();
        }

        if (! (isset($data['data']['get']['page']) && intval($data['data']['get']['page']) == $data['data']['get']['page'] && $data['data']['get']['page'] > 0))
        {
            $data['data']['get']['page'] = 1;
        }

        $list = nexon_first_descendant_meta_consumable_material($data['data']['get']['language_code']);
        foreach ($list as $row)
        {
            if ($row['material_type'] && ! in_array($row['material_type'], $data['data']['materialTypes']))
            {
                $data['data']['materialTypes'][] = $row['material_type'];
            }

            $data['data']['acquisitionDetails']         = array_merge($data['data']['acquisitionDetails'], $row['acquisition_detail']);
            $data['data']['amorphousRewards']           = array_merge($data['data']['amorphousRewards'], $row['amorphous_reward']);
            $data['data']['amorphousOpenConditions']    = array_merge($data['data']['amorphousOpenConditions'], $row['amorphous_open_condition']);
        }

        sort($data['data']['materialTypes']);
        $data['data']['acquisitionDetails'] = array_unique($data['data']['acquisitionDetails']);
        sort($data['data']['acquisitionDetails']);
        $data['data']['amorphousRewards'] = array_unique($data['data']['amorphousRewards']);
        sort($data['data']['amorphousRewards']);
        $data['data']['amorphousOpenConditions'] = array_unique($data['data']['amorphousOpenConditions']);
        sort($data['data']['amorphousOpenConditions']);

        if (isset($data['data']['get']['material_type']) && $data['data']['get']['material_type'])
        {
            $materialType = $data['data']['get']['material_type'];
            $list = array_filter(
                $list,
                function($row) use($materialType)
                {
                    return $row['material_type'] === $materialType;
                }
            );
        }

        if (isset($data['data']['get']['acquisition_detail']) && $data['data']['get']['acquisition_detail'])
        {
            $acquisitionDetail = $data['data']['get']['acquisition_detail'];
            $list = array_filter(
                $list,
                function($row) use($acquisitionDetail)
                {
                    return in_array($acquisitionDetail, $row['acquisition_detail']);
                }
            );
        }

        if (isset($data['data']['get']['amorphous_reward']) && $data['data']['get']['amorphous_reward'])
        {
            $amorphousReward = $data['data']['get']['amorphous_reward'];
            $list = array_filter(
                $list,
                function($row) use($amorphousReward)
                {
                    return in_array($amorphousReward, $row['amorphous_reward']);
                }
            );
        }

        if (isset($data['data']['get']['amorphous_open_condition']) && $data['data']['get']['amorphous_open_condition'])
        {
            $amorphousOpenCondition = $data['data']['get']['amorphous_open_condition'];
            $list = array_filter(
                $list,
                function($row) use($amorphousOpenCondition)
                {
                    return in_array($amorphousOpenCondition, $row['amorphous_open_condition']);
                }
            );
        }

        $data['data']['total'] = count($list);

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['response']   = array_slice($list, $offset, $this->limit);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
