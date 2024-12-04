<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItemColorPart20241121 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'item_uuid' => [
                    'type'          => 'CHAR',
                    'constraint'    => 36,
                    'null'          => false,
                ],
                'a_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'a_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'a_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'b_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'c_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'd_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'd_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'd_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'e_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'e_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'e_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'f_r'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'f_g'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'f_b'   => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
            ])
            ->addPrimaryKey('item_uuid')
            ->addKey(['a_r', 'a_g', 'a_b']) // A 파트 검색용
            ->addKey(['b_r', 'b_g', 'b_b']) // B 파트 검색용
            ->addKey(['c_r', 'c_g', 'c_b']) // C 파트 검색용
            ->addKey(['d_r', 'd_g', 'd_b']) // D 파트 검색용
            ->addKey(['e_r', 'e_g', 'e_b']) // E 파트 검색용
            ->addKey(['f_r', 'f_g', 'f_b']) // F 파트 검색용
            ->createTable('nexon_mabinogi_item_color_part')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_item_color_part');
    }
}
