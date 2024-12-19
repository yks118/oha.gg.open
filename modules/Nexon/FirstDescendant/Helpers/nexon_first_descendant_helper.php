<?php

if (! function_usable('nexon_first_descendant_config_api'))
{
    function nexon_first_descendant_config_api(): \Modules\Nexon\FirstDescendant\Config\Api
    {
        return config(\Modules\Nexon\FirstDescendant\Config\Api::class);
    }
}

if (! function_usable('nexon_first_descendant_services_api'))
{
    function nexon_first_descendant_services_api(): \Modules\Nexon\FirstDescendant\Libraries\Api
    {
        return \Modules\Nexon\FirstDescendant\Config\Services::nexonFirstDescendantApi();
    }
}
