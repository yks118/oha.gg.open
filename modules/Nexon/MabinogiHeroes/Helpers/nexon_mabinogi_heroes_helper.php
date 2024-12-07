<?php

if (! function_usable('nexon_mabinogi_heroes_config_api'))
{
    function nexon_mabinogi_heroes_config_api(): \Modules\Nexon\MabinogiHeroes\Config\Api
    {
        return config(\Modules\Nexon\MabinogiHeroes\Config\Api::class);
    }
}

if (! function_usable('nexon_mabinogi_heroes_services_api'))
{
    function nexon_mabinogi_heroes_services_api(): \Modules\Nexon\MabinogiHeroes\Libraries\Api
    {
        return \Modules\Nexon\MabinogiHeroes\Config\Services::nexonMabinogiHeroesApi();
    }
}
