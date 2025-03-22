<?php
namespace Modules\Nexon\Mabinogi\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use Modules\Core\Models\BaseModel;

class Item extends BaseModel
{
    protected $table = 'nexon_mabinogi_item';

    protected $primaryKey = 'uuid';

    protected $allowedFields = [
        'uuid', 'md5', 'serialize',
        'item_name', 'item_display_name',
    ];

    protected array $searchFields = [];

    protected $returnType = \Modules\Nexon\Mabinogi\Entities\Item::class;

    protected $useTimestamps = true;

    protected $useSoftDeletes = false;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';

    protected $deletedField = '';

    protected bool $cacheUse = true;

    protected int $cacheTtl = YEAR;

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

        $this->cacheUse = true;
        $this->cacheTtl = YEAR;
        $this->cacheRefresh = false;
    }

    /**
     * @param mixed $id
     * @return \Modules\Nexon\Mabinogi\Entities\Item|array|null
     */
    public function find($id = null): \Modules\Nexon\Mabinogi\Entities\Item|array|null
    {
        return parent::find($id);
    }

    /**
     * @return \Modules\Nexon\Mabinogi\Entities\Item[]|array
     */
    public function findAll(?int $limit = null, int $offset = 0): array
    {
        return parent::findAll($limit, $offset);
    }

    /**
     * @param string $md5
     * @return \Modules\Nexon\Mabinogi\Entities\Item[]|array
     */
    public function md5FindAll(string $md5): array
    {
        $this
            ->where('md5', $md5)
            ->where('uuid !=', '')
        ;
        return $this->findAll();
    }
}
