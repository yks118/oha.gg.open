<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class HornBugleWorldHistory20241114 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'server_name'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 3, // 류트, 만돌린, 하프, 울프
                    'null'          => false,
                ],
                'date_send' => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'character_name'    => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 16, // 한글: 8자, 영문: 16자
                    'null'          => false,
                ],
                'message'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 한글: 115, 영문: 230 ?
                    'null'          => false,
                ],
            ])
            ->addPrimaryKey(['server_name', 'date_send', 'character_name'])
            ->createTable('nexon_mabinogi_horn_bugle_world_history')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_horn_bugle_world_history');
    }
}
