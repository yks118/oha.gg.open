<?php
namespace Modules\Nexon\KartRiderRushPlus\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonKartRiderRushPlusApi(bool $getShared = true): \Modules\Nexon\KartRiderRushPlus\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonKartRiderRushPlusApi');
            if ($service instanceof \Modules\Nexon\KartRiderRushPlus\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_kart_rider_rush_plus_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\KartRiderRushPlus\Libraries\Api($apiKey);
    }
}
