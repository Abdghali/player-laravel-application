<?php

namespace App\Nova;

use App\Models\Game as ModelsGame;
use App\Nova\Filters\GameFilter;
use App\Nova\Lenses\RunningGame;
use App\Nova\Lenses\WaitingGame;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Game extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Game::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'start', 'fees', 'max_players', 'description'
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'admin'      => ['name'],
        'playground' => ['name']
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

            BelongsTo::make(__('Game Organizer'), 'admin', AdminSelect::class)
                ->rules('required')->sortable(),

            BelongsTo::make(__('Playground'), 'playground', Playground::class)
                ->rules('required')->sortable(),

            DateTime::make(__('Start'), 'start')
                ->rules('required')
                ->format('YYYY-MM-DD h:mm A')
                ->onlyOnForms(),

            DateTime::make(__('Start'), 'start')->format('YYYY-MM-DD')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make(__('Time'), 'time')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Number::make(__('Fees'), 'fees')
                ->min(1)
                ->rules('required', 'min:1')->sortable(),

            Number::make(__('Max Players'), 'max_players')
                ->min(1)
                ->rules('required', 'min:1')->sortable(),

            Textarea::make(__('Description'), 'description')
                ->rules('required')->sortable(),

            Select::make(__('Type'), 'type')->options([
                ModelsGame::RUNNNIG => __('Running Games'),
                ModelsGame::WAITNIG => __('Waiting Games')
            ])->displayUsingLabels()
                ->rules('required'),

            BelongsToMany::make(__('Users'), 'users', User::class)
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
            new GameFilter
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
        return [
            new RunningGame(),
            new WaitingGame()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('All Games');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Game');
    }
}
