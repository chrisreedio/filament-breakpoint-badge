<?php

namespace ChrisReedIO\BreakpointBadge;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BreakpointBadgeServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-breakpoint-badge';

    // public static string $viewNamespace = 'filament-breakpoint-badge';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
			->hasViews()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->askToStarRepoOnGitHub('chrisreedio/filament-breakpoint-badge');
            });
    }

    protected function getAssetPackageName(): ?string
    {
        return 'chrisreedio/filament-breakpoint-badge';
    }
}
