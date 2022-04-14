<?php

namespace TechSpecsSDK\Http;

use \GuzzleHttp\Client as Guzzle;

class Client
{
    const URL = 'https://apis.dashboard.techspecs.io/';
    private string $uri;
    private array $headers;
    private \GuzzleHttp\Client $guzzleClient;

    public function __construct(string $techSpecsBase, string $apiKey)
    {
        $this->uri = $this->setUri($techSpecsBase);
        $this->headers = $this->setHeader($apiKey);
        $this->guzzleClient = $this->setGuzzleClient();
    }

    private function setUri(string $techSpecsBase)
    {
        return self::URL . $techSpecsBase . '/api/';
    }

    private function setHeader(string $key)
    {
        return [
            'Accept'       => 'application/json',
            'x-blobr-key'  => $key,
            'Content-Type' => 'application/json',
        ];
    }

    private function setGuzzleClient(): \GuzzleHttp\Client
    {
        return new Guzzle([
            'base_uri' => $this->uri,
            'headers'  => $this->headers,
        ]);
    }

    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }
}
