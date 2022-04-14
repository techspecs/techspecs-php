<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    const TestedClass = 'TechSpecsSDK\Http\Client';

    private static function mockPrivateMethod($privateMethodName)
    {
        $class = new ReflectionClass(self::TestedClass);
        $method = $class->getMethod($privateMethodName);
        $method->setAccessible(true);

        return $method;
    }

    public function testSetUri()
    {
        $privateMethod = self::mockPrivateMethod('setUri');

        $mock = $this->getMockBuilder(self::TestedClass)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertSame($privateMethod->invokeArgs($mock, ['4ZU']), 'https://apis.dashboard.techspecs.io/4ZU/api/');
    }

    public function testSetHeader()
    {
        $privateMethod = self::mockPrivateMethod('setHeader');

        $mock = $this->getMockBuilder(self::TestedClass)
            ->disableOriginalConstructor()
            ->getMock();

        $return = $privateMethod->invokeArgs($mock, ['myPrivateKey']);
        $this->assertSame($return['x-blobr-key'], 'myPrivateKey');
    }

    public function testSetGuzzleClient()
    {
        $privateMethod = self::mockPrivateMethod('setGuzzleClient');

        $class = new \TechSpecsSDK\Http\Client('base', 'myPrivateKey');
        $return = $privateMethod->invokeArgs($class, []);

        $this->assertInstanceOf('\GuzzleHttp\Client', $return);
    }

    public function testGetGuzzleClient()
    {
        $privateMethod = self::mockPrivateMethod('getGuzzleClient');

        $class = new \TechSpecsSDK\Http\Client('base', 'myPrivateKey');
        $return = $privateMethod->invokeArgs($class, []);

        $this->assertInstanceOf('\GuzzleHttp\Client', $return);
    }
}
