<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use TechSpecsSDK\Traits\DateStringTrait;

final class DateStringTraitTest extends TestCase
{
    use DateStringTrait;

    public function testCheckDateFormat()
    {
        $this->assertTrue($this->checkDateFormat(''));

        $str = '1990-12-19';
        $this->assertTrue($this->checkDateFormat($str));

        $this->expectException(Exception::class);
        $this->checkDateFormat('-');
    }

    public function testYearCheck()
    {
        $this->assertFalse($this->yearCheck(0));
    }

    public function testMonthCheck()
    {
        $this->assertFalse($this->monthCheck(13));
    }

    public function testDayCheck()
    {
        $this->assertFalse($this->dayCheck(32));
    }
}
