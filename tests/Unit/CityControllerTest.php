<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    /** @test */
    public function testReturnOfCityByUf(): void
    {
        Http::fake(
            [
                '*/api/ibge/municipios/v1/SP' 
                => Http::response(
                    [
                        [ "codigo_ibge" => "3526902", "nome" => "LIMEIRA" ],
                        [ "codigo_ibge" => "3509502", "nome" => "CAMPINAS" ],
                        [ "codigo_ibge" => "3533403", "nome" => "NOVA ODESSA" ],
                        [ "codigo_ibge" => "3501004", "nome" => "ALTINÓPOLIS" ]
                    ],
                    200
                ),
            ]
        );

        $response = $this->get('/api/city/list/SP');

        $response->assertStatus(201)
            ->assertJsonFragment([ "ibge_code" => "3526902", "name" => "LIMEIRA" ])
            ->assertJsonFragment([ "ibge_code" => "3509502", "name" => "CAMPINAS" ])
            ->assertJsonFragment([ "ibge_code" => "3533403", "name" => "NOVA ODESSA" ])
            ->assertJsonFragment([ "ibge_code" => "3501004", "name" => "ALTINÓPOLIS" ]);
    }
}
