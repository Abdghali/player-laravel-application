<?php

namespace App\Nova\Metrics;

use App\Models\City;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class GamesPerCity extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {

        $cities = City::withCount('games')->get();

        return
            $this->result(
                $cities->flatMap(function ($city) {
                    return [
                        $city->name => $city->games_count
                    ];
                })->toArray()
            );
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
        return 'games-per-city';
    }

    public function name()
    {
        return __('Games Per City');
    }
}
