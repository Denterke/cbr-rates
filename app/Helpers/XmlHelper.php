<?php

namespace App\Helpers;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

/**
 *
 */
class XmlHelper
{
    /**
     * @param PromiseInterface|Response $xml
     * @return array|null
     */
    public static function toArray(PromiseInterface|Response $xml): ?array
    {
        $doc = @simplexml_load_string($xml);

        if ($doc) {
            $xml = simplexml_load_string($xml);
            $json = json_encode($xml);

            return json_decode($json, true);
        }

        return null;
    }
}