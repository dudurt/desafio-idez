<?php

namespace App\Repository;
use Illuminate\Support\Facades\Http;

class IbgeRepository
{
    private $url;

    public function __construct()
    {
        $this->url = getenv('IBGE_URL');
    }

    public function searchCityByState($stateAcronym)
    {
        return Http::get(
            "{$this->url}/localidades/estados/$stateAcronym/municipios"
        )->body();
    }

    public function searchAllStates()
    {
        return Http::get(
            "{$this->url}/localidades/estados"
        )->body();
    }
}
