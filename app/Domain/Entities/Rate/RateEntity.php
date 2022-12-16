<?php

namespace App\Domain\Entities\Rate;

class RateEntity
{
    /**
     * @param float $rate
     * @param float|null $difference
     * @param float|null $percent
     */
    public function __construct(
        readonly float $rate,
        readonly ?float $difference,
        readonly ?float $percent,
    )
    {
    }
}