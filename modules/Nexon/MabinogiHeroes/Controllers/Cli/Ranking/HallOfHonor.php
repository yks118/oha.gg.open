<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Cli\Ranking;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class HallOfHonor extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        // 데이터가 09시에 한번만 갱신되기 때문에, 09시 05분에 갱신
        if (date('Hi') !== '0905')
        {
            exit;
        }
    }

    public function index(): void
    {
        $api = nexon_mabinogi_heroes_services_api();
        $mRankingHallOfHonor = model(\Modules\Nexon\MabinogiHeroes\Models\RankingHallOfHonor::class);
        $db = db_connect();

        try
        {
            $date = date('Y-m-d');
            for ($i = 0; $i <= 1; $i++)
            {
                $response = $api->getRankingHallOfHonor($i);
                $dataInsert = array_map(
                    function($row) use($date)
                    {
                        return array_merge(['date' => $date], $row);
                    },
                    $response['ranking']
                );

                $db->transStart();
                $mRankingHallOfHonor->insertBatch($dataInsert);
                $db->transComplete();
            }
        }
        catch (\Exception $e)
        {
            die('[' . $e->getLine() . '] ' . $e->getMessage());
        }
    }
}
