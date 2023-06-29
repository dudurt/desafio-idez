<?php

namespace App\Services;

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

        $this->dto->data = Cache::remember(
            $key,
            (new City())->expirationTime, 
            function() use ($stateAcronym) {
                return $this->mainProvider->searchCityByState($stateAcronym);
            }
        );

        $this->dto->setSuccess(true);
        $this->dto->setMessage("Teste dto certo");
        return $this->dto;
    }

}
