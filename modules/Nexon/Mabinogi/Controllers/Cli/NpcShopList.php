<?php
namespace Modules\Nexon\Mabinogi\Controllers\Cli;

use Exception;
use Modules\Nexon\Mabinogi\Controllers\BaseController;

class NpcShopList extends BaseController
{
    private \Modules\Nexon\Mabinogi\Libraries\Api $api;

    private \Modules\Nexon\Mabinogi\Models\NpcShopList $mNpcShopList;

    public function index(string $serverName): void
    {
        $this->api = nexon_mabinogi_services_api();
        $this->mNpcShopList = model(\Modules\Nexon\Mabinogi\Models\NpcShopList::class);

        $eNpcShopList = $this->mNpcShopList
            ->where('server_name', $serverName)
            ->where('npc_name', '델')
            ->where('channel', 1)
            ->findAll()[0] ?? null
        ;
        if (is_null($eNpcShopList))
        {
            $this->first();
            exit;
        }

        if ($eNpcShopList->date_shop_next_update->getTimestamp() < time())
        {
            $list = $this->mNpcShopList
                ->where('server_name', $serverName)
                ->where('date_shop_next_update <', date('Y-m-d H:i:s', strtotime('-5 minutes')))
                ->findAll()
            ;
            foreach ($list as $eNpcShopList)
            {
                try
                {
                    $response = $this->api->getNpcShopList($eNpcShopList->npc_name, $eNpcShopList->server_name, $eNpcShopList->channel);
                    $this->mNpcShopList
                        ->set('date_inquire', date('Y-m-d H:i:s', strtotime($response['date_inquire'])))
                        ->set('date_shop_next_update', date('Y-m-d H:i:s', strtotime($response['date_shop_next_update'])))
                        ->where('id', $eNpcShopList->id)
                        ->update()
                    ;
                    $this->update($eNpcShopList->id, $response);
                }
                catch (Exception $e)
                {
                    // 사라진 채널(혹은 서버나 NPC)
                    // $this->mNpcShopList->delete($eNpcShopList->id);
                    break;
                }
            }
        }
    }

    /**
     * first
     *
     * 맨처음에 DB 밀어 넣을때 실행
     *
     * @return void
     */
    private function first(): void
    {
        $uniqueKeyToIds = $this->mNpcShopList->findAllUniqueKeyToIds();

        $cApi = nexon_mabinogi_config_api();
        foreach ($cApi->serverNames as $serverName)
        {
            foreach ($cApi->npcNames as $npcName)
            {
                if (!($serverName === '울프' && $npcName === '피오나트'))
                {
                    continue;
                }
                for ($i = 1; $i <= 50; $i++)
                {
                    // 하우징 채널 제외
                    if ($i === 11)
                    {
                        continue;
                    }

                    try
                    {
                        $response = $this->api->getNpcShopList($npcName, $serverName, $i);

                        if (! isset($uniqueKeyToIds[$serverName][$npcName][$i]))
                        {
                            $this->mNpcShopList
                                ->set('server_name', $serverName)
                                ->set('npc_name', $npcName)
                                ->set('channel', $i)
                                ->set('date_inquire', date('Y-m-d H:i:s', strtotime($response['date_inquire'])))
                                ->set('date_shop_next_update', date('Y-m-d H:i:s', strtotime($response['date_shop_next_update'])))
                                ->insert()
                            ;
                            $id = $this->mNpcShopList->getInsertID();
                        }
                        else
                        {
                            $id = $uniqueKeyToIds[$serverName][$npcName][$i];
                            $this->mNpcShopList
                                ->set('date_inquire', date('Y-m-d H:i:s', strtotime($response['date_inquire'])))
                                ->set('date_shop_next_update', date('Y-m-d H:i:s', strtotime($response['date_shop_next_update'])))
                                ->set('deleted_at', null)
                                ->where('id', $id)
                                ->update()
                            ;
                        }

                        $this->update($id, $response);
                    }
                    catch (Exception $e)
                    {
                        // 데이터가 없는 채널은 존재하지 않는 채널 or DB 오류
                        break;
                    }
                }
            }
        }
    }

