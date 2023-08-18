<?php

namespace ChrisReedIO\BreakpointBadge;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class BreakpointBadgePlugin implements Plugin
{
    use EvaluatesClosures;

    public bool | Closure | null $visible = null;

    public array | Closure | null $color = null;

    public function getId(): string
    {
        return 'filament-breakpoint-badge';
    }

    public function register(Panel $panel): void
    {
        $panel->renderHook('panels::global-search.start', function () {
            if (! $this->evaluate($this->visible)) {
                return '';
            }

            return View::make('filament-breakpoint-badge::badge', [
                'color' => $this->getColor(),
                'environment' => ucfirst(app()->environment()),
            ]);
        });

    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        $plugin = app(static::class);

        // Defaults
        $plugin->visible(function () {
            if (App::environment('production')) {
                return false;
            }

            return true;
        });

        $plugin->color(fn () => match (app()->environment()) {
            'production' => Color::Rose,
            'staging' => Color::Cyan,
            'development' => Color::Green,
            default => Color::Gray,
        });

        return $plugin;
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function visible(bool | Closure $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function color(array | Closure $color = Color::Gray): static
    {
        $this->color = $color;

        return $this;
    }

    protected function getColor(): mixed
    {
        return $this->evaluate($this->color);
    }
}
