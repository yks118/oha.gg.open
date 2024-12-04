<?php
namespace Modules\Nexon\Mabinogi\Database\Migrations;

use CodeIgniter\Database\Migration;

class NpcShopList20241118 extends Migration
{
    public function up(): void
    {
        $this->forge
            ->addField([
                'id'    => [
                    'type'              => 'SMALLINT', // 65,535
                    'constraint'        => 5,
                    'unsigned'          => true,
                    'auto_increment'    => true,
                ],
                'server_name'   => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 3, // 류트, 만돌린, 하프, 울프
                    'null'          => false,
                ],
                'npc_name'  => [
                    'type'          => 'VARCHAR',
                    'constraint'    => 5, // 상인 라누
                    'null'          => false,
                ],
                'channel'   => [
                    'type'          => 'TINYINT',
                    'constraint'    => 3, // 최대 42?
                    'unsigned'      => true,
                ],
                'date_inquire'  => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'date_shop_next_update' => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'updated_at'    => [
                    'type'  => 'DATETIME',
                    'null'  => false,
                ],
                'deleted_at'    => [
                    'type'  => 'DATETIME',
                    'null'  => true,
                ],
            ])
            ->addPrimaryKey('id')
            ->addUniqueKey(['server_name', 'npc_name', 'channel'])
            ->createTable('nexon_mabinogi_npc_shop_list')
        ;
    }

    public function down(): void
    {
        $this->forge->dropTable('nexon_mabinogi_npc_shop_list');
    }
}
