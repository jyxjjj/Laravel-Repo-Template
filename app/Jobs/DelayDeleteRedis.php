<?php

namespace App\Jobs;

use App\Jobs\Base\BaseQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class DelayDeleteRedis extends BaseQueue
{
    public $delay = 1;

    public function __construct(
        private readonly string $fullKey,
        private readonly bool   $isRedis = true,
        private readonly string $redisConnection = 'cache'
    )
    {
    }

    public function handle(): void
    {
        if ($this->isRedis) {
            $connection = Redis::connection($this->redisConnection)->client();
            $connection->del($this->fullKey);
        } else {
            Cache::forget($this->fullKey);
        }
    }
}
