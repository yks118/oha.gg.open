<?php

if (! function_usable('nexon_mabinogi_config_api'))
{
    function nexon_mabinogi_config_api(): \Modules\Nexon\Mabinogi\Config\Api
    {
        return config(\Modules\Nexon\Mabinogi\Config\Api::class);
    }
}

if (! function_usable('nexon_mabinogi_services_api'))
{
    function nexon_mabinogi_services_api(): \Modules\Nexon\Mabinogi\Libraries\Api
    {
        return \Modules\Nexon\Mabinogi\Config\Services::nexonMabinogiApi();
    }
}

if (! function_usable('nexon_mabinogi_insert_item_data'))
{
    /**
     * nexon_mabinogi_insert_item_data
     *
     * @param array $rowItem
     * @param string $serialize
     * @param string $md5
     * @param int $keyItem
     *
     * @return array{item: array, itemOption: array, itemColorPart: array}
     */
    function nexon_mabinogi_insert_item_data(array $rowItem, string $serialize, string $md5, int $keyItem): array
    {
        $uuid = uuid();
        $dataInsertItem = [
            'uuid'              => $uuid,
            'md5'               => $md5,
            'serialize'         => $serialize,
            'item_name'         => $rowItem['item_name'],
            'item_display_name' => $rowItem['item_display_name'],
        ];

        $dataInsertItemColorPart = $dataInsertItemOption = [];
        if (is_array($rowItem['item_option']))
        {
            $keyItemOption = 1;
            foreach ($rowItem['item_option'] as $rowItemOption)
            {
                $dataInsertItemOption[] = [
                    'item_uuid'         => $uuid,
                    'id'                => $keyItemOption,
                    'option_type'       => $rowItemOption['option_type'],
                    'option_sub_type'   => $rowItemOption['option_sub_type'] ?? '',
                    'option_value'      => $rowItemOption['option_value'],
                    'option_value2'     => $rowItemOption['option_value2'] ?? '',
                    'option_desc'       => $rowItemOption['option_desc'] ?? '',
                ];

                // Ex. 염색 앰플
                if ($rowItemOption['option_type'] === '색상')
                {
                    list($r, $g, $b) = explode(',', $rowItemOption['option_value']);
                    $dataInsertItemColorPart[$keyItem] = [
                        'item_uuid' => $uuid,
                        'a_r'       => $r,
                        'a_g'       => $g,
                        'a_b'       => $b,
                    ];
                }
                // Ex. 염색된 아이템
                elseif ($rowItemOption['option_type'] === '아이템 색상' && $rowItemOption['option_value'])
                {
                    $part = strtolower(mb_substr($rowItemOption['option_sub_type'], -1));
                    list($r, $g, $b) = explode(',', $rowItemOption['option_value']);
                    if (! isset($dataInsertItemColorPart[$keyItem]))
                    {
                        $dataInsertItemColorPart[$keyItem] = [
                            'item_uuid' => $uuid,
                            'a_r' => '', 'a_g' => '', 'a_b' => '',
                            'b_r' => '', 'b_g' => '', 'b_b' => '',
                            'c_r' => '', 'c_g' => '', 'c_b' => '',
                            'd_r' => '', 'd_g' => '', 'd_b' => '',
                            'e_r' => '', 'e_g' => '', 'e_b' => '',
                            'f_r' => '', 'f_g' => '', 'f_b' => '',
                        ];
                    }

                    $dataInsertItemColorPart[$keyItem][$part . '_r'] = $r;
                    $dataInsertItemColorPart[$keyItem][$part . '_g'] = $g;
                    $dataInsertItemColorPart[$keyItem][$part . '_b'] = $b;
                }

                $keyItemOption++;
            }
        }

        return [
            'uuid'          => $uuid,
            'item'          => $dataInsertItem,
            'itemOption'    => $dataInsertItemOption,
            'itemColorPart' => $dataInsertItemColorPart,
        ];
    }
}

if (! function_usable('nexon_mabinogi_insert_item'))
{
    /**
     * @throws ReflectionException
     */
    function nexon_mabinogi_insert_item(array $rowItem, string $serialize, string $md5, int $keyItem): void
    {
        $data = nexon_mabinogi_insert_item_data($rowItem, $serialize, $md5, $keyItem);

        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $mItem->insert($data['item']);

        if (count($data['itemOption']) > 0)
        {
            $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
            $mItemOption->insertBatch($data['itemOption']);
        }

        if (count($data['itemColorPart']) > 0)
        {
            $mItemColorPart = model(\Modules\Nexon\Mabinogi\Models\ItemColorPart::class);
            $mItemColorPart->insertBatch($data['itemColorPart']);
        }
    }
}

if (! function_usable('nexon_mabinogi_delete_item'))
{
    function nexon_mabinogi_delete_item(string $uuid): void
    {
        $db = db_connect();
        $db->transException(true)->transStart();

        $mItem = model(\Modules\Nexon\Mabinogi\Models\Item::class);
        $mItem->delete($uuid);

        $mItemOption = model(\Modules\Nexon\Mabinogi\Models\ItemOption::class);
        $mItemOption
            ->where('item_uuid', $uuid)
            ->where('id !=', '')
            ->delete()
        ;

        $mItemColorPart = model(\Modules\Nexon\Mabinogi\Models\ItemColorPart::class);
        $mItemColorPart->delete($uuid);

        $db->transComplete();
    }
}

if (! function_usable('nexon_mabinogi_sales_commission_api'))
{
    /**
     * @throws Exception
     */
    function nexon_mabinogi_sales_commission_api(): array
    {
        $cacheKey = 'sales_commission_api';
        $items = cache()->get($cacheKey);
        if (is_null($items))
        {
            $api = nexon_mabinogi_services_api();
            $response = $api->getAuctionKeywordSearch('경매장 수수료,할인 쿠폰');

            $itemNames = array_column($response['auction_item'], 'item_name');
            $itemNames = array_unique($itemNames);
            $itemNames = array_diff($itemNames, ['경매장 수수료 100% 할인 쿠폰']);
            sort($itemNames);
            $itemNames[] = '경매장 수수료 100% 할인 쿠폰';

            $items = array_map(
                function ($itemName)
                {
                    return [
                        'item_name' => $itemName,
                        'min' => 0,
                    ];
                },
                $itemNames
            );

            $itemNames = array_flip($itemNames);
            foreach ($response['auction_item'] as $rowItem)
            {
                $min = $items[$itemNames[$rowItem['item_name']]]['min'];
                $items[$itemNames[$rowItem['item_name']]]['min'] = empty($min)
                    ? $rowItem['auction_price_per_unit']
                    : min($min, $rowItem['auction_price_per_unit'])
                ;
            }

            cache()->save($cacheKey, $items, MINUTE);
        }

        return $items;
    }
}
