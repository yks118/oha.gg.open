<?php
namespace Modules\Nexon\Mabinogi\Entities;

use Modules\Core\Entities\BaseEntity;

/**
 * @property ?int $item_uuid
 * @property ?int $a_r
 * @property ?int $a_g
 * @property ?int $a_b
 * @property ?int $b_r
 * @property ?int $b_g
 * @property ?int $b_b
 * @property ?int $c_r
 * @property ?int $c_g
 * @property ?int $c_b
 * @property ?int $d_r
 * @property ?int $d_g
 * @property ?int $d_b
 * @property ?int $e_r
 * @property ?int $e_g
 * @property ?int $e_b
 * @property ?int $f_r
 * @property ?int $f_g
 * @property ?int $f_b
 */
class ItemColorPart extends BaseEntity
{
    protected $casts = [
        'item_uuid' => '?int',

        'a_r'   => '?int',
        'a_g'   => '?int',
        'a_b'   => '?int',
        'b_r'   => '?int',
        'b_g'   => '?int',
        'b_b'   => '?int',
        'c_r'   => '?int',
        'c_g'   => '?int',
        'c_b'   => '?int',
        'd_r'   => '?int',
        'd_g'   => '?int',
        'd_b'   => '?int',
        'e_r'   => '?int',
        'e_g'   => '?int',
        'e_b'   => '?int',
        'f_r'   => '?int',
        'f_g'   => '?int',
        'f_b'   => '?int',
    ];

    protected $dates = [];
}
