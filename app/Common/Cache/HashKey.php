<?php

namespace App\Common\Cache;

use App\Common\Traits\CacheRedisHelper;
use App\Common\Traits\CacheSerializable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/**
 * @see CacheKeyEnum
 */
class HashKey
{
    use CacheSerializable, CacheRedisHelper;

    private \Redis $connection;
    private string $prefix;
    private string $key;
    private string $fullKey;

    public function __construct(CacheKeyEnum $key, int|string ...$v)
    {
        $this->connection = Redis::connection('cache')->client();
        $this->prefix = Cache::getPrefix();
        $this->key = vsprintf($key->value, $v);
        $this->fullKey = $this->prefix . $this->key;
    }

    public function drop(string $hashKey, string ...$hashKeys): bool|int
    {
        return $this->connection->hDel($this->fullKey, $this->serialize($hashKey), ...array_map(fn($k) => $this->serialize($k), $hashKeys));
    }

    public function get(string $hashKey): mixed
    {
        $value = $this->connection->hGet($this->fullKey, $this->serialize($hashKey));
        return $value ? $this->unserialize($value) : null;
    }

    public function getAll(): array
    {
        $result = [];
        $data = $this->connection->hGetAll($this->fullKey);
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $result[$this->unserialize($key)] = $this->unserialize($value);
            }
        }
        return $result;
    }

    public function set(string $hashKey, $value, ?int $ttl = null): bool|int
    {
        $result = $this->connection->hSet($this->fullKey, $this->serialize($hashKey), $this->serialize($value));
        if ($ttl) {
            $this->connection->expire($this->fullKey, $ttl);
        }
        return $result;
    }
}
