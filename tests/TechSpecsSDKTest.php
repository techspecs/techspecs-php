<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \TechSpecsSDK\TechSpecsSDK;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\StreamInterface;

final class TechSpecsSDKTest extends TestCase
{
    public function mockStreamInterface()
    {
        $mockClient = $this->createMock(StreamInterface::class);

        return $mockClient;
    }

    public function mockResponseInterface()
    {
        $mockClient = $this->createMock(ResponseInterface::class);
        $mockClient->expects($this->once())
                    ->method('getBody')
                    ->will(
                        $this->returnValue($this->mockStreamInterface())
                    );

        return $mockClient;
    }

    public function testSearch()
    {
        $keyword = 'apple';
        $category = 'smartphone';

        $payload = [
            'category' => [$category],
        ];

        $options = ['body' => json_encode($payload)];

        $class = new TechSpecsSDK('', '');

        $reflection = new ReflectionObject($class);

        $property = $reflection->getProperty('client');
        $property->setAccessible(true);

        $mockClient = $this->createMock(\GuzzleHttp\Client::class);
        $mockClient ->expects($this->once())
                    ->method('request')
                    ->with(
                        $this->stringStartsWith('POST'),
                        $this->stringContains($keyword),
                        $this->logicalAnd(
                            $this->arrayHasKey('body'),
                            $this->equalTo($options)
                        ),
                    )
                    ->will(
                        $this->returnValue($this->mockResponseInterface())
                    );

        $property->setValue($class, $mockClient);
        $class->search($keyword, [$category]);
    }

    public function testProductDetail()
    {
        $productId = '123XYZ';

        $class = new TechSpecsSDK('', '');

        $reflection = new ReflectionObject($class);

        $property = $reflection->getProperty('client');
        $property->setAccessible(true);

        $mockClient = $this->createMock(\GuzzleHttp\Client::class);
        $mockClient ->expects($this->once())
                    ->method('request')
                    ->with(
                        $this->stringStartsWith('GET'),
                        $this->stringContains($productId),
                    )
                    ->will(
                        $this->returnValue($this->mockResponseInterface())
                    );

        $property->setValue($class, $mockClient);
        $class->productDetail($productId);
    }

    public function testBrands()
    {
        $class = new TechSpecsSDK('', '');

        $reflection = new ReflectionObject($class);

        $property = $reflection->getProperty('client');
        $property->setAccessible(true);

        $mockClient = $this->createMock(\GuzzleHttp\Client::class);
        $mockClient ->expects($this->once())
                    ->method('request')
                    ->with(
                        $this->stringStartsWith('GET'),
                        $this->anything(),
                    )
                    ->will(
                        $this->returnValue($this->mockResponseInterface())
                    );

        $property->setValue($class, $mockClient);
        $class->brands();
    }

    public function testCategories()
    {
        $class = new TechSpecsSDK('', '');

        $reflection = new ReflectionObject($class);

        $property = $reflection->getProperty('client');
        $property->setAccessible(true);

        $mockClient = $this->createMock(\GuzzleHttp\Client::class);
        $mockClient ->expects($this->once())
                    ->method('request')
                    ->with(
                        $this->stringStartsWith('GET'),
                        $this->anything(),
                    )
                    ->will(
                        $this->returnValue($this->mockResponseInterface())
                    );

        $property->setValue($class, $mockClient);
        $class->categories();
    }

    public function testProducts()
    {
        $page = '1';

        $brand = ['Apple'];
        $category = ['smartphone'];
        $dateFrom = '';
        $dateTo = '';

        $payload = [
            'brand'    => $brand,
            'category' => $category,
            'from'     => $dateFrom,
            'to'       => $dateTo,
        ];

        $options = ['body' => json_encode($payload)];

        $class = new TechSpecsSDK('', '');

        $reflection = new ReflectionObject($class);

        $property = $reflection->getProperty('client');
        $property->setAccessible(true);

        $mockClient = $this->createMock(\GuzzleHttp\Client::class);
        $mockClient ->expects($this->once())
                    ->method('request')
                    ->with(
                        $this->stringStartsWith('POST'),
                        $this->stringContains($page),
                        $this->logicalAnd(
                            $this->arrayHasKey('body'),
                            $this->equalTo($options)
                        ),
                    )
                    ->will(
                        $this->returnValue($this->mockResponseInterface())
                    );

        $property->setValue($class, $mockClient);
        $class->products($brand, $category, $dateFrom, $dateTo, 1);
    }
}
