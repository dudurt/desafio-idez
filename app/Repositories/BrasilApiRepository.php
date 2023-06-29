<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Dtos\GenericDto;

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
            return $this->dto->successMessage(
                'Requisição feita com sucesso!',
                Http::get(
                    "{$this->url}/ibge/municipios/v1/$stateAcronym"
                )
            );
        } catch (Exception $exception) {
            return $this->dto->errorMessage($exception->getMessage());
        }
    }

    public function searchAllStates()
    {
        try {
            return $this->dto->successMessage(
                'Requisição feita com sucesso!',
                Http::get(
                    "{$this->url}/ibge/uf/v1"
                )
            );
        } catch (Exception $exception) {
            return $this->dto->errorMessage($exception->getMessage());
        }
    }
}
