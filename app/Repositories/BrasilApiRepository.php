<?php

namespace App\Repository;
use Illuminate\Support\Facades\Http;

class BrasilApiRepository
{
    private $url;

    public function __construct()
    {;
        $this->url = getenv('BRASIL_API_URL');
    }

    public function searchCityByState($stateAcronym)
    {
        return Http::get(
            "{$this->url}/ibge/municipios/v1/$stateAcronym"
        )->body();
    }

    public function searchAllStates()
    {
        return Http::get(
            "{$this->url}/ibge/uf/v1"
        )->body();
    }
}
