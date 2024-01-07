<?php

namespace App\Helpers;

class Operations
{
    final public static function intShiftInRange(int $minValue, int $maxValue, int $value, int $dataMin, int $dataMax): int
    {
        return ((($maxValue - $minValue) * ($value - $dataMin)) / ($dataMax - $dataMin)) + $minValue;
    }
}