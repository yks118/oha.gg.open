<?php

if (! function_usable('nexon_mabinogi_config_api'))
{
    function nexon_mabinogi_config_api(): \Modules\Nexon\Mabinogi\Config\Api
    {
        return config(\Modules\Nexon\Mabinogi\Config\Api::class);
    }
}

if (! function_usable('nexon_mabinogi_services_api'))
{
    function nexon_mabinogi_services_api(): \Modules\Nexon\Mabinogi\Libraries\Api
    {
        return \Modules\Nexon\Mabinogi\Config\Services::nexonMabinogiApi();
    }
}
