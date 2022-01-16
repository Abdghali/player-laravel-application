<?php

namespace App\Providers;

use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\LensResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Abdo\RestoreFeesCard\RestoreFeesCard;
use App\Models\RestoreFee;
use Abdo\ApplicationsCard\ApplicationsCard;
use App\Models\Application;
use Abdo\PlaygroudsCard\PlaygroudsCard;
use App\Models\Playground;
use Abdo\AdminsCard\AdminsCard;
use App\Models\Admin;
use Abdo\UsersCard\UsersCard;
use App\Models\User;
use Abdo\GamesCard\GamesCard;
use App\Models\Game;
use App\Nova\Metrics\GamesPerCity;
use App\Nova\Metrics\GamesPerPlayground;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::style('admin', public_path('css/admin.css'));

        Nova::script('admin', public_path('js/admin.js'));
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new RestoreFeesCard)->value(RestoreFee::unseenCount())->name(__('Restore Fees')),
            (new ApplicationsCard())->value(Application::unseenCount())->name(__('Applications')),
            (new PlaygroudsCard())->value(Playground::count())->name(__('Playgrouds')),
            (new AdminsCard())->value(Admin::count())->name(__('Admins')),
            (new UsersCard())->value(User::count())->name(__('Users')),
            (new GamesCard())->value(Game::count())->name(__('Games')),
            (new GamesPerPlayground())->width('1/2'),
            (new GamesPerCity())->width('1/2')
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new CollapsibleResourceManager([
                'navigation' => [
                    TopLevelResource::make([
                        'label' => __('System Users'),
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Admin::class,
                            \App\Nova\User::class
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v2zm1-5a1 1 0 0 1 0-2 5 5 0 0 1 5 5v2a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3zm-2-4a1 1 0 0 1 0-2 3 3 0 0 0 0-6 1 1 0 0 1 0-2 5 5 0 0 1 0 10z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => __('System Constants'),
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Setting::class,
                            \App\Nova\City::class,
                            \App\Nova\Playground::class,
                            \App\Nova\PlayerType::class
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M8 4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2zm0 2H6v14h12V6h-2a2 2 0 0 1-2 2h-4a2 2 0 0 1-2-2zm2-2v2h4V4h-4z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => __('Games'),
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Game::class,
                            LensResource::make(
                                \App\Nova\Game::class,
                                \App\Nova\Lenses\RunningGame::class
                            ),
                            LensResource::make(
                                \App\Nova\Game::class,
                                \App\Nova\Lenses\WaitingGame::class
                            )

                        ],
                        'icon' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    width="20px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                <g id="_x23_020202ff">
                                    <path  d="M405.808,81.88c26.389,22.628,47.566,51.358,61.298,83.305c24.077,55.303,24.884,120.201,2.299,176.12
                                        c-25.569,64.954-82.47,116.608-149.717,135.488c-55.443,16.101-116.99,10.373-168.283-16.229
                                        c-42.738-21.793-78.298-57.325-100.014-100.111c-33.057-63.492-33.417-142.625-1.258-206.532
                                        c16.914-34.125,42.477-63.916,73.645-85.794c52.057-37.235,120.159-50.537,182.49-36.316
                                        C342.946,39.794,377.439,57.344,405.808,81.88 M220.262,53.695c6.385,6.583,12.537,13.414,19.112,19.806
                                        c29.381,4.56,58.741,9.341,88.134,13.718c8.401-3.932,16.511-8.465,24.849-12.531C312.399,52.946,264.98,45.847,220.262,53.695
                                        M438.036,160.864c-4.009,7.559-7.735,15.26-11.73,22.818c-1.244,1.684-0.36,3.755-0.148,5.608
                                        c4.342,27.874,8.712,55.749,13.054,83.622c5.636,6.796,12.784,12.53,19.035,18.88C466.321,247.541,459.109,200.617,438.036,160.864
                                        M324.017,96.836c-28.087-4.469-56.194-8.846-84.309-13.188c-11.045,21.695-22.061,43.417-32.832,65.245
                                        c5.756,15.656,11.583,31.296,17.445,46.917c24.417,3.825,48.818,7.764,73.249,11.504c12.784-12.516,25.371-25.244,37.992-37.922
                                        C331.787,145.195,327.969,120.997,324.017,96.836 M415.184,188.016c-24.155-3.987-48.346-7.784-72.549-11.511
                                        c-12.722,12.537-25.315,25.229-37.923,37.88c3.755,24.472,7.7,48.91,11.61,73.355c15.741,5.643,31.275,11.871,47.086,17.345
                                        c21.701-10.868,43.396-21.771,65.005-32.803C424.037,244.19,419.744,216.082,415.184,188.016 M127.617,145.605
                                        c-13.604,23.787-26.919,47.751-40.284,71.666c17.338,17.423,34.571,34.952,52.05,52.221c13.965-1.11,27.952-1.889,41.911-3.077
                                        c11.342-22.118,22.634-44.271,33.828-66.468c-5.756-15.5-11.88-30.872-17.762-46.33
                                        C174.152,150.675,150.86,148.299,127.617,145.605 M311.904,296.841c-22.119,11.215-44.236,22.458-66.306,33.778
                                        c-1.308,13.951-1.924,27.96-3.14,41.917c17.041,17.607,34.26,35.053,51.513,52.447c25.166-12.594,50.261-25.301,75.363-38.015
                                        c-3.443-24.049-7.135-48.076-10.755-72.104C343.094,308.699,327.531,302.653,311.904,296.841 M114.663,106.983
                                        c-33.39,31.452-55.677,74.444-61.964,119.89c8.301-4.299,16.814-8.272,24.968-12.805c13.944-24.961,28.178-49.801,41.839-74.904
                                        C118.022,128.415,116.318,117.702,114.663,106.983 M375.543,395.1c-25.484,12.686-50.855,25.64-76.304,38.403
                                        c-1.16,0.637-2.616,1.089-3.161,2.438c-4.017,7.878-8.068,15.733-12.085,23.611c45.086-6.096,87.915-27.727,119.438-60.551
                                        C394.147,397.653,384.877,396.048,375.543,395.1 M182.517,276.391c-14.008,0.898-28.016,1.781-42.002,2.941
                                        c-11.165,21.715-22.302,43.445-33.397,65.203c19.876,19.933,39.542,40.093,59.63,59.813c21.786-10.953,43.551-21.942,65.294-32.979
                                        c1.238-14.008,2.538-28.009,3.542-42.037C217.859,311.719,200.322,293.914,182.517,276.391 M71.233,345.773
                                        c19.756,40.757,53.414,74.5,94.009,94.547c-1.484-9.235-2.468-18.618-4.475-27.712c-20.705-20.789-41.303-41.712-62.163-62.331
                                        C89.553,348.425,80.361,347.236,71.233,345.773z"/>
                                </g>
                                </svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => __('Communication'),
                        'expanded' => false,
                        'resources' => [
                            \App\Nova\Application::class,
                            \App\Nova\RestoreFee::class,
                            \App\Nova\Message::class
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/></svg>'
                    ]),
                ]
            ]),
            new \Runline\ProfileTool\ProfileTool,
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
