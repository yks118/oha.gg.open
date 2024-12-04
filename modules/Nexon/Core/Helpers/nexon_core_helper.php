<?php

if (! function_usable('nexon_core_config_api'))
{
    function nexon_core_config_api(): \Modules\Nexon\Core\Config\Api
    {
        return config(\Modules\Nexon\Core\Config\Api::class);
    }
}
