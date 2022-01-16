<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function settings()
    {

        $this->actingAsSanctumUser();

        $response = $this->getJson(route('settings'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data'  => [
                'twitter',
                'whatsapp_number',
                'terms',
                'about_us'
            ]
        ]);
    }
}
