<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Dtos\GenericDto;
use App\Dtos\CityDto;

class IbgeApiRepository
{
    private $url;
    protected $dto;

    public function __construct()
    {
        $this->url = getenv('IBGE_API_URL');
        $this->dto = new GenericDto();
    }

    public function searchCityByState($stateAcronym)
    {
        try {
            $arrCity = Http::get(
                "{$this->url}/localidades/estados/$stateAcronym/municipios"
            )->json();

            $data = array();
            foreach($arrCity as $city) {
                array_push($data, (array) new CityDto($city['id'], $city['nome']));
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
                    "{$this->url}/localidades/estados"
                )->json()
            );
            return $this->dto;
        } catch (Exception $exception) {
            $this->dto->errorMessage($exception->getMessage());
            return $this->dto;
        }
    }
}
