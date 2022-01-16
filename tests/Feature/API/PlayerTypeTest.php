<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerTypeTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    
    /** @test */
    public function list_all_players_type()
    {
        $this->seed();

        $response = $this->getJson(route('playerTypes.index'));
        
        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data'  => [
                [
                    'id',
                    'name'
                ]
            ]
        ]);
    }
    

}
