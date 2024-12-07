<?php
namespace Modules\Nexon\MabinogiHeroes\Controllers\Cli\Ranking;

use Modules\Nexon\MabinogiHeroes\Controllers\BaseController;

class RealTime extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        // 데이터가 한시간에 한번만 갱신되기 때문에 05분에 갱신
        if (date('i') !== '05')
        {
            exit;
        }
    }

    public function index(): void
    {
        $api = nexon_mabinogi_heroes_services_api();
        $cApi = nexon_mabinogi_heroes_config_api();
        $mRankingRealTime = model(\Modules\Nexon\MabinogiHeroes\Models\RankingRealTime::class);
        $db = db_connect();

        try
        {
            for ($i = 0; $i <= 1; $i++)
            {
                $dataInsert = [];
                for ($pageNo = 1; $pageNo <= $cApi->rankingRealTimePageNo[$i]; $pageNo++)
                {
                    $response = $api->getRankingRealTime($i, $pageNo);
                    $dataInsert = array_merge($dataInsert, $response['ranking']);
                }

                $db->transStart();
                $mRankingRealTime->where('ranking_type', $i)->delete();
                $mRankingRealTime->insertBatch($dataInsert);
                $db->transComplete();
            }
        }
        catch (\Exception $e)
        {
            die('[' . $e->getLine() . '] ' . $e->getMessage());
        }
    }
}
