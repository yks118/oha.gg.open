<?php
namespace Modules\Nexon\Mabinogi\Models;

use CodeIgniter\Database\BaseBuilder;
use Modules\Core\Models\BaseModel;

class AuctionHistoryDate extends BaseModel
{
    protected $table = 'nexon_mabinogi_auction_history_date';

    protected $primaryKey = 'date';

    protected $allowedFields = [
        'date', 'item_uuid',
        'min', 'max', 'sum', 'count',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\AuctionHistoryDate::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = '';

    protected $updatedField = '';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionHistoryDate|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\AuctionHistoryDate|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\AuctionHistoryDate[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }
}
