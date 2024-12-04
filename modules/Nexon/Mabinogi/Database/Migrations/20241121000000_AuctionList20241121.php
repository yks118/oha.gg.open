<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuctionList20241121 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'auction_item_category' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10,
                    'null'          => false,
                ],
                'id'    => [
                    'type'          => 'SMALLINT', // 65,535
                    'constraint'    => 5,
                    'unsigned'      => true,
                ],
                'item_uuid' => [
                    'type'          => 'CHAR',
                    'constraint'    => 36,
                    'null'          => false,
                ],
                'item_count'    => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'auction_price_per_unit'    => [
                    'type'          => 'BIGINT', // 18,446,744,073,709,551,615
                    'constraint'    => 20,
                    'unsigned'      => true,
                ],
                'date_auction_expire'   => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey(['auction_item_category', 'id'])
            ->addKey('item_uuid') // join 용
            ->createTable('nexon_mabinogi_auction_list')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_auction_list');
    }
}
