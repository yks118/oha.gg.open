<?php
namespace Modules\Nexon\BaramY\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonBaramYApi(bool $getShared = true): \Modules\Nexon\BaramY\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonBaramYApi');
            if ($service instanceof \Modules\Nexon\BaramY\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_baram_y_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\BaramY\Libraries\Api($apiKey);
    }
}
