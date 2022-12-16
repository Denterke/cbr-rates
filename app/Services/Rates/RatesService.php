<?php

namespace App\Services\Rates;

use App\Bridges\Contracts\CbrBridgeInterface;
use App\Domain\Entities\Cbr\RateQueryEntity;
use App\Domain\Entities\Rate\RateEntity;
use App\Helpers\XmlHelper;
use Illuminate\Support\Arr;

class RatesService implements RatesServiceInterface
{
    /** @var CbrBridgeInterface */
    private CbrBridgeInterface $bridge;

    /**
     * RatesService constructor.
     * @param CbrBridgeInterface $bridge
     */
    public function __construct(CbrBridgeInterface $bridge)
    {
        $this->bridge = $bridge;
    }

    /**
     * @inheritDoc
     */
    public function getRate(RateQueryEntity $entity): ?RateEntity
    {
        $xmlRates = $this->bridge->getXmlRates($entity);

        $rates = XmlHelper::toArray($xmlRates);

        if (!$rates || !Arr::get($rates, 'Record')) {
            return null;
        }

        $rates = array_reverse(Arr::get($rates, 'Record'));

        if (Arr::get($rates, '0')) {
            $currentRate = $this->toFloat(Arr::get($rates, '0.Value'));
            $previousRate = $this->toFloat(Arr::get($rates, '1.Value'));
            $diff = round($currentRate - $previousRate, 5);
            $percentDiff = round($diff / $currentRate * 100, 2);
        } else {
            $currentRate = $this->toFloat(Arr::get($rates, 'Value'));
        }

        return new RateEntity(
            $currentRate,
            $diff ?? null,
            $percentDiff ?? null
        );
    }

    /**
     * @param string|null $value
     * @return float|null
     */
    private function toFloat(?string $value): ?float
    {
        if (!$value) {
            return null;
        }

        $val = str_replace(",", ".", $value);
        return floatval($val);
    }
}