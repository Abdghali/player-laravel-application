<?php

namespace App\Nova\Filters;

use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class CityFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('city_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return City::all()->pluck('id', 'name')->toArray();
    }

        /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return __('City Filter');
    }
}
