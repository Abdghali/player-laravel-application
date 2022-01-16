<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_could_send_application_to_admin()
    {
        $this->actingAsSanctumUser();

        $response = $this->postJson(route('Applications.store'), [
            'content'   => $this->faker->sentence()
        ]);

        $response->assertCreated();

        $response->assertJson([
            'message'   =>  __('Your application successfully sent!')
        ]);

        $this->assertDatabaseCount('applications', 1);
    }
}
