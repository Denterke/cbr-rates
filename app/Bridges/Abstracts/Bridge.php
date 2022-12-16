<?php

namespace App\Bridges\Abstracts;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Kevinrob\GuzzleCache\Storage\CacheStorageInterface;
use Kevinrob\GuzzleCache\Strategy\CacheStrategyInterface;
use Kevinrob\GuzzleCache\Strategy\PrivateCacheStrategy;

/**
 * Main bridge
 */
abstract class Bridge
{
    /**
     * @var PendingRequest
     */
    protected PendingRequest $request;
    /**
     * @var Factory
     */
    private Factory $factory;
    /**
     * @var string
     */
    protected string $scheme;
    /**
     * @var string
     */
    protected string $host;
    /**
     * @var string
     */
    protected string $basePath;

    /**
     * @param Factory $factory
     * @param string $scheme
     * @param string $host
     * @param string $basePath
     */
    public function __construct(
        Factory $factory,
        string  $scheme,
        string  $host,
        string  $basePath
    )
    {
        $this->factory = $factory;
        $this->scheme = $scheme;
        $this->host = $host;
        $this->basePath = $basePath;

        $this->resetRequest();
    }

    /**
     * @return void
     */
    protected function resetRequest(): void
    {
        $request = $this->authorize(
            $this->factory
                ->baseUrl($this->scheme . $this->host . $this->basePath)
        );

        $this->request = $request;
    }

    /**
     * @param PendingRequest $request
     * @return PendingRequest
     */
    protected function authorize(PendingRequest $request): PendingRequest
    {
        return $request;
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