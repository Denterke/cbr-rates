<?php

namespace App\Providers;

use App\Bridges\CbrBridge;
use App\Bridges\Contracts\CbrBridgeInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class BridgeServiceProvider extends ServiceProvider
{
    /**
     * Register RatesServiceProvider service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CbrBridgeInterface::class, function () {
            return new CbrBridge(
                new Factory(),
                Config::get('bridge.cbr.scheme'),
                Config::get('bridge.cbr.host'),
                Config::get('bridge.cbr.base_path'),
            );
        });
    }
}
