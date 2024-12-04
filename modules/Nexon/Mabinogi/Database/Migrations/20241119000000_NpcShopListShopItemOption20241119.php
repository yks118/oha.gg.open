<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class NpcShopListShopItemOption20241119 extends Migration
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
                'id'    => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'option_type'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10, // 아이템 색상
                    'null'          => false,
                ],
                'option_sub_type'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10, // 파트 A
                    'null'          => false,
                ],
                'option_value'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255,
                    'null'          => false,
                ],
                'option_value2' => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'option_desc'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 교역 마스터리 랭크 A 이상일 때 교역물품 구매 할인율 1.0% 증가
                    'null'          => false,
                ],
            ])
            ->addPrimaryKey(['npc_shop_list_id', 'npc_shop_list_shop_item_id', 'id'])
            ->addKey(['option_type', 'option_value']) // 검색용
            ->createTable('nexon_mabinogi_npc_shop_list_shop_item_option')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_npc_shop_list_shop_item_option');
    }
}
