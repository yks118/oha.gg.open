<?php

if (! function_usable('nexon_kart_rider_rush_plus_config_api'))
{
    function nexon_kart_rider_rush_plus_config_api(): \Modules\Nexon\KartRiderRushPlus\Config\Api
    {
        return config(\Modules\Nexon\KartRiderRushPlus\Config\Api::class);
    }
}

if (! function_usable('nexon_kart_rider_rush_plus_services_api'))
{
    function nexon_kart_rider_rush_plus_services_api(): \Modules\Nexon\KartRiderRushPlus\Libraries\Api
    {
        return \Modules\Nexon\KartRiderRushPlus\Config\Services::nexonKartRiderRushPlusApi();
    }
}
