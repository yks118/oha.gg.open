<?php

if (! function_usable('nexon_sudden_attack_config_api'))
{
    function nexon_sudden_attack_config_api(): \Modules\Nexon\SuddenAttack\Config\Api
    {
        return config(\Modules\Nexon\SuddenAttack\Config\Api::class);
    }
}

if (! function_usable('nexon_sudden_attack_services_api'))
{
    function nexon_sudden_attack_services_api(): \Modules\Nexon\SuddenAttack\Libraries\Api
    {
        return \Modules\Nexon\SuddenAttack\Config\Services::nexonSuddenAttackApi();
    }
}
