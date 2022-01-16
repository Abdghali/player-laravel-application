<?php

namespace Tests\Feature\API;

use App\Models\City;
use App\Models\Number;
use App\Models\PlayerType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function submit_phone_number_end_point()
    {
        $response = $this->postJson(route('numbers.store'), $data = [
            'content'   => '012544126'
        ]);

        $response->assertCreated();

        $response->assertJsonStructure([
            'data' => [
                'content'
            ]
        ]);

        $this->assertDatabaseHas('numbers', $data);
    }

    /** @test */
    public function submit_phone_number_end_point_validation_required()
    {
        $response = $this->postJson(route('numbers.store'));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors('content');
    }


    /** @test */
    public function submit_phone_number_end_point_validation_content_has_less_or_more_that_10()
    {
        // more than 10 digits
        $response = $this->postJson(route('numbers.store'), [
            'content'   => '01125441236'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors('content');


        // more less 10 digits
        $response = $this->postJson(route('numbers.store'), [
            'content'   => '12313'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors('content');
    }


    /**
     * The user registered before and uses his number.
     *  
     * @test
     */
    public function submit_phone_number_end_point_incase_the_number_exists_before()
    {

        // store number in database.
        $number = Number::factory()->create([
            'content'   => '995425475'
        ]);

        $response = $this->postJson(route('numbers.store'), [
            'content'   => $number->content
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'content'
            ]
        ]);
    }



    /** @test */
    public function verify_number_for_the_first_time()
    {

        $number = Number::factory()->create();

        $response = $this->patchJson(route('numbers.verify', $number), [
            'verification_code' => $number->verification_code,
            'device_name'       => 'ios'
        ]);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'is_new',
            'data' => [
                'number_id',
                'number'
            ]
        ]);
    }



    /** @test */
    public function verify_number_verification_code_for_existing_user()
    {

        $this->seed();

        $number = Number::factory()->create();

        User::factory()->create([
            'number'    => $number->content
        ]);

        $response = $this->patchJson(route('numbers.verify', $number), [
            'verification_code' => $number->verification_code,
            'device_name'       => 'ios'
        ]);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'data'  => [
                'id',
                'token',
                'email',
                'number',
                'player_type_id',
                'city_id',
            ]
        ]);
    }


    /** @test */
    public function verify_number_verification_code_validation()
    {

        $number = Number::factory()->create();

        $response = $this->patchJson(route('numbers.verify', $number), [
            'verification_code' => '000000',
            'device_name'       => 'ios'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors('verification_code');
    }


    /** @test */
    public function register_new_user()
    {

        $this->seed();

        $number = Number::factory()->create();


        $response = $this->patchJson(route('numbers.verify', $number), [
            'verification_code' => $number->verification_code,
            'device_name'       => 'ios'
        ]);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'is_new',
            'data' => [
                'number_id',
                'number'
            ]
        ]);

        $response = $this->postJson(route('user.register', $number), $data = [
            'name'              => $this->faker->name,
            'player_type_id'    => PlayerType::first()->id,
            'city_id'           => City::first()->id,
            'device_name'       => 'ios',
        ]);

        $response->assertJsonStructure([
            'data'  => [
                'id',
                'token',
                'number',
                'player_type_id',
                'city_id',
            ]
        ]);


        Arr::forget($data, ['image', 'device_name']);

        $this->assertDatabaseHas('users', $data);

        $this->assertNotNull(User::where('name', $data['name'])->first()->image());
    }
}
