<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function get_notification_settings()
    {

        $this->actingAsSanctumUser();

        $response = $this->getJson(route('notifications'));

        $response->assertOk();

        $response->assertJsonStructure([
            'notifications_settings'
        ]);
    }

    /** @test */
    public function update_notification_settings()
    {

        $this->actingAsSanctumUser();

        $response = $this->patchJson(route('notifications'), [
            'notifications_settings'    => INACTIVE
        ]);

        $response->assertNoContent();

        $this->assertEquals(INACTIVE, user()->notifications_settings);
    }
}
