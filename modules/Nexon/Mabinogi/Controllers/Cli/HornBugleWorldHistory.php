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

        $serverNames = $cApi->serverNames;
        foreach ($serverNames as $serverName)
        {
            $eHornBugleWorldHistory = $mHornBugleWorldHistory
                ->where('server_name', $serverName)
                ->orderBy('date_send', 'DESC')
                ->findAll(1)[0] ?? null
            ;
            $checkTime = is_null($eHornBugleWorldHistory) ? 0 : $eHornBugleWorldHistory->date_send->getTimestamp();
            $checkPKs = [];

            try
            {
                $response = $api->getHornBugleWorld($serverName);

                $data = [];
                foreach ($response['horn_bugle_world_history'] as $row)
                {
                    $rowTime = strtotime($row['date_send']);
                    if ($checkTime < $rowTime)
                    {
                        $pk = base64_encode($serverName . '_' . $rowTime . '_' . $row['character_name']);
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

                if (count($data) > 0)
                {
                    $mHornBugleWorldHistory->insertBatch($data);
                }
            }
            catch (\Exception $e)
            {
                die($e->getMessage());
            }
        }
    }
}
