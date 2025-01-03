<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?string $server_name
 * @property ?DateTime $date_send
 * @property ?string $character_name
 * @property ?string $message
 */
class HornBugleWorldHistory extends BaseEntity
{
    protected $casts = [];

    protected $dates = [
        'date_send',
    ];

    public function search(string $key): string
    {
        $cCms = core_config_cms();
        $uri = current_url(true);
        switch ($key)
        {
            case 'server_name':
                $uri->addQuery($cCms->searchName, 'server_name =:"' . $this->server_name . '"');
                break;
            case 'character_name':
                $uri->addQuery($cCms->searchName, 'server_name =:"' . $this->server_name . '" character_name =:"' . $this->character_name . '"');
                break;
        }

        return $uri;
    }
}
