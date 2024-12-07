<?php
namespace Modules\Nexon\MabinogiHeroes\Database\Migrations;

use CodeIgniter\Database\Migration;

class RankingRealTime20241205 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'ranking_type'   => [
                    'type'          => 'TINYINT',
                    'constraint'    => 3, // 255
                    'unsigned'      => true,
                ],
                'ranking'   => [
                    'type'          => 'SMALLINT',
                    'constraint'    => 5, // 65,535
                    'unsigned'      => true,
                ],
                'character_name'    => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 20, // 한글 10글자, 영문 20글자
                    'null'          => false,
                ],
                'score' => [
                    'type'          => 'INT',
                    'constraint'    => 11, // 4,294,967,295
                    'unsigned'      => true,
                ],
            ])
            ->addPrimaryKey(['ranking_type', 'ranking'])
            ->createTable('nexon_mabinogi_heroes_ranking_real_time')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_heroes_ranking_real_time');
    }
}
