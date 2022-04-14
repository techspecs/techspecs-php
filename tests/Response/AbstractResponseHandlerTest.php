<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

final class AbstractResponseHandlerTest extends TestCase
{
    const TestedClass = 'TechSpecsSDK\Response\AbstractResponseHandler';

    public function testStreamToObject()
    {
        $stub = $this->getMockForAbstractClass(TechSpecsSDK\Response\AbstractResponseHandler::class);

        $testStream = ['value' => 123];

        $mockInterface = $this->createMock(StreamInterface::class);
        $mockInterface->method('__toString')
            ->will(
                $this->returnValue(json_encode($testStream))
            );

        $this->assertSame($stub::streamToObject($mockInterface), $testStream);
    }

    public function testCheckKey()
    {
        $this->expectExceptionMessage('Undefined Key.');

        $stub = $this->getMockForAbstractClass(TechSpecsSDK\Response\AbstractResponseHandler::class);

        $key = 'non_supported_key';
        $stub::checkKey($key);
    }

    public function testResponse()
    {
        $stub = $this->getMockForAbstractClass(TechSpecsSDK\Response\AbstractResponseHandler::class);

        $key = 'results';

        $testStream = [
            'data' => [
                $key => 'This is the content of the key',
            ],
        ];

        $mockInterface = $this->createMock(StreamInterface::class);
        $mockInterface->method('__toString')
            ->will(
                $this->returnValue(json_encode($testStream))
            );

        $this->assertSame($stub::response($mockInterface, $key, 'raw'), json_encode($testStream, JSON_PRETTY_PRINT));
        $this->assertSame($stub::response($mockInterface, $key, 'pretty'), json_encode($testStream['data'][$key], JSON_PRETTY_PRINT));
        $this->assertSame($stub::response($mockInterface, $key, 'other'), 'Invalid Mode');
    }
}
