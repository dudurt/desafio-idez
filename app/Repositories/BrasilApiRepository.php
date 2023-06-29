<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Dtos\GenericDto;
use App\Dtos\CityDto;

class BrasilApiRepository
{
    private $url;
    protected $dto;

    public function __construct()
    {
        $this->url = getenv('BRASIL_API_URL');
        $this->dto = new GenericDto();
    }

    public function searchCityByState($stateAcronym)
    {
        try {
            $arrCity = Http::get(
                "{$this->url}/ibge/municipios/v1/$stateAcronym"
            )->json();

            $data = array();
            foreach($arrCity as $city) {
                array_push($data, (array) new CityDto($city['codigo_ibge'], $city['nome']));
            }

            $this->dto->successMessage(
                'Requisição feita com sucesso!',
                $data
            );

            return $this->dto;
        } catch (Exception $exception) {
            $this->dto->errorMessage($exception->getMessage());
            return $this->dto;
        }
    }

    public function searchAllStates()
    {
        try {
            $this->dto->successMessage(
                'Requisição feita com sucesso!',
                Http::get(
                    "{$this->url}/ibge/uf/v1"
                )->json()
            );
            return $this->dto;
        } catch (Exception $exception) {
            $this->dto->errorMessage($exception->getMessage());
            return $this->dto;
        }
    }
}
