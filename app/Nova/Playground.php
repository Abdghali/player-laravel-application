<?php

namespace App\Nova;

use AbdoNajjar\GoogleMapMarker\GoogleMapMarker;
use App\Nova\Actions\Activate;
use App\Nova\Actions\Deactivate;
use App\Nova\Filters\CityFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use devops\MapAddress\MapAddress;
use Whitecube\NovaGoogleMaps\GoogleMaps;

class Playground extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Playground::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'city'      => ['name'],
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'min:3', 'max:255')
                ->creationRules('unique:playgrounds,name')
                ->updateRules('unique:playgrounds,name,{{resourceId}}'),

            BelongsTo::make(__('City'), 'city', City::class)
                ->sortable()
                ->rules('required', 'exists:cities,id'),

            Boolean::make(__('Status'), 'status')->hideWhenCreating(),

            GoogleMapMarker::make(__('Location'), 'location')
            ->zoom(6)
            ->lat(24.317106890255317)
            ->lng(42.65115177903716),

            // GoogleMaps::make(__('Location'), 'location')
            //     ->zoom(6) // Optionally set the zoom level
            //     ->defaultCoordinates(
            //         24.317106890255317,
            //         42.65115177903716
            //     ),

            HasMany::make(__('Games'), 'games', Game::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new CityFilter
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new Activate(__('Playground')),
            new Deactivate(__('Playground'))
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Playgrouds');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Playground');
    }
}
