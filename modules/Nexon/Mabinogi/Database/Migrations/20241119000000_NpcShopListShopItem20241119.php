<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class NpcShopListShopItem20241119 extends Migration
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
                'id'    => [
                    'type'          => 'SMALLINT', // 65,535
                    'constraint'    => 5,
                    'unsigned'      => true,
                ],
                'tab_name'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 주머니
                    'null'          => false,
                ],
                'item_display_name' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 꽃바구니
                    'null'          => false,
                ],
                'item_count'    => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'limit_type'    => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 일간, 시즌
                    'null'          => false,
                ],
                'limit_value'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'image_url' => [
                    'type'          => 'CHAR',
                    'constraint'    => 188, // https://open.api.nexon.com/static/mabinogi/img/2a6edef8ae26db199589dcc94e518766?q=4b454d4543525d4987464e4c50504d474d8a50425b5760474446844350524b475f434a8f4c435e42594e4a44884849515d585d454a
                    'null'          => false,
                ],
                'price_type'    => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 3, // 골드, 두카트
                    'null'          => false,
                ],
                'price_value'   => [
                    'type'          => 'INT', // 4,294,967,295
                    'constraint'    => 11,
                    'unsigned'      => true,
                ],
            ])
            ->addPrimaryKey(['npc_shop_list_id', 'id'])
            ->addKey('item_display_name') // 상품 검색용
            ->addKey(['price_type', 'price_value']) // 상품 가격 검색용
            ->createTable('nexon_mabinogi_npc_shop_list_shop_item')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_npc_shop_list_shop_item');
    }
}
