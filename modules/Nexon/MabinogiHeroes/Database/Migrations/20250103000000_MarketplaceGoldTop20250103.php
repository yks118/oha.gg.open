<?php
namespace Modules\Nexon\MabinogiHeroes\Database\Migrations;

use CodeIgniter\Database\Migration;

class MarketplaceGoldTop20250103 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'date'  => [
                    'type'  => 'DATE',
                    'null'  => false,
                ],
                'type' => [
                    'type'          => 'CHAR',
                    'constraint'    => 1,
                    'null'          => false,
                ],
                'data'  => [
                    'type'  => 'TEXT',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey(['date', 'type'])
            ->createTable('nexon_mabinogi_heroes_marketplace_gold_top')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_heroes_marketplace_gold_top');
    }
}
