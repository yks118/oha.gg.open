<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class NpcShopListShopItemColorPart20241119 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'npc_shop_list_id'    => [
                    'type'          => 'SMALLINT', // 65,535
                    'constraint'    => 5,
                    'unsigned'      => true,
                ],
                'npc_shop_list_shop_item_id'    => [
                    'type'          => 'SMALLINT', // 65,535
                    'constraint'    => 5,
                    'unsigned'      => true,
                ],
                'a_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'a_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'a_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
            ])
            ->addPrimaryKey(['npc_shop_list_id', 'npc_shop_list_shop_item_id'])
            ->addKey(['a_r', 'a_g', 'a_b']) // A 파트 검색용
            ->addKey(['b_r', 'b_g', 'b_b']) // B 파트 검색용
            ->addKey(['c_r', 'c_g', 'c_b']) // C 파트 검색용
            ->createTable('nexon_mabinogi_npc_shop_list_shop_item_color_part')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_npc_shop_list_shop_item_color_part');
    }
}
