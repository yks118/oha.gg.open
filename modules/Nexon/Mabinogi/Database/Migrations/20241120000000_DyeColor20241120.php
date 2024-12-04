<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class DyeColor20241120 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'hex'   => [
                    'type'          => 'CHAR',
                    'constraint'    => 6, // 000000
                    'null'          => false,
                ],
                'rgb'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 11, // 255,255,255
                    'null'          => false,
                ],
                'name'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 5, // 리블
                    'null'          => false,
                ],
                'name_full' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 25, // 리얼 블랙
                    'null'          => false,
                ],
            ])
            ->addPrimaryKey('hex')
            ->addUniqueKey('rgb')
            ->addKey('name') // 검색용
            ->addKey('name_full') // 검색용
            ->createTable('nexon_mabinogi_dye_color')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_dye_color');
    }
}
