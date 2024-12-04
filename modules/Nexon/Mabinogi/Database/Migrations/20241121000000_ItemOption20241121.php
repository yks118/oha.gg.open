<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItemOption20241121 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'item_uuid'  => [
                    'type'          => 'CHAR',
                    'constraint'    => 36,
                    'null'          => false,
                ],
                'id'    => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'option_type'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10, // 아이템 색상
                    'null'          => false,
                ],
                'option_sub_type'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 10, // 파트 A
                    'null'          => false,
                ],
                'option_value'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255,
                    'null'          => false,
                ],
                'option_value2' => [
                    'type'          => 'TINYINT', // 255
                    'constraint'    => 3,
                    'unsigned'      => true,
                ],
                'option_desc'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 교역 마스터리 랭크 A 이상일 때 교역물품 구매 할인율 1.0% 증가
                    'null'          => false,
                ],
            ])
            ->addPrimaryKey(['item_uuid', 'id'])
            ->addKey(['option_type', 'option_value']) // 검색용
            ->createTable('nexon_mabinogi_item_option')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_item_option');
    }
}
