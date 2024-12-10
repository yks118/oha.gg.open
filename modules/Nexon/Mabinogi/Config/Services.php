<?php
namespace Modules\Nexon\Mabinogi\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonMabinogiApi(bool $getShared = true): \Modules\Nexon\Mabinogi\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonMabinogiApi');
            if ($service instanceof \Modules\Nexon\Mabinogi\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_mabinogi_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\Mabinogi\Libraries\Api($apiKey);
    }
}
