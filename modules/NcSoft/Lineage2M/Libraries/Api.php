<?php
namespace Modules\NcSoft\Lineage2M\Libraries;

use Exception;

class Api extends \Modules\NcSoft\Core\Libraries\Api
{
    protected string $urlPrefix = 'l2m/v1.0/';

    public function __construct(string $api)
    {
        parent::__construct($api);
    }

    /**
     * getMarketServers
     *
     * 서버 목록을 조회합니다.
     *
     * @link https://developers.plaync.com/apis/l2m/server
     *
     * @return array{
     *     array{
     *         world_name: string,
     *         world_id: int,
     *         servers: array{
     *             array{
     *                 server_id: int,
     *                 server_name: string,
     *             },
     *         },
     *     },
     * }
     *
     * @throws Exception
     */
    public function getMarketServers(): array
    {
        $url = 'market/servers';
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
     * getMarketItemsSearch
     *
     * 거래소 아이템을 검색합니다.
     *
     * @link https://developers.plaync.com/apis/l2m/search
     *
     * @param string    $searchKeyword      검색할 아이템 이름
     * @param int       $serverId           서버 아이디. 전체 서버 조회시 설정하지 않습니다.
     * @param int       $fromEnchantLevel   최소 강화수치
     * @param int       $toEnchantLevel     최대 강화수치
     * @param bool      $sale               현재 판매 여부. 설정하지 않을 경우 false 입니다.
     * @param int       $page               현재 페이지
     * @param int       $size               조회되는 결과 수. 설정하지 않을 경우 10건이 조회되며, 최대 30건입니다.
     *
     * @return array{
     *     contents: array{
     *         array{
     *             item_id: int,
     *             item_name: string,
     *             server_id: int,
     *             server_name: string,
     *             world: bool,
     *             enchant_level: int,
     *             grade: int,
     *             image: string,
     *             now_min_unit_price: int,
     *             avg_unit_price: int,
     *         },
     *     },
     *     pagination: array{
     *         page: int,
     *         size: int,
     *         last_page: int,
     *         total: int,
     *         limit: int,
     *     },
     * }
     *
     * @throws Exception
     */
    public function getMarketItemsSearch(string $searchKeyword = '', int $serverId = 0, int $fromEnchantLevel = 0, int $toEnchantLevel = 0, bool $sale = false, int $page = 1, int $size = 10): array
    {
        $url = 'market/items/search';

        $queries = [];
        if ($searchKeyword)
        {
            $queries['search_keyword'] = $searchKeyword;
        }

        if ($serverId)
        {
            $queries['server_id'] = $serverId;
        }

        if ($fromEnchantLevel)
        {
            $queries['from_enchant_level'] = $fromEnchantLevel;
        }

        if ($toEnchantLevel)
        {
            $queries['to_enchant_level'] = $toEnchantLevel;
        }

        $queries['sale'] = $sale ? 'true' : 'false';
        $queries['page'] = $page;
        $queries['size'] = $size;
        $url .= '?' . http_build_query($queries);
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
     * getMarketItems
     *
     * 아이템 정보를 조회합니다.
     *
     * @link https://developers.plaync.com/apis/l2m/data
     *
     * @param int $itemId       아이템 아이디
     * @param int $enchantLevel 강화 수치
     *
     * @return array{
     *     item_id: int,
     *     item_name: string,
     *     enchant_level: int,
     *     grade: string,
     *     grade_name: string,
     *     image: string,
     *     trade_category_name: string,
     *     options: array{
     *         array{
     *             option_name: string,
     *             display: string,
     *             extra_display: string,
     *         },
     *     },
     *     attribute: array{
     *         safe_enchant_level: int,
     *         tradeable: bool,
     *         enchantable: bool,
     *         droppable: bool,
     *         storable: bool,
     *         description: string,
     *         weight: int,
     *         material_name: string,
     *         collection_count: int,
     *     },
     * }
     *
     * @throws Exception
     */
    public function getMarketItems(int $itemId, int $enchantLevel = 0): array
    {
        $url = 'market/items/' . $itemId;
        if ($enchantLevel)
        {
            $url .= '?enchant_level=' . $enchantLevel;
        }

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
     * getMarketItemsPrice
     *
     * 아이템 가격 통계를 조회합니다.
     *
     * @link https://developers.plaync.com/apis/l2m/price
     *
     * @param int $itemId       아이템 아이디
     * @param int $enchantLevel 강화 수치
     * @param int $serverId     서버 아이디. 전체 서버 조회시 설정하지 않습니다.
     *
     * @return array{
     *     server_id: int,
     *     item_id: int,
     *     enchant_level: int,
     *     now: array{
     *         unit_price: int,
     *     },
     *     min: array{
     *         unit_price: int,
     *     },
     *     max: array{
     *         unit_price: int,
     *     },
     *     last: array{
     *         unit_price: int,
     *     },
     *     avg: array{
     *         unit_price: int,
     *     },
     * }
     *
     * @throws Exception
     */
    public function getMarketItemsPrice(int $itemId, int $enchantLevel = 0, int $serverId = 0): array
    {
        $url = 'market/items/' . $itemId . '/price';

        $queries = [];
        if ($enchantLevel)
        {
            $queries['enchant_level'] = $enchantLevel;
        }

        if ($serverId)
        {
            $queries['server_id'] = $serverId;
        }

        $url .= '?' . http_build_query($queries);
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
