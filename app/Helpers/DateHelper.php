<?php

namespace App\Helpers;

use Ixudra\Convert\Convert;

class DateHelper
{
    public static function convertToNepali($date)
    {
        return Convert::toNepali($date);
    }

    public static function convertToGregorian($nepaliDate)
    {
        return Convert::toGregorian($nepaliDate);
    }
}