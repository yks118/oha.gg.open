<?php
namespace Modules\Nexon\Mabinogi\Models;

use Modules\Core\Models\BaseModel;

class AuctionListStatus extends BaseModel
{
    protected $table = 'nexon_mabinogi_auction_list_status';

    protected $primaryKey = 'auction_item_category';

    protected $allowedFields = [
        'auction_item_category',
        'status',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\AuctionListStatus::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = 'updated_at';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionListStatus|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\AuctionListStatus|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionListStatus[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
