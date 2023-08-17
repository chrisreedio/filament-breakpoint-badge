<?php

namespace ReedTech\BreakpointIndicator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ReedTech\BreakpointIndicator\BreakpointIndicator
 */
class BreakpointIndicator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ReedTech\BreakpointIndicator\BreakpointIndicator::class;
    }
}
