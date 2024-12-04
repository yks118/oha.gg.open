<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class Enchant20241118 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'type'   => [
                    'type'          => 'CHAR',
                    'constraint'    => 6, // prefix (접두), suffix (접미)
                    'null'          => false,
                ],
                'name_full'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 폭스 (랭크 B)
                    'null'          => false,
                ],
                'name'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 폭스
                    'null'          => false,
                ],
                'rank'  => [
                    'type'          => 'CHAR',
                    'constraint'    => 1, // B
                    'null'          => false,
                ],
                'desc'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 레벨이 14 이상일때 최대대미지 1 증가,레벨이 14 이상일때 최소대미지 2 증가
                    'null'          => false,
                ],
            ])
            ->addPrimaryKey(['server_name', 'date_send', 'character_name'])
            ->createTable('nexon_mabinogi_enchant')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_enchant');
    }
}
