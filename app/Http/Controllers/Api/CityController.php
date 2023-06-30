<?php

namespace App\Http\Controllers\Api;

use App\Services\CityService;
use Illuminate\Http\Request;
use App\Dtos\GenericDto;

class CityController
{
    protected $service;

    public function __construct()
    {
        $this->service = new CityService();
        $this->dto = new GenericDto();
    }

    public function listByState($stateAcronym)
    {
        if (!isset($stateAcronym) && empty($stateAcronym)) {
            return $this->dto->errorMessage('Favor informar a UF do estado desejado após o list/ .')->getMessageDTO();
        }
        return $this->service->listByState($stateAcronym)->getMessageDTO();
    }
}
