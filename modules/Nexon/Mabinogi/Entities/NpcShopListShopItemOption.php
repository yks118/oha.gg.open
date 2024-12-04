<?php
namespace Modules\Nexon\Mabinogi\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $npc_shop_list_id
 * @property ?int $npc_shop_list_shop_item_id
 * @property ?int $id
 * @property ?string $option_type
 * @property ?string $option_sub_type
 * @property ?string $option_value
 * @property ?int $option_value2
 * @property ?string $option_desc
 *
 * @property ?DyeColor $dyeColor
 */
class NpcShopListShopItemOption extends BaseEntity
{
    protected $casts = [
        'npc_shop_list_id'              => '?int',
        'npc_shop_list_shop_item_id'    => '?int',
        'id'                            => '?int',

        'option_value2' => '?int',
    ];

    protected $dates = [];

    public function isColorPart(): bool
    {
        return $this->option_type === '아이템 색상';
    }

    private ?DyeColor $dyeColor = null;

    protected function getDyeColor(): ?DyeColor
    {
        if (is_null($this->dyeColor))
        {
            $mDyeColor = model(\Modules\Nexon\Mabinogi\Models\DyeColor::class);
            $this->dyeColor = $mDyeColor->where('rgb', $this->option_value)->findAll(1)[0] ?? null;
        }

        return $this->dyeColor;
    }

    public function search(): string
    {
        $cCms = core_config_cms();
        $uri = current_url(true);
        if ($this->option_sub_type)
        {
            $uri->addQuery($cCms->searchName, 'option_type:"' . $this->option_type . '" option_sub_type:"' . $this->option_sub_type . '" option_value:"' . $this->option_value . '"');
        }
        elseif ($this->option_value2)
        {
            $uri->addQuery($cCms->searchName, 'option_type:"' . $this->option_type . '" option_value:"' . $this->option_value . '" option_value2:"' . $this->option_value2 . '"');
        }
        else
        {
            $uri->addQuery($cCms->searchName, 'option_type:"' . $this->option_type . '" option_value:"' . $this->option_value . '"');
        }

        return $uri;
    }
}
