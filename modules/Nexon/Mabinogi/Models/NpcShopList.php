<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class NpcShopList extends BaseModel
{
    protected $table = 'nexon_mabinogi_npc_shop_list';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'server_name', 'npc_name', 'channel',
        'date_inquire', 'date_shop_next_update',
        'deleted_at', // 삭제된 데이터를 되살려야 하는 상황에서 사용
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\NpcShopList::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;

    protected $createdField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopList|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\NpcShopList|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\NpcShopList[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }

    /**
     * @return array{string, array{string, array{int, int}}}
     */
    public function findAllUniqueKeyToIds(): array
    {
        $data = [];
        $backup = $this->useSoftDeletes;

        $list = $this->withDeleted()->findAll();
        foreach ($list as $eNpcShopList)
        {
            if (! isset($data[$eNpcShopList->server_name]))
            {
                $data[$eNpcShopList->server_name] = [];
            }

            if (! isset($data[$eNpcShopList->server_name][$eNpcShopList->npc_name]))
            {
                $data[$eNpcShopList->server_name][$eNpcShopList->npc_name] = [];
            }

            $data[$eNpcShopList->server_name][$eNpcShopList->npc_name][$eNpcShopList->channel] = $eNpcShopList->id;
        }

        $this->useSoftDeletes = $backup;
        return $data;
    }
}
