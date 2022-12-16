<?php


namespace App\Http\Responses;


use App\Http\Responses\Abstracts\AbstractResponse;

/**
 *
 */
class SuccessResponse extends AbstractResponse
{
    /**
     * @var string
     */
    protected string $status = 'success';

    /**
     * @var int
     */
    protected int $defaultCode = self::SUCCESS;
}

