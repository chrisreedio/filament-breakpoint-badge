<?php

namespace ReedTech\BreakpointIndicator\Commands;

use Illuminate\Console\Command;

class BreakpointIndicatorCommand extends Command
{
    public $signature = 'filament-breakpoint-indicator';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
