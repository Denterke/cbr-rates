<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Cbr\RateQueryEntity;
use App\Http\Requests\RateRequest;
use App\Http\Responses\Abstracts\AbstractResponse;
use App\Services\Rates\RatesServiceInterface;
use Illuminate\Http\JsonResponse;

/**
 *
 * @group Rates
 */
class RatesController extends Controller
{
    /**
     * @param RatesServiceInterface $service
     */
    public function __construct(
        protected RatesServiceInterface $service,
    )
    {
    }

    /**
     * Get currency rate by code
     * @bodyParam currency_code string required Currency code. Example: R01235
     * @bodyParam date string required Date. Example: 14-12-2022
     * @response
     * {
     *   "status": "success",
     *   "code": 2020,
     *   "data": {
     *     "rate": 63.212,
     *     "difference": 0.4446,
     *     "percent": 0.7
     *   }
     * }
     *
     * @response scenario="date before is holiday or without data"
     * {
     *   "status": "success",
     *   "code": 2020,
     *   "data": {
     *     "rate": 63.212,
     *     "difference": null,
     *     "percent": null
     *   }
     * }
     *
     * @response scenario="service errors"
     * {
     *     "status": "error",
     *     "code": 4220,
     *     "data": "Could not get rates data"
     * }
     *
     * @response scenario="validation errors"
     * {
     *     "status": "error",
     *     "code": 4220,
     *     "data": {
     *         "date": [
     *             "The date field is required."
     *         ]
     *     }
     * }
     * @param RateRequest $request
     * @return JsonResponse
     */
    public function getRate(RateRequest $request)
    {
        $queryEntity = new RateQueryEntity(
            $request->getFromDate(),
            $request->getToDate(),
            $request->getCurrencyCode(),
        );

        $rateInfo = $this->service->getRate($queryEntity);

        if (!$rateInfo) {
            return $this->error('Could not get rates data', AbstractResponse::EMPTY_DATA);
        }

        return $this->success($rateInfo);
    }
}
