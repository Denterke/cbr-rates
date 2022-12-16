<?php

namespace App\Providers;

use App\Bridges\Contracts\CbrBridgeInterface;
use App\Services\Rates\RatesService;
use App\Services\Rates\RatesServiceInterface;
use Illuminate\Support\ServiceProvider;

class RatesServiceProvider extends ServiceProvider
{
    /**
     * Register RatesServiceProvider service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RatesServiceInterface::class, function () {
            return new RatesService(
                $this->app[CbrBridgeInterface::class]
            );
        });
    }
}
