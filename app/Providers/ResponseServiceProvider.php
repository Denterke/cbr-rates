<?php

namespace App\Providers;

use App\Http\Responses\Abstracts\AbstractResponse;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        JsonResource::wrap('items');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value, $code = AbstractResponse::SUCCESS, $headers = []) {
            if ($value instanceof JsonResource) {
                $value = $value->response()->getData(true);
            }
            return new SuccessResponse($value, $code, $headers);
        });

        Response::macro('error', function ($value, $code, $headers = []) {
            if ($value instanceof JsonResource) {
                $value = $value->response()->getData(true);
            }
            return new ErrorResponse($value, $code, $headers);
        });
    }
}
