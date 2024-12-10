<?php

if (! function_usable('nexon_crazy_arcade_config_api'))
{
    function nexon_crazy_arcade_config_api(): \Modules\Nexon\CrazyArcade\Config\Api
    {
        return config(\Modules\Nexon\CrazyArcade\Config\Api::class);
    }
}

if (! function_usable('nexon_crazy_arcade_services_api'))
{
    function nexon_crazy_arcade_services_api(): \Modules\Nexon\CrazyArcade\Libraries\Api
    {
        return \Modules\Nexon\CrazyArcade\Config\Services::nexonCrazyArcadeApi();
    }
}
