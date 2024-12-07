<?php
namespace Modules\Nexon\MabinogiHeroes\Database\Migrations;

use CodeIgniter\Database\Migration;

class MetaEnchant20241205 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'type'  => [
                    'type'          => 'CHAR',
                    'constraint'    => 1, // 0: 접두, 1: 접미
                    'null'          => false,
                ],
                'name'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10,
                    'null'          => false,
                ],
                'grade' => [
                    'type'          => 'CHAR',
                    'constraint'    => 1, // f ~ 1
                    'null'          => false,
                ],
                'available_slot_name'   => [
                    'type'  => 'TEXT',
                    'null'  => false,
                ],
                'stat'  => [
                    'type'  => 'TEXT',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey(['type', 'name'])
            ->createTable('nexon_mabinogi_heroes_meta_enchant')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_heroes_meta_enchant');
    }
}
