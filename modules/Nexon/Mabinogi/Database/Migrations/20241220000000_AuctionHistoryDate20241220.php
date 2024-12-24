<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuctionHistoryDate20241220 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'date'  => [
                    'type'  => 'DATE',
                    'null'  => false,
                ],
                'item_uuid'  => [
                    'type'          => 'CHAR',
                    'constraint'    => 36,
                    'null'          => false,
                ],
                'min'   => [
                    'type'          => 'BIGINT', // 18,446,744,073,709,551,615
                    'constraint'    => 20,
                    'unsigned'      => true,
                ],
                'max'   => [
                    'type'          => 'BIGINT', // 18,446,744,073,709,551,615
                    'constraint'    => 20,
                    'unsigned'      => true,
                ],
                'sum'   => [
                    'type'          => 'BIGINT', // 18,446,744,073,709,551,615
                    'constraint'    => 20,
                    'unsigned'      => true,
                ],
                'count' => [
                    'type'          => 'MEDIUMINT', // 16,777,215
                    'constraint'    => 8,
                    'unsigned'      => true,
                ],
            ])
            ->addPrimaryKey(['date', 'item_uuid'])
            ->createTable('nexon_mabinogi_auction_history_date')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_auction_history_date');
    }
}
