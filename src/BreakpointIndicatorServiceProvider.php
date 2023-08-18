<?php

namespace ReedTech\BreakpointIndicator;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Icon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use ReedTech\BreakpointIndicator\Commands\BreakpointIndicatorCommand;
use ReedTech\BreakpointIndicator\Testing\TestsBreakpointIndicator;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BreakpointIndicatorServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-breakpoint-indicator';

    // public static string $viewNamespace = 'filament-breakpoint-indicator';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToStarRepoOnGitHub('chrisreedio/filament-breakpoint-indicator');
            });
    }

    protected function getAssetPackageName(): ?string
    {
        return 'chrisreedio/filament-breakpoint-indicator';
    }
}
