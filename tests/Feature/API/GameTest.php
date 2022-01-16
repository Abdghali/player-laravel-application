<?php

namespace Tests\Feature\API;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function list_all_games()
    {

        $this->seed();

        $this->actingAsSanctumUser();

        $response = $this->getJson(route('games.index'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'fees',
                    'date',
                    'time',
                    'city_name',
                    'original_time',
                    'max_players',
                    'playground_name',
                    'playground_id',
                    'organizer',
                    'description',
                    'number_of_players',
                    'players'   => [
                        [
                            'id',
                            'name',
                        ]
                    ]
                ]
            ]
        ]);
    }

    // /** @test */
    // public function last_games()
    // {

    //     $this->seed();

    //     $this->actingAsSanctumUser();

    //     Game::first()->users()->syncWithoutDetaching(user()->id);

    //     $response = $this->getJson(route('games.next-games'));

    //     $response->assertOk();

    //     $response->assertJsonStructure([
    //         'data' => [
    //             [
    //                 'id',
    //                 'fees',
    //                 'date',
    //                 'time',
    //                 'original_time',
    //                 'max_players',
    //                 'playground_name',
    //                 'organizer',
    //                 'location',
    //                 'playground_id',
    //                 'description',
    //                 'number_of_players',
    //                 'players'   => [
    //                     [
    //                         'id',
    //                         'name',
    //                     ]
    //                 ]
    //             ]
    //         ]
    //     ]);
    // }

    // /** @test */
    // public function next_games()
    // {
    //     $this->seed();

    //     $this->actingAsSanctumUser();

    //     Game::first()->users()->syncWithoutDetaching(user()->id);


    //     $response = $this->getJson(route('games.next-games'));

    //     $response->assertOk();

    //     $response->assertJsonStructure([
    //         'data' => [
    //             [
    //                 'id',
    //                 'fees',
    //                 'date',
    //                 'time',
    //                 'original_time',
    //                 'max_players',
    //                 'playground_name',
    //                 'organizer',
    //                 'playground_id',
    //                 'location',
    //                 'description',
    //                 'number_of_players',
    //                 'players'   => [
    //                     [
    //                         'id',
    //                         'name',
    //                     ]
    //                 ]
    //             ]
    //         ]
    //     ]);
    // }


    /** @test */
    public function show_game()
    {

        $this->seed();

        $this->actingAsSanctumUser();

        $response = $this->getJson(route('games.show', Game::first()));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'fees',
                'date',
                'time',
                'city_name',
                'original_time',
                'max_players',
                'playground_name',
                'organizer',
                'playground_id',
                'description',
                'number_of_players',
                'players'   => [
                    [
                        'id',
                        'name',
                    ]
                ]
            ]
        ]);
    }
}
