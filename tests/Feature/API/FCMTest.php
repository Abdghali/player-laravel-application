<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class FCMTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function update_user_fcm_token_after_login()
    {

        $this->actingAsSanctumUser();

        $response = $this->patchJson(route('fcm.update'), [
            'token'     => $token = Str::random(10)
        ]);


        $response->assertNoContent();

        $this->assertEquals($token, user()->token);
    }
}
