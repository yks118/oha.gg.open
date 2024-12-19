<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Weapon;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/weapon/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_weapon_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.weapon'))
        ;

        $data = [
            'data' => [
                'get'           => $this->request->getGet(),
                'response'      => [],
                'types'         => [],
                'tiers'         => [],
                'roundsTypes'   => [],
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

        $list = nexon_first_descendant_meta_weapon($data['data']['get']['language_code']);
        foreach ($list as $row)
        {
            // $row['weapon_type'] 에 값이 비어있는 경우가 있음..
            if ($row['weapon_type'] && ! in_array($row['weapon_type'], $data['data']['types']))
            {
                $data['data']['types'][] = $row['weapon_type'];
            }

            if ($row['weapon_tier'] && ! in_array($row['weapon_tier'], $data['data']['tiers']))
            {
                $data['data']['tiers'][] = $row['weapon_tier'];
            }

            if ($row['weapon_rounds_type'] && ! in_array($row['weapon_rounds_type'], $data['data']['roundsTypes']))
            {
                $data['data']['roundsTypes'][] = $row['weapon_rounds_type'];
            }
        }

        sort($data['data']['types']);
        sort($data['data']['tiers']);

        if (isset($data['data']['get']['weapon_type']) && $data['data']['get']['weapon_type'])
        {
            $weaponType = $data['data']['get']['weapon_type'];
            $list = array_filter(
                $list,
                function($row) use($weaponType)
                {
                    return $row['weapon_type'] === $weaponType;
                }
            );
        }

        if (isset($data['data']['get']['weapon_tier']) && $data['data']['get']['weapon_tier'])
        {
            $weaponTier = $data['data']['get']['weapon_tier'];
            $list = array_filter(
                $list,
                function($row) use($weaponTier)
                {
                    return $row['weapon_tier'] === $weaponTier;
                }
            );
        }

        if (isset($data['data']['get']['weapon_rounds_type']) && $data['data']['get']['weapon_rounds_type'])
        {
            $weaponRoundsType = $data['data']['get']['weapon_rounds_type'];
            $list = array_filter(
                $list,
                function($row) use($weaponRoundsType)
                {
                    return $row['weapon_rounds_type'] === $weaponRoundsType;
                }
            );
        }

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $data['data']['response']   = array_slice($list, $offset, $this->limit);
        $data['data']['total']      = count($list);

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
