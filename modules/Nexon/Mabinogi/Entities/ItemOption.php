<?php
namespace Modules\Nexon\Mabinogi\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $item_uuid
 * @property ?int $id
 * @property ?string $option_type
 * @property ?string $option_sub_type
 * @property ?string $option_value
 * @property ?int $option_value2
 * @property ?string $option_desc
 *
 * @property ?DyeColor $dyeColor
 */
class ItemOption extends BaseEntity
{
    protected $casts = [
        'item_uuid' => '?int',
        'id'        => '?int',

        'option_value2' => '?int',
    ];

    protected $dates = [];

    public function isColorPart(): bool
    {
        $haystack = ['아이템 색상', '색상'];
        return in_array($this->option_type, $haystack);
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
