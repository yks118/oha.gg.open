<?php
namespace Modules\Nexon\Mabinogi\Libraries;

use Exception;

class Api extends \Modules\Nexon\Core\Libraries\Api
{
    protected string $urlPrefix = 'mabinogi/v1/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getNpcShopList
     *
     * NPC가 상점에서 판매하는 아이템 목록을 조회합니다.
     * 마비노기의 게임 데이터는 평균 10분 후 확인 가능합니다.
     * 마비노기의 상점 정보는 36분마다 변경됩니다.
     *
     * 갱신시간(~ 갱신 완료 시점(약 5분)까지)에는 데이터를 리턴해주지 않음
     *
     * @link https://openapi.nexon.com/game/mabinogi/?id=32
     *
     * @param string $npcName \Modules\Nexon\Mabinogi\Config\Api::$npcNames
     * @param string $serverName \Modules\Nexon\Mabinogi\Config\Api::$serverNames
     * @param int $channel
     *
     * @return array{
     *     shop_tab_count: int,
     *     shop: array{
     *         array{
     *             tab_name: string,
     *             item: array{
     *                 array{
     *                     item_display_name: string,
     *                     item_count: int,
     *                     item_option: array{
     *                         array{
     *                             option_type: string,
     *                             option_sub_type: string,
     *                             option_value: string,
     *                             option_value2: string,
     *                             option_desc: string,
     *                         },
     *                     },
     *                     price: array{
     *                         array{
     *                             price_type: string,
     *                             price_value: int,
     *                         },
     *                     },
     *                     limit_type: string,
     *                     limit_value: int,
     *                     image_url: string,
     *                 },
     *             },
     *         },
     *     },
     *     date_inquire: string,
     *     date_shop_next_update: string,
     * }
     *
     * @throws Exception
     */
    public function getNpcShopList(string $npcName, string $serverName, int $channel): array
    {
        $url = 'npcshop/list?npc_name=' . $npcName . '&server_name=' . $serverName . '&channel=' . $channel;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getAuctionList
     *
     * 현재 경매장에서 판매중인 매물 리스트 조회
     *
     * @link https://openapi.nexon.com/game/mabinogi/?id=33
     *
     * @param string $auctionItemCategory \Modules\Nexon\Mabinogi\Config\Api::$auctionItemCategories
     * @param string $itemName auction_item_category, item_name 둘중 하나는 필수
     * @param string $cursor 검색 페이지
     *
     * @return array{
     *     auction_item: array{
     *         array{
     *             item_name: string,
     *             item_display_name: string,
     *             item_count: int,
     *             auction_price_per_unit: int,
     *             date_auction_expire: string,
     *             item_option: array{
     *                 array{
     *                     option_type: string,
     *                     option_sub_type: string,
     *                     option_value: string,
     *                     option_value2: string,
     *                     option_desc: string,
     *                 },
     *             },
     *         },
     *     },
     *     next_cursor: string,
     * }
     *
     * @throws Exception
     */
    public function getAuctionList(string $auctionItemCategory = '', string $itemName = '', string $cursor = ''): array
    {
        if (empty($auctionItemCategory) && empty($itemName))
        {
            $this->error(
                [
                    'error' => [
                        'name'      => '파라미터 오류',
                        'message'   => 'auction_item_category 혹은 item_name 는 필수로 입력되어야 합니다.',
                    ],
                ],
                400
            );
        }

        $params = [];
        if ($auctionItemCategory)
        {
            $params['auction_item_category'] = $auctionItemCategory;
        }

        if ($itemName)
        {
            $params['item_name'] = $itemName;
        }

        if ($cursor)
        {
            $params['cursor'] = $cursor;
        }

        $url = 'auction/list?' . http_build_query($params);
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getAuctionHistory
     *
     * 경매장 거래 내역 조회
     * 1시간 이내에 팔린 물품만 리턴..
     *
     * @link https://openapi.nexon.com/game/mabinogi/?id=33
     *
     * @param string $auctionItemCategory \Modules\Nexon\Mabinogi\Config\Api::$auctionItemCategories
     * @param string $itemName auction_item_category, item_name 둘중 하나는 필수
     * @param string $cursor 검색 페이지
     *
     * @return array{
     *     auction_history: array{
     *         array{
     *             item_name: string,
     *             item_display_name: string,
     *             item_count: int,
     *             auction_price_per_unit: int,
     *             date_auction_buy: string,
     *             auction_buy_id: string,
     *             item_option: array{
     *                 array{
     *                     option_type: string,
     *                     option_sub_type: string,
     *                     option_value: string,
     *                     option_value2: string,
     *                     option_desc: string,
     *                 },
     *             },
     *         },
     *     },
     *     next_cursor: string,
     * }
     *
     * @throws Exception
     */
    public function getAuctionHistory(string $auctionItemCategory = '', string $itemName = '', string $cursor = ''): array
    {
        if (empty($auctionItemCategory) && empty($itemName))
        {
            $this->error(
                [
                    'error' => [
                        'name'      => '파라미터 오류',
                        'message'   => 'auction_item_category 혹은 item_name 는 필수로 입력되어야 합니다.',
                    ],
                ],
                400
            );
        }

        $params = [];
        if ($auctionItemCategory)
        {
            $params['auction_item_category'] = $auctionItemCategory;
        }

        if ($itemName)
        {
            $params['item_name'] = $itemName;
        }

        if ($cursor)
        {
            $params['cursor'] = $cursor;
        }

        $url = 'auction/history?' . http_build_query($params);
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }

    /**
     * getHornBugleWorld
     *
     * 1시간동안의 이력을 리턴해줌
     *
     * @link https://openapi.nexon.com/game/mabinogi/?id=34
     *
     * @param string $serverName \Modules\Nexon\Mabinogi\Config\Api::$serverNames
     *
     * @return array{
     *     horn_bugle_world_history: array{
     *         array{
     *             character_name: string,
     *             message: string,
     *             date_send: string,
     *         }
     *     }
     * }
     *
     * @throws Exception
     */
    public function getHornBugleWorld(string $serverName): array
    {
        $url = 'horn-bugle-world/history?server_name=' . $serverName;
        $response = $this->client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody(), true);
        if ($statusCode === 200)
        {
            return $data;
        }

        $this->error($data, $statusCode);
    }
}
