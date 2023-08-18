# Tailwind Breakpoint Badge for Filament v3 Header

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisreedio/filament-breakpoint-indicator.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/filament-breakpoint-indicator)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/filament-breakpoint-indicator/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/chrisreedio/filament-breakpoint-indicator/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/filament-breakpoint-indicator/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/chrisreedio/filament-breakpoint-indicator/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisreedio/filament-breakpoint-indicator.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/filament-breakpoint-indicator)

Breakpoint Indicator is a lightweight extension for FilamentPHP that adds a real-time breakpoint indicator to the header, streamlining the debugging process. 

## Installation

You can install the package via composer:

```bash
composer require chrisreedio/filament-breakpoint-indicator
```

## Usage

To use this plugin register it in your panel configuration:

```php
use ReedTech\FilamentBreakpointIndicator\BreakpointIndicatorPlugin;

$panel
    ->plugins([
        BreakpointIndicatorPlugin::make(),
    ]);
```

### Visibility

By default, the plugin displays the breakpoint badge in all non-production environments. 
You can further customize whether the indicators should be shown.

```php
use ReedTech\FilamentBreakpointIndicator\BreakpointIndicatorPlugin;

$panel->plugins([
    BreakpointIndicatorPlugin::make()
        ->visible(fn () => auth()->user()?->can('see_breakpoints'))
]);
```

### Colors

You can overwrite the default colors if you want your own colors or need to add more. The `->color()`method accepts any Filament's Color object or a closure that returns a color object.

```php
use pxlrbt\FilamentEnvironmentIndicator\EnvironmentIndicatorPlugin;
use Filament\Support\Colors\Color;

$panel->plugins([
    BreakpointIndicatorPlugin::make()
        ->color(fn () => match (app()->environment()) {
            'production' => null,
            'staging' => Color::Orange,
            default => Color::Blue,
        })
]);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Chris Reed](https://github.com/chrisreedio)
- [All Contributors](../../contributors)

Special thanks to [Adam Weston](https://github.com/awcodes) for the help writing the plugin.

Also a big thanks to [Dennis Koch](https://github.com/pxlrbt) for the inspiration and tips on generating screenshots. 
Check out his [Filament Environment Indicator](https://github.com/pxlrbt/filament-environment-indicator) plugin on which this is based!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
