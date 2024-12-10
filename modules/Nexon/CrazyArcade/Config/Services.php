<?php
namespace Modules\Nexon\CrazyArcade\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonCrazyArcadeApi(bool $getShared = true): \Modules\Nexon\CrazyArcade\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonCrazyArcadeApi');
            if ($service instanceof \Modules\Nexon\CrazyArcade\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_crazy_arcade_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\CrazyArcade\Libraries\Api($apiKey);
    }
}
