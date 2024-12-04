<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuctionHistoryStatus20241123 extends Migration
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
                'date_auction_buy'  => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'status'    => [
                    'type'          => 'CHAR',
                    'constraint'    => 1, // f: finish, i: in progress
                    'null'          => false,
                ],
                'updated_at'    => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey('auction_item_category')
            ->createTable('nexon_mabinogi_auction_history_status')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_auction_history_status');
    }
}
