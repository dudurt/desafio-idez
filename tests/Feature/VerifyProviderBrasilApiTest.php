<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerifyProviderBrasilApiTest extends TestCase
{
    /** @test */
    public function VerifyProviderBrasilApiTest(): void
    {
        putenv('MAIN_API_PROVIDER=BrasilApi');
        $this->get('/api/city/list/SP')
            ->assertStatus(201)
            ->assertJsonCount(4)
            ->assertJsonFragment([ "ibge_code" => "3526902", "name" => "LIMEIRA" ])
            ->assertJsonFragment([ "ibge_code" => "3509502", "name" => "CAMPINAS" ])
            ->assertJsonFragment([ "ibge_code" => "3533403", "name" => "NOVA ODESSA" ])
            ->assertJsonFragment([ "ibge_code" => "3501004", "name" => "ALTINÓPOLIS" ]);
    }
}
