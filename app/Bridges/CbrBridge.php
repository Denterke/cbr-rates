<?php

namespace App\Bridges;

use App\Bridges\Abstracts\CacheableBridge;
use App\Bridges\Contracts\CbrBridgeInterface;
use App\Domain\Entities\Cbr\RateQueryEntity;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

/**
 * Bridge for getting cbr rates
 */
class CbrBridge extends CacheableBridge implements CbrBridgeInterface
{
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
        parent::__construct($factory, $scheme, $host, $basePath);
    }

    /**
     * @inheritDoc
     */
    public function getXmlRates(RateQueryEntity $entity): PromiseInterface|Response
    {
        return $this->request->get("/XML_dynamic.asp", (array)$entity);
    }
}