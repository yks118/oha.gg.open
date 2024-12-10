<?php
namespace Modules\Nexon\MabinogiHeroes\Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function nexonMabinogiHeroesApi(bool $getShared = true): \Modules\Nexon\MabinogiHeroes\Libraries\Api
    {
        if ($getShared)
        {
            $service = static::getSharedInstance('nexonMabinogiHeroesApi');
            if ($service instanceof \Modules\Nexon\MabinogiHeroes\Libraries\Api)
            {
                return $service;
            }
        }

        $cApi = nexon_mabinogi_heroes_config_api();
        $apiKey = $cApi->dev;
        if ($cApi->prod && ! is_dev())
        {
            $apiKey = $cApi->prod;
        }
        return new \Modules\Nexon\MabinogiHeroes\Libraries\Api($apiKey);
    }
}
