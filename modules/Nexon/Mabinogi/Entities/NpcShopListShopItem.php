<?php
namespace Modules\Nexon\Mabinogi\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $npc_shop_list_id
 * @property ?int $id
 * @property ?string $tab_name
 * @property ?string $item_display_name
 * @property ?int $item_count
 * @property ?string $limit_type
 * @property ?int $limit_value
 * @property ?string $image_url
 * @property ?string $price_type
 * @property ?int $price_value
 *
 * @property ?NpcShopList $npcShopList
 * @property ?NpcShopListShopItemOption[] $option
 */
class NpcShopListShopItem extends BaseEntity
{
    protected $casts = [
        'npc_shop_list_id'  => '?int',
        'id'                => '?int',

        'item_count'    => '?int',
        'limit_value'   => '?int',
        'price_value'   => '?int',
    ];

    protected $dates = [];

    private ?NpcShopList $npcShopList = null;

    protected function getNpcShopList(): NpcShopList
    {
        if (is_null($this->npcShopList))
        {
            $mNpcShopList = model(\Modules\Nexon\Mabinogi\Models\NpcShopList::class);
            $this->npcShopList = $mNpcShopList->find($this->npc_shop_list_id);
        }

        return $this->npcShopList;
    }

    /** @var ?NpcShopListShopItemOption[] $option */
    private ?array $option = null;

    protected function getOption(): ?array
    {
        if (is_null($this->option))
        {
            $mNpcShopListShopItemOption = model(\Modules\Nexon\Mabinogi\Models\NpcShopListShopItemOption::class);
            $this->option = $mNpcShopListShopItemOption
                ->where('npc_shop_list_id', $this->npc_shop_list_id)
                ->where('npc_shop_list_shop_item_id', $this->id)
                ->findAll()
            ;
        }

        return $this->option;
    }

    public function search(string $key): string
    {
        $cCms = core_config_cms();
        $uri = current_url(true);
        switch ($key)
        {
            case 'item_display_name':
                $uri->addQuery($cCms->searchName, 'item_display_name:"' . $this->item_display_name . '"');
                break;
            case 'price_type':
                $uri->addQuery($cCms->searchName, 'price_type:"' . $this->price_type . '"');
                break;
        }

        return $uri;
    }
}
