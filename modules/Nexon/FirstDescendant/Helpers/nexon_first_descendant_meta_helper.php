<?php

if (! function_usable('nexon_first_descendant_meta_url'))
{
    function nexon_first_descendant_meta_url(string $path): string
    {
        return 'https://open.api.nexon.com/static/tfd/meta/' . $path;
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant'))
{
    /**
     * nexon_first_descendant_meta_descendant
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         descendant_id: string,
     *         descendant_name: string,
     *         descendant_group_id: string,
     *         descendant_image_url: string,
     *         descendant_stat: array{
     *             array{
     *                 level: int,
     *                 stat_detail: array{
     *                     array{
     *                         stat_id: string,
     *                         stat_value: int,
     *                     },
     *                 },
     *             },
     *         },
     *         descendant_skill: array{
     *             array{
     *                 skill_type: string,
     *                 skill_name: string,
     *                 element_type: string,
     *                 arche_type: string,
     *                 skill_image_url: string,
     *                 skill_description: string,
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_descendant(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_descendant_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/descendant.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant_id'))
{
    function nexon_first_descendant_meta_descendant_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_descendant_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_descendant($locale);
            foreach ($list as $row)
            {
                $data[$row['descendant_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_weapon'))
{
    /**
     * nexon_first_descendant_meta_weapon
     *
     * 무기 메타데이터를 조회합니다.
     * 해당 API는 Path 정보만 제공합니다. 별도 클라이언트를 통해 확인할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         weapon_name: string,
     *         weapon_id: string,
     *         image_url: string,
     *         weapon_type: string,
     *         weapon_tier_id: string,
     *         weapon_rounds_type: string,
     *         base_stat: array{
     *             array{
     *                 stat_id: string,
     *                 stat_value: int,
     *             },
     *         },
     *         firearm_atk: array{
     *             array{
     *                 level: int,
     *                 firearm: array{
     *                     array{
     *                         firearm_atk_type: string,
     *                         firearm_atk_value: int,
     *                     },
     *                 },
     *             },
     *         },
     *         weapon_perk_ability_name: string,
     *         weapon_perk_ability_description: string,
     *         weapon_perk_ability_image_url: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_weapon(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_weapon_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/weapon.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_weapon_id'))
{
    function nexon_first_descendant_meta_weapon_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_weapon_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_weapon($locale);
            foreach ($list as $row)
            {
                $data[$row['weapon_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_module'))
{
    /**
     * nexon_first_descendant_meta_module
     *
     * 모듈 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         module_name: string,
     *         module_id: string,
     *         image_url: string,
     *         module_type: string,
     *         module_tier_id: string,
     *         module_socket_type: string,
     *         module_class: string,
     *         available_weapon_type: string[],
     *         available_descendant_id: string[],
     *         available_module_slot_type: string[],
     *         module_stat: array{
     *             array{
     *                 level: int,
     *                 module_capacity: int,
     *                 value: string,
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_module(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_module_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/module.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_module_id'))
{
    function nexon_first_descendant_meta_module_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_module_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_module($locale);
            foreach ($list as $row)
            {
                $data[$row['module_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_reactor'))
{
    /**
     * nexon_first_descendant_meta_reactor
     *
     * 반응로 메타데이터를 조회합니다.
     * 해당 API는 Path 정보만 제공합니다. 별도 클라이언트를 통해 확인할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return string response 데이터(reactor_skill_power)가 많아서 array 로 리턴 불가..
     * @return array{
     *     array{
     *         reactor_id: string,
     *         reactor_name: string,
     *         image_url: string,
     *         reactor_tier_id: string,
     *         reactor_skill_power: array{
     *             array{
     *                 level: int,
     *                 skill_atk_power: int,
     *                 sub_skill_atk_power: int,
     *                 skill_power_coefficient: array{
     *                     array{
     *                         coefficient_stat_id: string,
     *                         coefficient_stat_value: int,
     *                     },
     *                 },
     *                 enchant_effect: array{
     *                     array{
     *                         enchant_level: int,
     *                         stat_id: string,
     *                         value: int,
     *                     },
     *                 },
     *             },
     *         },
     *         optimized_condition_type: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_reactor(?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_reactor_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/reactor.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return $data;
    }
}

if (! function_usable('nexon_first_descendant_meta_reactor_id'))
{
    function nexon_first_descendant_meta_reactor_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_reactor_' . $locale . '_' . $id;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $response = nexon_first_descendant_meta_reactor($locale);

            $offset = strpos($response, '{"reactor_id":"' . $id);
            $length = strpos($response, '},{"reactor_id"', $offset);
            if ($length !== false)
            {
                $length = $length - $offset + 1;
            }
            else
            {
                $length = strlen($response) - $offset - 1;
            }
            $response = substr($response, $offset, $length);

            $data = json_decode($response, true);
            cache()->save($cacheKey, $data, DAY);
        }

        return $data ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_external_component'))
{
    /**
     * nexon_first_descendant_meta_external_component
     *
     * 외장 부품 메타데이터를 조회합니다.
     * 해당 API는 Path 정보만 제공합니다. 별도 클라이언트를 통해 확인할 수 있습니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return string base_stat 값이 많음, 지금은 괜찮아도 추후에 memory limit 이 걸릴거라 생각..
     * @return array{
     *     array{
     *         external_component_id: string,
     *         external_component_name: string,
     *         image_url: string,
     *         external_component_equipment_type: string,
     *         external_component_tier_id: string,
     *         base_stat: array{
     *             array{
     *                 level: int,
     *                 stat_id: string,
     *                 stat_value: int,
     *             },
     *         },
     *         set_option_detail: array{
     *             array{
     *                 set_option: string,
     *                 set_count: int,
     *                 set_option_effect: string,
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_external_component(?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_external_component_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/external-component.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return $data;
    }
}

if (! function_usable('nexon_first_descendant_meta_external_component_id'))
{
    function nexon_first_descendant_meta_external_component_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_external_component_' . $locale . '_' . $id;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $response = nexon_first_descendant_meta_external_component($locale);

            $offset = strpos($response, '{"external_component_id":"' . $id);
            $length = strpos($response, '},{"external_component_id"', $offset);
            if ($length !== false)
            {
                $length = $length - $offset + 1;
            }
            else
            {
                $length = strlen($response) - $offset - 1;
            }
            $response = substr($response, $offset, $length);

            $data = json_decode($response, true);
            cache()->save($cacheKey, $data, DAY);
        }

        return $data ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_reward'))
{
    /**
     * nexon_first_descendant_meta_reward
     *
     * 난이도 보상 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return string
     * @return array{
     *     array{
     *         map_id: string,
     *         map_name: string,
     *         battle_zone: array{
     *             array{
     *                 battle_zone_id: string,
     *                 battle_zone_name: string,
     *                 reward: array{
     *                     array{
     *                         rotation: int,
     *                         reward_type: string,
     *                         reactor_element_type: string,
     *                         weapon_rounds_type: string,
     *                         arche_type: string,
     *                     },
     *                 },
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_reward(?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_reward_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/reward.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return $data;
    }
}

if (! function_usable('nexon_first_descendant_meta_stat'))
{
    /**
     * nexon_first_descendant_meta_stat
     *
     * 기본 스탯 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         stat_id: string,
     *         stat_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_stat(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_stat_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/stat.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_stat_id'))
{
    function nexon_first_descendant_meta_stat_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_stat_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_stat($locale);
            foreach ($list as $row)
            {
                $data[$row['stat_id']] = $row['stat_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_void_battle'))
{
    /**
     * nexon_first_descendant_meta_void_battle
     *
     * 보이드 요격전 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         void_battle_id: string,
     *         void_battle_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_void_battle(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_void_battle_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/void-battle.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_void_battle_id'))
{
    function nexon_first_descendant_meta_void_battle_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_void_battle_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_void_battle($locale);
            foreach ($list as $row)
            {
                $data[$row['void_battle_id']] = $row['void_battle_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_title'))
{
    /**
     * nexon_first_descendant_meta_title
     *
     * 타이틀 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         title_id: string,
     *         title_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_title(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_title_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/title.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_title_id'))
{
    function nexon_first_descendant_meta_title_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_title_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_title($locale);
            foreach ($list as $row)
            {
                $data[$row['title_id']] = $row['title_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant_level_detail'))
{
    /**
     * nexon_first_descendant_meta_descendant_level_detail
     *
     * 계승자 레벨별 필요 경험치 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{
     *     array{
     *         descendant_level: int,
     *         exp_per_level: int,
     *     },
     * }
     */
    function nexon_first_descendant_meta_descendant_level_detail(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_descendant_level_detail';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('descendant-level-detail.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant_level_detail_level'))
{
    function nexon_first_descendant_meta_descendant_level_detail_level(int $level): int
    {
        $cacheKey = 'nexon_first_descendant_meta_descendant_level_detail_level';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_descendant_level_detail();
            foreach ($list as $row)
            {
                $data[$row['descendant_level']] = $row['exp_per_level'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$level] ?? 0;
    }
}

if (! function_usable('nexon_first_descendant_meta_mastery_rank_level_detail'))
{
    /**
     * nexon_first_descendant_meta_mastery_rank_level_detail
     *
     * 마스터리 랭크별 필요 경험치 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{
     *     array{
     *         mastery_level: int,
     *         exp_per_level: int,
     *     },
     * }
     */
    function nexon_first_descendant_meta_mastery_rank_level_detail(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_mastery_rank_level_detail';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('mastery-rank-level-detail.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_mastery_rank_level_detail_level'))
{
    function nexon_first_descendant_meta_mastery_rank_level_detail_level(int $level): int
    {
        $cacheKey = 'nexon_first_descendant_meta_mastery_rank_level_detail_level';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_mastery_rank_level_detail();
            foreach ($list as $row)
            {
                $data[$row['mastery_level']] = $row['exp_per_level'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$level] ?? 0;
    }
}

if (! function_usable('nexon_first_descendant_meta_consumable_material'))
{
    /**
     * nexon_first_descendant_meta_consumable_material
     *
     * 소비 아이템 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         consumable_material_id: string,
     *         image_url: string,
     *         consumable_material_name: string,
     *         required_mastery_rank_level: int,
     *         material_type: string,
     *         acquisition_detail: string[],
     *         amorphous_reward: string[],
     *         amorphous_open_condition: string[],
     *     },
     * }
     */
    function nexon_first_descendant_meta_consumable_material(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_consumable_material_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/consumable-material.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_consumable_material_id'))
{
    function nexon_first_descendant_meta_consumable_material_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_consumable_material_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_consumable_material($locale);
            foreach ($list as $row)
            {
                $data[$row['consumable_material_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_research'))
{
    /**
     * nexon_first_descendant_meta_research
     *
     * 연구 정보 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         research_id: string,
     *         research_name: string,
     *         repeatable_research: bool,
     *         research_type: string,
     *         research_time: int,
     *         research_cost: array{
     *             array{
     *                 currency_type: string,
     *                 currency_value: int,
     *             },
     *         },
     *         research_boost_cost: array{
     *             array{
     *                 currency_type: string,
     *                 currency_value: int,
     *             },
     *         },
     *         research_result: array{
     *             array{
     *                 meta_type: string,
     *                 meta_id: string,
     *                 result_count: int,
     *             },
     *         },
     *         research_material: array{
     *             array{
     *                 meta_type: string,
     *                 meta_id: string,
     *                 material_count: int,
     *                 research_id: string[],
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_research(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_research_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/research.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_research_id'))
{
    function nexon_first_descendant_meta_research_id(string $id, ?string $locale = null): array
    {
        $cacheKey = 'nexon_first_descendant_meta_research_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_research();
            foreach ($list as $row)
            {
                $data[$row['research_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_reward'))
{
    /**
     * nexon_first_descendant_meta_amorphous_reward
     *
     * 비정형 물질 오픈 보상 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{
     *     array{
     *         amorphous_reward_id: string,
     *         open_reward: array{
     *             array{
     *                 reward_type: string,
     *                 required_stabilizer: string,
     *                 reward_item: array{
     *                     meta_type: string,
     *                     meta_id: string,
     *                     rate: string,
     *                 },
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_amorphous_reward(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_amorphous_reward';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('amorphous-reward.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_reward_id'))
{
    function nexon_first_descendant_meta_amorphous_reward_id(string $id): array
    {
        $cacheKey = 'nexon_first_descendant_meta_amorphous_reward_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_amorphous_reward();
            foreach ($list as $row)
            {
                $data[$row['amorphous_reward_id']] = $row['open_reward'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_reward_group'))
{
    /**
     * nexon_first_descendant_meta_amorphous_reward_group
     *
     * 비정형 물질 오픈 보상 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @deprecated 2025.01.09 https://openapi.nexon.com/ko/support/notice/2709232/
     *
     * @return array{
     *     array{
     *         amorphous_reward_group_id: string,
     *         reward_item: array{
     *             array{
     *                 meta_type: string,
     *                 meta_id: string,
     *                 rate: int,
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_amorphous_reward_group(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_amorphous_reward_group';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('amorphous-reward-group.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_reward_group_id'))
{
    /**
     * @deprecated 2025.01.09 https://openapi.nexon.com/ko/support/notice/2709232/
     */
    function nexon_first_descendant_meta_amorphous_reward_group_id(string $id): array
    {
        $cacheKey = 'nexon_first_descendant_meta_amorphous_reward_group_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_amorphous_reward_group();
            foreach ($list as $row)
            {
                $data[$row['amorphous_reward_group_id']] = $row['reward_item'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_open_condition_description'))
{
    /**
     * nexon_first_descendant_meta_amorphous_open_condition_description
     *
     * 비정형 물질 개봉 장소 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         amorphous_open_condition_id: string,
     *         amorphous_open_condition_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_amorphous_open_condition_description(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_amorphous_open_condition_description_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/amorphous-open-condition-description.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_amorphous_open_condition_description_id'))
{
    function nexon_first_descendant_meta_amorphous_open_condition_description_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_amorphous_open_condition_description_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_amorphous_open_condition_description($locale);
            foreach ($list as $row)
            {
                $data[$row['amorphous_open_condition_id']] = $row['amorphous_open_condition_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_acquisition_detail'))
{
    /**
     * nexon_first_descendant_meta_acquisition_detail
     *
     * 획득처 정보 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         acquisition_detail_id: string,
     *         acquisition_detail_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_acquisition_detail(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_acquisition_detail_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/acquisition-detail.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_acquisition_detail_id'))
{
    function nexon_first_descendant_meta_acquisition_detail_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_acquisition_detail_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_acquisition_detail($locale);
            foreach ($list as $row)
            {
                $data[$row['acquisition_detail_id']] = $row['acquisition_detail_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_weapon_type'))
{
    /**
     * nexon_first_descendant_meta_weapon_type
     *
     * 무기 유형 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         weapon_type: string,
     *         weapon_type_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_weapon_type(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_weapon_type_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/weapon-type.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_weapon_type_id'))
{
    function nexon_first_descendant_meta_weapon_type_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_weapon_type_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_weapon_type($locale);
            foreach ($list as $row)
            {
                $data[$row['weapon_type']] = $row['weapon_type_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_fellow'))
{
    /**
     * nexon_first_descendant_meta_fellow
     *
     * 조력자 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         fellow_id: string,
     *         fellow_name: string,
     *         fellow_tier_id: string,
     *         fellow_detail: array{
     *             array{
     *                 fellow_level: int,
     *                 search_radius_value: int,
     *                 stat_effect: array{
     *                     array{
     *                         stat_id: string,
     *                         stat_value: int,
     *                     },
     *                 },
     *             },
     *         },
     *     },
     * }
     */
    function nexon_first_descendant_meta_fellow(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_fellow_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/fellow.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_fellow_id'))
{
    function nexon_first_descendant_meta_fellow_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_fellow_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_fellow($locale);
            foreach ($list as $row)
            {
                $data[$row['fellow_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_fellow_level_detail'))
{
    /**
     * nexon_first_descendant_meta_fellow_level_detail
     *
     * 조력자 레벨별 필요 경험치 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         fellow_level: int,
     *         exp_per_level: int,
     *     },
     * }
     */
    function nexon_first_descendant_meta_fellow_level_detail(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_fellow_level_detail';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('fellow-level-detail.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_tier'))
{
    /**
     * nexon_first_descendant_meta_tier
     *
     * 등급 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{
     *     array{
     *         tier_id: string,
     *         tier_name: string,
     *     },
     * }
     */
    function nexon_first_descendant_meta_tier(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_tier_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/tier.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_tier_id'))
{
    function nexon_first_descendant_meta_tier_id(string $id, ?string $locale = null): string
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_tier_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_tier($locale);
            foreach ($list as $row)
            {
                $data[$row['tier_id']] = $row['tier_name'];
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? $id;
    }
}

if (! function_usable('nexon_first_descendant_meta_core_slot'))
{
    /**
     * nexon_first_descendant_meta_core_slot
     *
     * 코어 슬롯 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     * @since 2025.01.23
     *
     * @return array{array{
     *     core_slot_id: string,
     *     available_weapon: string[],
     *     available_core_type_id: string[],
     * }}
     */
    function nexon_first_descendant_meta_core_slot(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_core_slot';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('core-slot.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_core_slot_id'))
{
    function nexon_first_descendant_meta_core_slot_id(string $id): array
    {
        $cacheKey = 'nexon_first_descendant_meta_core_slot_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_core_slot();
            foreach ($list as $row)
            {
                $data[$row['core_slot_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_core_type'))
{
    /**
     * nexon_first_descendant_meta_core_type
     *
     * 코어 타입 메타데이터 정보를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     * @since 2025.01.23
     *
     * @param ?string $locale
     *
     * @return array{array{
     *     core_type_id: string,
     *     core_type: string,
     *     core_option: array{array{
     *         core_option_id: string,
     *         detail: array{array{
     *             core_option_grade: int,
     *             required_core_item: array{
     *                 meta_type: string,
     *                 meta_id: string,
     *                 count: int,
     *             },
     *         }},
     *         available_item_option: array{array{
     *             item_option: string,
     *             option_type: string,
     *             option_grade: string,
     *             option_effect: array{
     *                 stat_id: string,
     *                 operator_type: string,
     *                 min_stat_value: int,
     *                 max_stat_value: int,
     *             },
     *             rate: int,
     *         }},
     *     }},
     * }}
     */
    function nexon_first_descendant_meta_core_type(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_core_type_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/core-type.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_core_type_id'))
{
    function nexon_first_descendant_meta_core_type_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_core_type_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_core_type($locale);
            foreach ($list as $row)
            {
                $data[$row['core_type_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant_group'))
{
    /**
     * nexon_first_descendant_meta_descendant_group
     *
     * 계승자 그룹 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{array{
     *     descendant_group_id: string,
     *     descendant_group_name: string,
     * }}
     */
    function nexon_first_descendant_meta_descendant_group(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_descendant_group_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/descendant-group.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_descendant_group_id'))
{
    function nexon_first_descendant_meta_descendant_group_id(string $id, ?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_descendant_group_' . $locale . '_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_descendant_group($locale);
            foreach ($list as $row)
            {
                $data[$row['descendant_group_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_adapt_level'))
{
    /**
     * nexon_first_descendant_meta_adapt_level
     *
     * 적응도 레벨 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{array{
     *     level: int,
     *     exp_per_level: int,
     * }}
     */
    function nexon_first_descendant_meta_adapt_level(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_adapt_level';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('adapt-level.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_board_group'))
{
    /**
     * nexon_first_descendant_meta_arche_tuning_board_group
     *
     * 아르케 조율 보드 그룹 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{array{
     *     arche_tuning_board_group_id: string,
     *     descendant_group_id: string,
     *     arche_tuning_board_id: string,
     * }}
     */
    function nexon_first_descendant_meta_arche_tuning_board_group(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_board_group';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('arche-tuning-board-group.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_board_group_descendant_group_id'))
{
    function nexon_first_descendant_meta_arche_tuning_board_group_descendant_group_id(string $descendantGroupId): array
    {
        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_board_group_descendant_group_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_arche_tuning_board_group();
            foreach ($list as $row)
            {
                $data[$row['descendant_group_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$descendantGroupId] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_board'))
{
    /**
     * nexon_first_descendant_meta_arche_tuning_board
     *
     * 아르케 조율 보드 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @return array{array{
     *     arche_tuning_board_id: string,
     *     row_size: int,
     *     column_size: int,
     *     node: array{array{
     *         node_id: string,
     *         position_row: int,
     *         position_column: int,
     *     }},
     * }}
     */
    function nexon_first_descendant_meta_arche_tuning_board(): array
    {
        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_board';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url('arche-tuning-board.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_board_id'))
{
    function nexon_first_descendant_meta_arche_tuning_board_id(string $id): array
    {
        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_board_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_arche_tuning_board();
            foreach ($list as $row)
            {
                $data[$row['arche_tuning_board_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_node'))
{
    /**
     * nexon_first_descendant_meta_arche_tuning_node
     *
     * 아르케 조율 노드 메타데이터를 조회합니다.
     *
     * @link https://openapi.nexon.com/ko/game/tfd/?id=21
     *
     * @param ?string $locale
     *
     * @return array{array{
     *     node_id: string,
     *     node_name: string,
     *     node_image_url: string,
     *     node_type: string,
     *     tier_id: string,
     *     required_tuning_point: int,
     *     node_effect: array{array{
     *         stat_id: string,
     *         stat_value: int,
     *         operator_type: string,
     *     }},
     * }}
     */
    function nexon_first_descendant_meta_arche_tuning_node(?string $locale = null): array
    {
        if (is_null($locale))
        {
            $locale = \Config\Services::request()->getLocale();
        }

        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_node_' . $locale;
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $url = nexon_first_descendant_meta_url($locale . '/arche-tuning-node.json');
            $data = curl_request()->get($url)->getBody();
            cache()->save($cacheKey, $data, DAY);
        }

        return json_decode($data, true);
    }
}

if (! function_usable('nexon_first_descendant_meta_arche_tuning_node_id'))
{
    function nexon_first_descendant_meta_arche_tuning_node_id(string $id): array
    {
        $cacheKey = 'nexon_first_descendant_meta_arche_tuning_node_id';
        $data = cache()->get($cacheKey);
        if (is_null($data))
        {
            $data = [];
            $list = nexon_first_descendant_meta_arche_tuning_node();
            foreach ($list as $row)
            {
                $data[$row['node_id']] = $row;
            }
            cache()->save($cacheKey, $data, DAY);
        }

        return $data[$id] ?? [];
    }
}
