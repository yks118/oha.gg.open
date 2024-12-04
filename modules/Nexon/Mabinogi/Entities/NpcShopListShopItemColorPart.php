<?php
namespace Modules\Nexon\Mabinogi\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $npc_shop_list_id
 * @property ?int $npc_shop_list_shop_item_id
 * @property ?int $a_r
 * @property ?int $a_g
 * @property ?int $a_b
 * @property ?int $b_r
 * @property ?int $b_g
 * @property ?int $b_b
 * @property ?int $c_r
 * @property ?int $c_g
 * @property ?int $c_b
 */
class NpcShopListShopItemColorPart extends BaseEntity
{
    protected $casts = [
        'npc_shop_list_id'              => '?int',
        'npc_shop_list_shop_item_id'    => '?int',

        'a_r'   => '?int',
        'a_g'   => '?int',
        'a_b'   => '?int',
        'b_r'   => '?int',
        'b_g'   => '?int',
        'b_b'   => '?int',
        'c_r'   => '?int',
        'c_g'   => '?int',
        'c_b'   => '?int',
    ];

    protected $dates = [];
}
