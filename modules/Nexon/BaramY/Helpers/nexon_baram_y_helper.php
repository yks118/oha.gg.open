<?php

if (! function_usable('nexon_baram_y_config_api'))
{
    function nexon_baram_y_config_api(): \Modules\Nexon\BaramY\Config\Api
    {
        return config(\Modules\Nexon\BaramY\Config\Api::class);
    }
}

if (! function_usable('nexon_baram_y_services_api'))
{
    function nexon_baram_y_services_api(): \Modules\Nexon\BaramY\Libraries\Api
    {
        return \Modules\Nexon\BaramY\Config\Services::nexonBaramYApi();
    }
}
