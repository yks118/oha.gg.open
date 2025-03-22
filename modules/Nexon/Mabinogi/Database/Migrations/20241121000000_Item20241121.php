<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item20241121 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'uuid'  => [
                    'type'          => 'CHAR',
                    'constraint'    => 36,
                    'null'          => false,
                ],
                'md5'   => [
                    'type'          => 'CHAR',
                    'constraint'    => 32, // hash 검색용
                    'null'          => false,
                ],
                'serialize' => [
                    'type'          => 'TEXT', // hash 검색 후 동일한 아이템인지 다시 한 번 확인하는 용도
                    'null'          => false,
                ],
                'item_name' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 펫 지정 색상 염색 앰플, 단검
                    'null'          => false,
                ],
                'item_display_name' => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 255, // 펫 지정 색상 염색 앰플, 축복받은 매정한 단검 (축복 여부와 인챈트를 포함)
                    'null'          => false,
                ],
                'created_at'    => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'updated_at'    => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
            ])
            ->addPrimaryKey('uuid')
            ->addKey('md5') // 검색용
            ->addKey('item_name') // 검색용
            ->addKey('item_display_name') // 검색용
            ->addKey('updated_at') // 오래된 데이터 삭제용
            ->createTable('nexon_mabinogi_item')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_item');
    }
}
