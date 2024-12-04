<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuctionHistory20241122 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'auction_buy_id'    => [
                    'type'          => 'BIGINT', // 18,446,744,073,709,551,615
                    'constraint'    => 20,
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
                'date_auction_buy'   => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey('auction_buy_id')
            ->addKey('item_uuid') // join 용
            ->addKey('date_auction_buy') // 기간 검색용
            ->createTable('nexon_mabinogi_auction_history')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_auction_history');
    }
}
