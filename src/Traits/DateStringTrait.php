<?php

namespace TechSpecsSDK\Traits;

use Exception;

trait DateStringTrait
{
    public function dayCheck(int $day)
    {
        if ($day >= 1 && $day <= 31) {
            return $day;
        }

        return false;
    }

    public function monthCheck(int $month)
    {
        if ($month >= 1 && $month <= 12) {
            return $month;
        }

        return false;
    }

    public function yearCheck(int $year)
    {
        if ($year >= 1) {
            return $year;
        }

        return false;
    }

    public function checkDateFormat(string $dateString)
    {
        if ($dateString === '') {
            return true;
        }

        $array = explode('-', $dateString);

        if (count($array) === 3) {
            list($year, $month, $day) = $array;
            $arrayNumbers = \array_map('intval', $array);

            list($year, $month, $day) = $arrayNumbers;

            if ($this->dayCheck($day)
                and $this->monthCheck($month)
                and $this->yearCheck($year)
            ) {
                return true;
            }
        }

        throw new Exception('Invalid date format, use YYYY-MM-DD instead.');
    }
}
