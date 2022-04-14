<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use TechSpecsSDK\Response\ResponseHandler;

final class ResponseHandlerTest extends TestCase
{
    public function testCategories()
    {
        $key = 'Category';

        $testStream = [
            'data' => [
                $key => ['first key', 'This is the content of the second key'],
            ],
        ];

        $mockInterface = $this->createMock(StreamInterface::class);
        $mockInterface->method('__toString')
            ->will(
                $this->returnValue(json_encode($testStream))
            );

        $this->assertSame(ResponseHandler::categories($mockInterface, 'raw'), json_encode($testStream, JSON_PRETTY_PRINT));
        $this->assertSame(ResponseHandler::categories($mockInterface, 'pretty'), json_encode($testStream['data'][$key][1], JSON_PRETTY_PRINT));
        $this->assertSame(ResponseHandler::categories($mockInterface, 'other'), 'Invalid Mode');
    }

    public function testOthers()
    {
        $testStream = [
            'data' => [],
        ];

        $mockInterface = $this->createMock(StreamInterface::class);
        $mockInterface->method('__toString')
            ->will(
                $this->returnValue(json_encode($testStream))
            );

        $this->assertSame(ResponseHandler::search($mockInterface, 'other'), 'Invalid Mode');
        $this->assertSame(ResponseHandler::productDetail($mockInterface, 'other'), 'Invalid Mode');
        $this->assertSame(ResponseHandler::brands($mockInterface, 'other'), 'Invalid Mode');
        $this->assertSame(ResponseHandler::products($mockInterface, 'other'), 'Invalid Mode');
    }
}
