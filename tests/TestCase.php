<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function postJson($uri, array $data = [], array $headers = [])
    {
        return parent::postJson($uri, $data, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function getJson($uri, array $headers = [])
    {
        return parent::getJson($uri, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function putJson($uri, array $data = [], array $headers = [])
    {
        return parent::putJson($uri, $data, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function patchJson($uri, array $data = [], array $headers = [])
    {
        return parent::patchJson($uri, $data, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function deleteJson($uri, array $data = [], array $headers = [])
    {
        return parent::deleteJson($uri, $data, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function optionsJson($uri, array $data = [], array $headers = [])
    {
        return parent::optionsJson($uri, $data, Arr::add($headers, 'x-api-key', env('APP_API_KEY')));
    }

    public function actingAsSanctumUser()
    {
        return Sanctum::actingAs(User::factory()->create());    
    }
}
