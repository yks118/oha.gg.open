<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Cli\Marketplace;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class GoldTop extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        // 데이터가 어떻게 갱신되는지 모르겠으니, 마지막에 갱신하도록..
        if (date('Hi') !== '2359')
        {
            exit;
        }
    }

    public function index(): void
    {
        try
        {
            $api = nexon_mabinogi_heroes_services_api();
            $mMarketplaceGoldTop = model(\Modules\Nexon\MabinogiHeroes\Models\MarketplaceGoldTop::class);

            $today = date('Y-m-d');
            $data = [
                [
                    'date'  => $today,
                    'type'  => 'b',
                    'data'  => array_map(
                        function (array $row)
                        {
                            return [
                                'cairde_name'   => $row['cairde_name'],
                                'gold'          => $row['buy_gold'],
                            ];
                        },
                        $api->getMarketplaceGoldMarketBuyTop30()['buy_gold']
                    ),
                ],
                [
                    'date'  => $today,
                    'type'  => 's',
                    'data'  => array_map(
                        function (array $row)
                        {
                            return [
                                'cairde_name'   => $row['cairde_name'],
                                'gold'          => $row['sell_gold'],
                            ];
                        },
                        $api->getMarketplaceGoldMarketSellTop30()['sell_gold']
                    ),
                ],
            ];
            $mMarketplaceGoldTop->insertBatch($data);
        }
        catch (\Exception $e)
        {
            die('[' . __FILE__ . '][' . $e->getLine() . '] ' . $e->getMessage());
        }
    }
}
