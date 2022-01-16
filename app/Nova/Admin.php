<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Admin extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Admin::class;

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
        'id', 'name', 'email', 'status'
    ];



    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('id', '<>', FIRST_RECORD);
    }

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
                ->rules('required', 'min:3', 'max:255')
                ->creationRules('required', 'unique:admins,name', 'min:3')
                ->updateRules('unique:admins,name,{{resourceId}}'),

            Text::make(__('Email'), 'email')
                ->rules('required', 'email', 'min:3', 'max:255')
                ->creationRules('required', 'unique:admins,name', 'email')
                ->updateRules('unique:admins,name,{{resourceId}}', 'email'),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8', 'confirmed')
                ->updateRules('nullable', 'string', 'min:8')
                ->hideFromIndex(),

            PasswordConfirmation::make(__('Confirm Password'), 'password_confirmation'),

            Boolean::make(__('Status'), 'status')->hideWhenCreating(),

            HasMany::make(__('Messages'), 'messages', Message::class)

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
        return [];
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
        return [];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Admins');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Admin');
    }
}
