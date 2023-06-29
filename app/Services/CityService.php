<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use Cache;
use App\Dtos\GenericDto;
use App\Models\City;
use App\Repositories\BrasilApiRepository;
use App\Repositories\IbgeApiRepository;

class CityService
{
    protected $dto;
    private $mainProvider;

    public function __construct()
    {
        $this->dto = new GenericDto();
        $this->mainProvider = env('MAIN_API_PROVIDER') === 'IbgeApi' ? new IbgeApiRepository() : new BrasilApiRepository();
    }

    public function listByState($stateAcronym) {
        $key = "ListByState$stateAcronym";
        $lastReq = Cache::get($key);

        Cache::remember(
            $key,
            (new City())->expirationTime, 
            function() use ($stateAcronym) {
                return $this->mainProvider->searchCityByState($stateAcronym)->getData();
            }
        );

        $newRetData = Cache::get($key);
        if ($newRetData !== null) {
            $this->dto->successMessage('Municípios encontrados com sucesso!', $newRetData);
        } else {
            $this->dto->errorMessage('Não foi possível consultar os municípios!');
        }
        return $this->dto;
    }

}
