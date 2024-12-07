<?php
namespace Modules\Nexon\MabinogiHeroes\Database\Migrations;

use CodeIgniter\Database\Migration;

class RankingHallOfHonor20241205 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'date'  => [
                    'type'  => 'DATE',
                    'null'  => false,
                ],
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
            ->addPrimaryKey(['date', 'ranking_type', 'ranking'])
            ->createTable('nexon_mabinogi_heroes_ranking_hall_of_honor')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_heroes_ranking_hall_of_honor');
    }
}
