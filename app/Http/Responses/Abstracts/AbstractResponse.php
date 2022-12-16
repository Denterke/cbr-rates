<?php


namespace App\Http\Responses\Abstracts;

use Illuminate\Http\Response;

/**
 * Abstract Response
 */
abstract class AbstractResponse extends Response
{
    /**
     * @var string
     */
    protected string $status;

    public const
        SUCCESS = 2000,
        ERROR_UNKNOWN = 4000,
        EMPTY_DATA = 4100,
        ERROR_VALIDATION = 4200;

    /**
     * @var int
     */
    protected int $defaultCode = self::SUCCESS;

    /**
     * @param $content
     * @param $code
     * @param array $headers
     */
    public function __construct($content, $code = null, array $headers = [])
    {
        $content = [
            'status' => $this->status,
            'code'   => $code ?? $this->defaultCode,
            'data'   => $content,
        ];

        parent::__construct($content, 200, $headers);
    }
}
