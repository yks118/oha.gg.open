<?php

if (! function_usable('nexon_maple_story_m_config_api'))
{
    function nexon_maple_story_m_config_api(): \Modules\Nexon\MapleStoryM\Config\Api
    {
        return config(\Modules\Nexon\MapleStoryM\Config\Api::class);
    }
}

if (! function_usable('nexon_maple_story_m_services_api'))
{
    function nexon_maple_story_m_services_api(): \Modules\Nexon\MapleStoryM\Libraries\Api
    {
        return \Modules\Nexon\MapleStoryM\Config\Services::nexonMapleStoryMApi();
    }
}
