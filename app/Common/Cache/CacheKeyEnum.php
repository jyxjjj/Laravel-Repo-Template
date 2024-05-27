<?php /** @noinspection PhpUnused */

namespace App\Common\Cache;

/**
 * <p>$cache = CacheKeyEnum::{ENUM_CASE}->newInstance($id);</p>
 * <p>$data = $cache->remember(function () use ($id) { ...return }, $ttl);</p>
 * <p>$cache->delete();</p>
 * <p>$cache->has();</p>
 * <p>$cache->get($default);</p>
 * <p>$cache->set($value, $ttl);</p>
 * <p>$cacheKey = $cache->getKey();</p>
 * <p>TRUE: $this == $cache->getKeyEnum();</p>
 * @see CacheKey
 */
enum CacheKeyEnum: string
{
    case TEST = 'test_%s';

    /**
     * @param int|string ...$args
     * @return string
     */
    public function getKey(int|string ...$args): string
    {
        return vsprintf($this->value, $args);
    }

    /**
     * @param int|string ...$args
     * @return CacheKey
     */
    public function newCacheInstance(int|string ...$args): CacheKey
    {
        return new CacheKey($this, ...$args);
    }

    /**
     * @param int|string ...$args
     * @return HashKey
     */
    public function newHashInstance(int|string ...$args): HashKey
    {
        return new HashKey($this, ...$args);
    }
}
