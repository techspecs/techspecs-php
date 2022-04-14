<?php

namespace TechSpecsSDK\Response;

use Psr\Http\Message\StreamInterface;

class ResponseHandler extends AbstractResponseHandler
{
    public static function search(StreamInterface $response, string $mode)
    {
        return ResponseHandler::response($response, 'results', $mode);
    }

    public static function productDetail(StreamInterface $response, string $mode)
    {
        return ResponseHandler::response($response, 'product', $mode);
    }

    public static function brands(StreamInterface $response, string $mode)
    {
        return ResponseHandler::response($response, 'brands', $mode);
    }

    public static function categories(StreamInterface $response, string $mode)
    {
        $responseObject = ResponseHandler::streamToObject($response);

        if ($mode === 'raw') {
            return json_encode($responseObject, JSON_PRETTY_PRINT);
        } elseif ($mode === 'pretty') {
            return json_encode(
                $responseObject['data']['Category'][1],
                JSON_PRETTY_PRINT
            );
        }

        return 'Invalid Mode';
    }

    public static function products(StreamInterface $response, string $mode)
    {
        return ResponseHandler::response($response, 'product', $mode);
    }
}
