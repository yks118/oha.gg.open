<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\ExternalComponent;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/external-component/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_external_component_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.external_component'))
        ;

        $data = [
            'data' => [
                'get'               => $this->request->getGet(),
                'response'          => [],
                'equipmentTypes'    => [],
                'tiers'             => [],
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

        $response = nexon_first_descendant_meta_external_component($data['data']['get']['language_code']);
        $response = preg_replace(
            '/,"base_stat":.+?}]/',
            '',
            $response
        );
        $list = json_decode($response, true);

        foreach ($list as $row)
        {
            if (! in_array($row['external_component_equipment_type'], $data['data']['equipmentTypes']))
            {
                $data['data']['equipmentTypes'][] = $row['external_component_equipment_type'];
            }

            if (! in_array($row['external_component_tier'], $data['data']['tiers']))
            {
                $data['data']['tiers'][] = $row['external_component_tier'];
            }
        }

        if (isset($data['data']['get']['external_component_equipment_type']) && $data['data']['get']['external_component_equipment_type'])
        {
            $externalComponentEquipmentType = $data['data']['get']['external_component_equipment_type'];
            $list = array_filter(
                $list,
                function($row) use($externalComponentEquipmentType)
                {
                    return $row['external_component_equipment_type'] === $externalComponentEquipmentType;
                }
            );
        }

        if (isset($data['data']['get']['external_component_tier']) && $data['data']['get']['external_component_tier'])
        {
            $externalComponentTier = $data['data']['get']['external_component_tier'];
            $list = array_filter(
                $list,
                function($row) use($externalComponentTier)
                {
                    return $row['external_component_tier'] === $externalComponentTier;
                }
            );
        }

        $data['data']['total'] = count($list);

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['response'] = array_slice($list, $offset, $this->limit);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
