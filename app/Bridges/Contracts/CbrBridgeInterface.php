<?php

namespace App\Bridges\Contracts;

use App\Domain\Entities\Cbr\RateQueryEntity;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface CbrBridgeInterface
{
    public function getXmlRates(RateQueryEntity $entity): PromiseInterface|Response;
}