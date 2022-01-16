<?php

namespace Tests\Feature\API;

use App\Models\RestoreFee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function loggin_user_could_send_moeny_back_request()
    {
        $this->seed();

        $this->actingAsSanctumUser();

        $response = $this->postJson(route('money-back.store'));

        $response->assertCreated();

        $response->assertJson([
            'message'   =>__('Your money back request successfully sent!')
        ]);

        $this->assertDatabaseHas('restore_fees', ['user_id' => user()->id]);
    }

    /** @test */
    public function show_if_the_user_sent_money_back_request()
    {
        $this->seed();

        $this->actingAsSanctumUser();


        user()->restoreFee()->create();

        $response = $this->getJson(route('money-back.show'));

        $response->assertJsonStructure([
            'has_money_request' 
        ]);
    }
}
