<?php
namespace Modules\Nexon\FirstDescendant\Controllers\Meta\Module;

use Modules\Nexon\FirstDescendant\Controllers\BaseController;

class Main extends BaseController
{
    protected string $viewName = 'meta/module/main';

    private int $limit = 12;

    public function index(): \CodeIgniter\HTTP\ResponseInterface|string
    {
        $this->navigation->setNowHref(site_to('nexon_first_descendant_meta_module_main'));
        $this->html
            ->addTitle(lang('NexonFirstDescendant.metadata_information'))
            ->addTitle(lang('NexonFirstDescendant.module'))
        ;

        $data = [
            'data' => [
                'get'                       => $this->request->getGet(),
                'response'                  => [],
                'tiers'                     => [],
                'socketTypes'               => [],
                'classes'                   => [],
                'availableWeaponTypes'      => [],
                'availableDescendantIds'    => [],
                'slotTypes'                 => [],
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

        $list = nexon_first_descendant_meta_module($data['data']['get']['language_code']);
        foreach ($list as $row)
        {
            if (! in_array($row['module_tier_id'], $data['data']['tiers']))
            {
                $data['data']['tiers'][] = $row['module_tier_id'];
            }

            if (! in_array($row['module_socket_type'], $data['data']['socketTypes']))
            {
                $data['data']['socketTypes'][] = $row['module_socket_type'];
            }

            if (! in_array($row['module_class'], $data['data']['classes']))
            {
                $data['data']['classes'][] = $row['module_class'];
            }

            $data['data']['availableWeaponTypes']   = array_merge($data['data']['availableWeaponTypes'],    $row['available_weapon_type']);
            $data['data']['availableDescendantIds'] = array_merge($data['data']['availableDescendantIds'],  $row['available_descendant_id']);
            $data['data']['slotTypes']              = array_merge($data['data']['slotTypes'],               $row['available_module_slot_type']);
        }

        sort($data['data']['tiers']);
        sort($data['data']['socketTypes']);
        sort($data['data']['classes']);
        $data['data']['availableWeaponTypes'] = array_unique($data['data']['availableWeaponTypes']);
        sort($data['data']['availableWeaponTypes']);
        $data['data']['availableDescendantIds'] = array_unique($data['data']['availableDescendantIds']);
        sort($data['data']['availableDescendantIds']);
        $data['data']['slotTypes'] = array_unique($data['data']['slotTypes']);
        sort($data['data']['slotTypes']);

        if (isset($data['data']['get']['module_tier_id']) && $data['data']['get']['module_tier_id'])
        {
            $moduleTier = $data['data']['get']['module_tier_id'];
            $list = array_filter(
                $list,
                function($row) use($moduleTier)
                {
                    return $row['module_tier_id'] === $moduleTier;
                }
            );
        }

        if (isset($data['data']['get']['module_socket_type']) && $data['data']['get']['module_socket_type'])
        {
            $moduleSocketType = $data['data']['get']['module_socket_type'];
            $list = array_filter(
                $list,
                function($row) use($moduleSocketType)
                {
                    return $row['module_socket_type'] === $moduleSocketType;
                }
            );
        }

        if (isset($data['data']['get']['module_class']) && $data['data']['get']['module_class'])
        {
            $moduleClass = $data['data']['get']['module_class'];
            $list = array_filter(
                $list,
                function($row) use($moduleClass)
                {
                    return $row['module_class'] === $moduleClass;
                }
            );
        }

        if (isset($data['data']['get']['available_weapon_type']) && $data['data']['get']['available_weapon_type'])
        {
            $availableWeaponType = $data['data']['get']['available_weapon_type'];
            $list = array_filter(
                $list,
                function($row) use($availableWeaponType)
                {
                    return in_array($availableWeaponType, $row['available_weapon_type']);
                }
            );
        }

        if (isset($data['data']['get']['available_descendant_id']) && $data['data']['get']['available_descendant_id'])
        {
            $availableDescendantId = $data['data']['get']['available_descendant_id'];
            $list = array_filter(
                $list,
                function($row) use($availableDescendantId)
                {
                    return in_array($availableDescendantId, $row['available_descendant_id']);
                }
            );
        }

        if (isset($data['data']['get']['available_module_slot_type']) && $data['data']['get']['available_module_slot_type'])
        {
            $availableModuleSlotType = $data['data']['get']['available_module_slot_type'];
            $list = array_filter(
                $list,
                function($row) use($availableModuleSlotType)
                {
                    return in_array($availableModuleSlotType, $row['available_module_slot_type']);
                }
            );
        }

        $data['data']['total'] = count($list);

        $offset = ($data['data']['get']['page'] - 1) * $this->limit;
        $list = array_slice($list, $offset, $this->limit);
        $data['data']['response'] = $list;

        $this->cachePage(MINUTE);
        return $this->render($data);
    }
}
