<?php
namespace Modules\Nexon\Baram\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonBaramApi(bool $getShared = true): \Modules\Nexon\Baram\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonBaramApi');
            if ($service instanceof \Modules\Nexon\Baram\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_baram_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\Baram\Libraries\Api($apiKey);
    }
}
