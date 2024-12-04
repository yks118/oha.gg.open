<?php
namespace Modules\Nexon\Mabinogi\Entities;

use DateTime;
use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $id
 * @property ?string $server_name
 * @property ?string $npc_name
 * @property ?int $channel
 * @property ?DateTime $date_inquire
 * @property ?DateTime $date_shop_next_update
 * @property ?DateTime $updated_at
 * @property ?DateTime $deleted_at
 *
 * @property ?NpcShopListShopItem $shopItem
 */
class NpcShopList extends BaseEntity
{
    protected $casts = [
        'id'        => '?int',
        'channel'   => '?int',
    ];

    protected $dates = [
        'date_inquire', 'date_shop_next_update',
        'updated_at', 'deleted_at',
    ];

    /** @var ?NpcShopListShopItem[] $shopItem */
    private ?array $shopItem = null;

    /**
     * @return NpcShopListShopItem[]
     */
    protected function shopItem(): array
    {
        if (is_null($this->shopItem))
        {
            $mNpcShopListShopItem = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItem::class);
            $this->shopItem = $mNpcShopListShopItem
                ->where('npc_shop_list_id', $this->id)
                ->findAll()
            ;
        }

        return $this->shopItem;
    }

    public function search(string $key): string
    {
        $cCms = core_config_cms();
        $uri = current_url(true);
        switch ($key)
        {
            case 'server_name':
                $uri->addQuery($cCms->searchName, 'server_name:"' . $this->server_name . '"');
                break;
            case 'npc_name':
                $uri->addQuery($cCms->searchName, 'npc_name:"' . $this->npc_name . '"');
                break;
            case 'channel':
                $uri->addQuery($cCms->searchName, 'channel:"' . $this->channel . '"');
                break;
        }

        return $uri;
    }
}
