<?php

namespace TechSpecsSDK\Response;

use \Psr\Http\Message\StreamInterface;

abstract class AbstractResponseHandler
{
    abstract public static function search(StreamInterface $response, string $mode);
    abstract public static function productDetail(
        StreamInterface $response,
        string $mode
    );
    abstract public static function brands(StreamInterface $response, string $mode);
    abstract public static function products(
        StreamInterface $response,
        string $mode
    );

    public static function streamToObject(StreamInterface $stream)
    {
        return json_decode($stream, true);
    }

    public static function checkKey(string $key)
    {
        $arrayKeys = ['results', 'product', 'brands', 'product'];

        if (!in_array($key, $arrayKeys)) {
            throw new \Exception('Undefined Key.');
        }
    }

    public static function response(
        StreamInterface $response,
        string $key,
        string $mode
    ) {
        AbstractResponseHandler::checkKey($key);
        $responseObject = AbstractResponseHandler::streamToObject($response);

        if ($mode === 'raw') {
            return json_encode($responseObject, JSON_PRETTY_PRINT);
        } elseif ($mode === 'pretty') {
            return json_encode($responseObject['data'][$key], JSON_PRETTY_PRINT);
        }

        return 'Invalid Mode';
    }
}
