<?php

if (! function_usable('nexon_hit2_config_api'))
{
    function nexon_hit2_config_api(): \Modules\Nexon\Hit2\Config\Api
    {
        return config(\Modules\Nexon\Hit2\Config\Api::class);
    }
}

if (! function_usable('nexon_hit2_services_api'))
{
    function nexon_hit2_services_api(): \Modules\Nexon\Hit2\Libraries\Api
    {
        return \Modules\Nexon\Hit2\Config\Services::nexonHit2Api();
    }
}
