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
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use ReedTech\BreakpointIndicator\Commands\BreakpointIndicatorCommand;
use ReedTech\BreakpointIndicator\Testing\TestsBreakpointIndicator;

class BreakpointIndicatorServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-breakpoint-indicator';

    public static string $viewNamespace = 'filament-breakpoint-indicator';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('chrisreedio/filament-breakpoint-indicator');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-breakpoint-indicator/{$file->getFilename()}"),
                ], 'filament-breakpoint-indicator-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsBreakpointIndicator());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'chrisreedio/filament-breakpoint-indicator';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-breakpoint-indicator', __DIR__ . '/../resources/dist/components/filament-breakpoint-indicator.js'),
            Css::make('filament-breakpoint-indicator-styles', __DIR__ . '/../resources/dist/filament-breakpoint-indicator.css'),
            Js::make('filament-breakpoint-indicator-scripts', __DIR__ . '/../resources/dist/filament-breakpoint-indicator.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            BreakpointIndicatorCommand::class,
        ];
    }

    /**
     * @return array<string, Icon>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-breakpoint-indicator_table',
        ];
    }
}
