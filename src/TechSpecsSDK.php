<?php

namespace TechSpecsSDK;

use \TechSpecsSDK\Http\Client as Client;
use \TechSpecsSDK\Response\ResponseHandler;

class TechSpecsSDK
{
    use Traits\DateStringTrait;

    const URL = 'https://apis.dashboard.techspecs.io/';
    private $client;

    public function __construct($techSpecsBase, $apiKey)
    {
        $this->client = (new Client($techSpecsBase, $apiKey))->getGuzzleClient();
    }

    public function search(string $keyword, array $category, string $mode = 'raw')
    {
        $path = 'product/search';

        $params = http_build_query(['query' => $keyword]);

        $payload = [
            'category' => $category,
        ];

        $response = $this->client->request(
            'POST',
            $path . '?' . $params,
            ['body' => json_encode($payload)]
        );

        return ResponseHandler::search($response->getBody(), $mode);
    }

    public function productDetail(string $productId, string $mode = 'raw')
    {
        $path = 'product/get';

        $response = $this->client->request('GET', $path . '/' . $productId);

        return ResponseHandler::productDetail($response->getBody(), $mode);
    }

    public function brands(string $mode = 'raw')
    {
        $path = 'product/brands';

        $response = $this->client->request('GET', $path);

        return ResponseHandler::brands($response->getBody(), $mode);
    }

    public function categories(string $mode = 'raw')
    {
        $path = 'category/getAll';

        $response = $this->client->request('GET', $path);

        return ResponseHandler::categories($response->getBody(), $mode);
    }

    public function products(
        array $brand,
        array $category,
        string $dateFrom = '',
        string $dateTo = '',
        int $page = null,
        string $mode = 'raw'
    ) {
        $this->checkDateFormat($dateFrom);
        $this->checkDateFormat($dateTo);

        $path = 'product/getAll';

        $params = ($page !== null) ? '?' . http_build_query(['page' => $page]) : '';

        $payload = [
            'brand'    => $brand,
            'category' => $category,
            'from'     => $dateFrom,
            'to'       => $dateTo,
        ];

        $response = $this->client->request(
            'POST',
            $path . $params,
            ['body' => json_encode($payload)]
        );

        return ResponseHandler::products($response->getBody(), $mode);
    }
}
