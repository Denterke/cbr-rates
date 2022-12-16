<?php

namespace App\Http\Controllers;

use App\Http\Responses\Abstracts\AbstractResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $content
     * @param int $code
     * @param array $headers
     * @return JsonResponse
     */
    protected function success($content, int $code = AbstractResponse::SUCCESS, $headers = [])
    {
        return response()->success($content, $code, $headers);
    }

    /**
     * @param $content
     * @param int $code
     * @param array $headers
     * @return JsonResponse
     */
    protected function error($content, int $code = AbstractResponse::ERROR_UNKNOWN, $headers = [])
    {
        return response()->error($content, $code, $headers);
    }
}
