<?php

namespace Tests\Feature\API;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function list_all_cities()
    {

        $this->seed();

        $response = $this->getJson(route('cities.index'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name'
                ]
            ]
        ]);
    }



    /** @test */
    public function show_city()
    {

        $this->seed();

        $response = $this->getJson(route('cities.show', City::first()));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name'
            ]
        ]);
    }
}
