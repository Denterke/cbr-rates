<?php

namespace App\Bridges\Abstracts;

use Illuminate\Support\Facades\Cache;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\CacheStorageInterface;
use Kevinrob\GuzzleCache\Storage\LaravelCacheStorage;
use Kevinrob\GuzzleCache\Strategy\CacheStrategyInterface;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

/**
 * CacheableBridge bridge
 */
abstract class CacheableBridge extends Bridge
{
    /**
     * @return void
     */
    protected function resetRequest(): void
    {
        parent::resetRequest();

        $this->request->withMiddleware(
            new CacheMiddleware(
                $this->getCacheStrategy(new LaravelCacheStorage(Cache::store()))
            ),
        );
    }

    /**
     * @param CacheStorageInterface $storage
     * @return CacheStrategyInterface
     */
    protected function getCacheStrategy(CacheStorageInterface $storage): CacheStrategyInterface
    {
        return new PrivateCacheStrategy($storage);
    }
}