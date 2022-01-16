<?php

namespace App\Nova\Metrics;

use App\Models\Game;
use App\Models\Playground;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class GamesPerPlayground extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Game::class, 'playground_id')
            ->label(function ($value) {
                return Playground::find($value)->name;
            });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'games-per-playground';
    }

    public function name()
    {
        return __('Games Per Playground');
    }
}
