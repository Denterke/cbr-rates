<?php

namespace App\Domain\Entities\Cbr;

class RateQueryEntity
{
    /**
     * @param string $date_req1
     * @param string $date_req2
     * @param string $val_nm_rq
     */
    public function __construct(
        readonly string $date_req1,
        readonly string $date_req2,
        readonly string $val_nm_rq,
    ) {}
}