    private function update(int $id, array $response): void
    {
        $mNpcShopListShopItem = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItem::class);
        $mNpcShopListShopItem->where('npc_shop_list_id', $id)->delete();

        $mNpcShopListShopItemOption = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItemOption::class);
        $mNpcShopListShopItemOption->where('npc_shop_list_id', $id)->delete();

        $mNpcShopListShopItemColorPart = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItemColorPart::class);
        $mNpcShopListShopItemColorPart->where('npc_shop_list_id', $id)->delete();

        $cntItem = 1;
        $dataItemColorPart = $dataItemOption = $dataItem = [];
        foreach ($response['shop'] as $rowShop)
        {
            foreach ($rowShop['item'] as $rowItem)
            {
                // 기본 정보 설정
                $dataItem[] = [
                    'npc_shop_list_id'  => $id,
                    'id'                => $cntItem,
                    'tab_name'          => $rowShop['tab_name'],
                    'item_display_name' => $rowItem['item_display_name'],
                    'item_count'        => $rowItem['item_count'],
                    'limit_type'        => $rowItem['limit_type'],
                    'limit_value'       => $rowItem['limit_value'],
                    'image_url'         => $rowItem['image_url'],
                    'price_type'        => $rowItem['price'][0]['price_type'],
                    'price_value'       => $rowItem['price'][0]['price_value'],
                ];

                $cntItemOption = 1;
                foreach ($rowItem['item_option'] as $rowItemOption)
                {
                    // 옵션 정보 설정
                    $dataItemOption[] = [
                        'npc_shop_list_id'              => $id,
                        'npc_shop_list_shop_item_id'    => $cntItem,
                        'id'                            => $cntItemOption,
                        'option_type'                   => $rowItemOption['option_type'],
                        'option_sub_type'               => $rowItemOption['option_sub_type'],
                        'option_value'                  => $rowItemOption['option_value'],
                        'option_value2'                 => $rowItemOption['option_value2'],
                        'option_desc'                   => $rowItemOption['option_desc'],
                    ];

                    // 색상 정보 설정
                    if ($rowItemOption['option_type'] === '아이템 색상')
                    {
                        switch ($rowItemOption['option_sub_type'])
                        {
                            case '파트 A':
                                $dataItemColorPart[$cntItem] = [
                                    'npc_shop_list_id'              => $id,
                                    'npc_shop_list_shop_item_id'    => $cntItem,

                                    'a_r'   => '',
                                    'a_g'   => '',
                                    'a_b'   => '',
                                    'b_r'   => '',
                                    'b_g'   => '',
                                    'b_b'   => '',
                                    'c_r'   => '',
                                    'c_g'   => '',
                                    'c_b'   => '',
                                ];

                                list(
                                    $dataItemColorPart[$cntItem]['a_r'],
                                    $dataItemColorPart[$cntItem]['a_g'],
                                    $dataItemColorPart[$cntItem]['a_b']
                                ) = explode(',', $rowItemOption['option_value']);
                                break;
                            case '파트 B':
                                list(
                                    $dataItemColorPart[$cntItem]['b_r'],
                                    $dataItemColorPart[$cntItem]['b_g'],
                                    $dataItemColorPart[$cntItem]['b_b']
                                    ) = explode(',', $rowItemOption['option_value']);
                                break;
                            case '파트 C':
                                list(
                                    $dataItemColorPart[$cntItem]['c_r'],
                                    $dataItemColorPart[$cntItem]['c_g'],
                                    $dataItemColorPart[$cntItem]['c_b']
                                    ) = explode(',', $rowItemOption['option_value']);
                                break;
                        }
                    }

                    $cntItemOption++;
                }

                $cntItem++;
            }
        }

        try
        {
            if (count($dataItem) > 0)
            {
                $db = db_connect();
                $db->transStart();

                $mNpcShopListShopItem->insertBatch($dataItem);

                if (count($dataItemOption) > 0)
                {
                    $mNpcShopListShopItemOption->insertBatch($dataItemOption);

                    if (count($dataItemColorPart) > 0)
                    {
                        $mNpcShopListShopItemColorPart->insertBatch($dataItemColorPart);
                    }
                }

                $db->transComplete();
            }
        }
        catch (\ReflectionException $e)
        {}
    }
}
