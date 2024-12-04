<?php
namespace Modules\Core\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class BaseModel extends Model
{
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);

        if (is_cli())
        {
            $this->cacheUse = false;
            $this->cacheTtl = 0;
            $this->cacheRefresh = true;
        }
    }

    /** @var string[] $searchFields */
    protected array $searchFields = [];

    /**
     * @param array{
     *     or: string,
     *     not: string,
     *     field: string,
     *     eq: string,
     *     value: string
     * } $matches
     * @return self
     */
    protected function _search(array $matches): self
    {
        if (in_array($matches['field'], $this->allowedFields) && $matches['value'])
        {
            if ($matches['or'])
            {
                if ($matches['not'])
                {
                    $this->builder()->orNotLike($matches['field'], $matches['value']);
                }
                else
                {
                    if ($matches['eq'])
                    {
                        $this->builder()->orWhere($matches['field'] . $matches['eq'], $matches['value']);
                    }
                    else
                    {
                        $this->builder()->orLike($matches['field'] . $matches['eq'], $matches['value']);
                    }
                }
            }
            else
            {
                if ($matches['not'])
                {
                    $this->builder()->notLike($matches['field'] . $matches['eq'], $matches['value']);
                }
                else
                {
                    if ($matches['eq'])
                    {
                        $this->builder()->where($matches['field'] . $matches['eq'], $matches['value']);
                    }
                    else
                    {
                        $this->builder()->like($matches['field'] . $matches['eq'], $matches['value']);
                    }
                }
            }
        }

        return $this;
    }

    public function search(string $keyword): self
    {
        $text = trim($keyword);
        $isSearchFields = count($this->searchFields) > 0;

        do
        {
            $cntCut = 0;

            /*
             * Ex. field:"value"
             * Ex. -field:"value"
             * Ex. OR field:"value"
             */
            if (preg_match('/^(?<or>OR )?(?<not>-?)(?<field>[a-z0-9_]+)(?<eq> >| >=| <| <=)?:"(?<value>[^"]+)"/i', $text, $matches))
            {
                $this->_search($matches);
                $cntCut = mb_strlen($matches[0]);
            }
            elseif (preg_match('/^(?<or>OR )?(?<not>-?)(?<field>[a-z0-9_]+)(?<eq> >| >=| <| <=)?:(?<value>[^ ]+)/i', $text, $matches))
            {
                $this->_search($matches);
                $cntCut = mb_strlen($matches[0]);
            }
            // Ex. (field:"value" or field:value)
            elseif (preg_match('/^(?<or>OR )?(?<not>-?)\((?<keyword>[^)]+)\)/i', $text, $matches))
            {
                if ($matches['or'])
                {
                    if ($matches['not'])
                    {
                        $this->builder()->orNotGroupStart();
                    }
                    else
                    {
                        $this->builder()->orGroupStart();
                    }
                }
                elseif ($matches['not'])
                {
                    $this->builder()->notGroupStart();
                }
                else
                {
                    $this->builder()->groupStart();
                }

                $this->search($matches['keyword']);
                $this->builder()->groupEnd();
                $cntCut = mb_strlen($matches[0]);
            }
            elseif (
                $isSearchFields
                && (
                    // Ex. "search keyword"
                    preg_match('/^(?<or>OR )?(?<not>-?)"(?<value>[^"]+)"/i', $text, $matches)
                    // Ex. searchKeyword
                    || preg_match('/^(?<or>OR )?(?<not>-?)(?<value>[^ ]+)/i', $text, $matches)
                )
            )
            {
                if ($matches['or'])
                {
                    if ($matches['not'])
                    {
                        $this->builder()->orNotGroupStart();
                    }
                    else
                    {
                        $this->builder()->orGroupStart();
                    }
                }
                elseif ($matches['not'])
                {
                    $this->builder()->notGroupStart();
                }
                else
                {
                    $this->builder()->groupStart();
                }

                foreach ($this->searchFields as $searchField)
                {
                    $matches['field']   = $searchField;
                    $matches['or']      = 'OR ';
                    $matches['not']     = '';
                    $matches['eq']      = '';
                    $this->_search($matches);
                }

                $this->builder()->groupEnd();
                $cntCut = mb_strlen($matches[0]);
            }
            else
            {
                $cntCut = mb_strlen($text);
            }

            $text = trim(mb_substr($text, $cntCut));
        }
        while ($text);

        return $this;
    }

    protected bool $cacheUse = false;

    protected int $cacheTtl = 60;

    private string $cachePrefix = 'db_cache_';

    protected bool $cacheRefresh = false;

    private function getCacheKey(string $suffix): string
    {
        return $this->cachePrefix . $this->table . '_' . md5($this->builder()->getCompiledSelect(false)) . '_' . $suffix;
    }

    public function setCacheTtl(int $ttl = null, bool $refresh = false): self
    {
        if (is_null($ttl))
        {
            $ttl = $this->cacheTtl;
        }

        $this->cacheUse = $ttl > 0;
        $this->cacheRefresh = $refresh;
        $this->cacheTtl = $ttl;
        return $this;
    }

    public function delCache(): void
    {
        $cCache = config(\Config\Cache::class);
        $prefix = $cCache->prefix . $this->cachePrefix . $this->table;

        $list = cache()->getCacheInfo();
        foreach ($list as $key => $row)
        {
            if (preg_match('/^' . $prefix . '/', $key))
            {
                cache()->delete(str_replace($cCache->prefix, '', $key));
            }
        }
    }

    public function find($id = null): array|object|null
    {
        if ($this->cacheUse)
        {
            $cacheKey = $this->getCacheKey('find_' . $id);

            if ($this->cacheRefresh === false)
            {
                $data = cache()->get($cacheKey);
                if (! is_null($data))
                {
                    $this->builder()->resetQuery();
                    return $data;
                }
            }
        }

        $data = parent::find($id);
        if ($this->cacheUse && isset($cacheKey))
        {
            if (empty($data))
            {
                cache()->save($cacheKey, $data, 1);
            }
            else
            {
                cache()->save($cacheKey, $data, $this->cacheTtl);
            }
        }

        return $data;
    }

    public function findColumn(string $columnName): ?array
    {
        if ($this->cacheUse)
        {
            $cacheKey = $this->getCacheKey('find_column_' . $columnName);

            if ($this->cacheRefresh === false)
            {
                $data = cache()->get($cacheKey);
                if (! is_null($data))
                {
                    $this->builder()->resetQuery();
                    return $data;
                }
            }
        }

        $data = parent::findColumn($columnName);
        if ($this->cacheUse && isset($cacheKey))
        {
            if (empty($data))
            {
                cache()->save($cacheKey, $data, 1);
            }
            else
            {
                cache()->save($cacheKey, $data, $this->cacheTtl);
            }
        }

        return $data;
    }

    public function findAll(?int $limit = null, int $offset = 0): float|object|int|bool|array|string
    {
        if ($this->cacheUse)
        {
            $cacheKey = $this->getCacheKey('find_all_' . $limit . '_' . $offset);

            if ($this->cacheRefresh === false)
            {
                $data = cache()->get($cacheKey);
                if (! is_null($data))
                {
                    $this->builder()->resetQuery();
                    return $data;
                }
            }
        }

        $data = parent::findAll($limit, $offset);
        if ($this->cacheUse && isset($cacheKey))
        {
            if (empty($data))
            {
                cache()->save($cacheKey, $data, 1);
            }
            else
            {
                cache()->save($cacheKey, $data, $this->cacheTtl);
            }
        }

        return $data;
    }
}
