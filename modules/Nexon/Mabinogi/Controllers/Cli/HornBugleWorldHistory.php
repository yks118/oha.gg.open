<?php
namespace Modules\Nexon\Mabinogi\Controllers\Cli;

use Modules\Nexon\Mabinogi\Controllers\BaseController;

class HornBugleWorldHistory extends BaseController
{
    public function index(): void
    {
        $api = nexon_mabinogi_services_api();
        $cApi = nexon_mabinogi_config_api();
        $mHornBugleWorldHistory = model(\Modules\Nexon\Mabinogi\Models\HornBugleWorldHistory::class);

        $serverCheckTimes = [];
        $list = $mHornBugleWorldHistory
            ->where('date_send >=', date('Y-m-d H:i:s', strtotime('-1 hour')))
            ->groupBy('server_name')
            ->findAll()
        ;
        foreach ($list as $eHornBugleWorldHistory)
        {
            $serverCheckTimes[$eHornBugleWorldHistory->server_name] = $eHornBugleWorldHistory->date_send->getTimestamp();
        }

        $data = [];
        $serverNames = $cApi->serverNames;
        foreach ($serverNames as $serverName)
        {
            $checkTime = $serverCheckTimes[$serverName] ?? 0;
            $checkPKs = [];

            try
            {
                $response = $api->getHornBugleWorld($serverName);

                foreach ($response['horn_bugle_world_history'] as $row)
                {
                    $rowTime = strtotime($row['date_send']);
                    if ($checkTime < $rowTime)
                    {
                        $pk = base64_encode(
                            $serverName
                            . '_' . $rowTime
                            . '_' . $row['character_name']
                        );
                        if (! isset($checkPKs[$pk]))
                        {
                            $checkPKs[$pk] = 0;
                        }
                        else
                        {
                            $checkPKs[$pk]++;
                        }

                        $data[] = [
                            'server_name'       => $serverName,
                            'date_send'         => date('Y-m-d H:i:s', $rowTime),
                            'character_name'    => $row['character_name'],
                            'index'             => $checkPKs[$pk],
                            'message'           => $row['message'],
                        ];
                    }
                }
            }
            catch (\Exception $e)
            {
                print_r($response);
                die($e->getMessage());
            }
        }

        if (count($data) > 0)
        {
            try
            {
                $mHornBugleWorldHistory->insertBatch($data);
            }
            catch (\ReflectionException $e)
            {}
        }
    }
}
