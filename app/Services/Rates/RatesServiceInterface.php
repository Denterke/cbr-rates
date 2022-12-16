<?php

namespace App\Services\Rates;

use App\Domain\Entities\Cbr\RateQueryEntity;
use App\Domain\Entities\Rate\RateEntity;

/**
 * RatesServiceInterface
 */
interface RatesServiceInterface
{
    /**
     * @param RateQueryEntity $entity
     * @return RateEntity|null
     */
    public function getRate(RateQueryEntity $entity): ?RateEntity;
}