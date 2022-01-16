<?php

namespace App\Nova;

use App\Nova\Actions\Activate;
use App\Nova\Actions\Deactivate;
use App\Nova\Filters\CityFilter;
use App\Nova\Filters\PlayerTypeFilter;
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email', 'number'
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'city'            => ['name'],
        'playerType'      => ['name'],
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

            Medialibrary::make(__('Image'), 'default')->readonly(),

            Text::make(__('Name'), 'name')
                ->sortable()->readonly(),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->hideFromIndex()->readonly(),

            BelongsTo::make(__('City'), 'city', City::class)->sortable()->readonly(),

            BelongsTo::make(__('Player Type'), 'playerType', PlayerType::class)->readonly(),

            Text::make(__('Number'), 'number')->readonly(),

            Boolean::make(__('Status'), 'status'),

            HasMany::make(__('Games'), 'games', Game::class),
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
            new CityFilter,
            new PlayerTypeFilter
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
            new Activate(__('User')),
            new Deactivate(__('User'))
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('User');
    }
}
