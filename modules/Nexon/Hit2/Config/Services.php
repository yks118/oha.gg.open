<?php
namespace Modules\Nexon\Hit2\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonHit2Api(bool $getShared = true): \Modules\Nexon\Hit2\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonHit2Api');
            if ($service instanceof \Modules\Nexon\Hit2\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_hit2_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\Hit2\Libraries\Api($apiKey);
    }
}
