<?php


namespace App\Http\Responses;


use App\Http\Responses\Abstracts\AbstractResponse;

/**
 *
 */
class ErrorResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected string $status = 'error';

    /**
     * @var int
     */
    protected int $defaultCode = self::ERROR_UNKNOWN;
}

