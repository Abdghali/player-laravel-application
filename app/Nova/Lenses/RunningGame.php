<?php

namespace App\Nova\Lenses;

use App\Models\Game;
use App\Nova\Admin;
use App\Nova\Playground;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class RunningGame extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->where('type' , Game::RUNNNIG)
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make(__('Game Organizer'), 'admin', Admin::class)->sortable(),

            BelongsTo::make(__('Playground'), 'playground', Playground::class)->sortable(),

            DateTime::make(__('Start'), 'start')->format('YYYY-MM-DD')->sortable(),

            Text::make(__('Time'), 'time')->sortable(),

            Number::make(__('Fees'), 'fees')->sortable(),

            Number::make(__('Max Players'), 'max_players')->sortable(),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'running-game';
    }

    /**
     * Get the displayable name of the lens.
     *
     * @return string
     */
    public function name()
    {
        return __('Running Games');
    }
}
