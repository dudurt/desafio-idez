<?php

namespace App\Http\Controllers\Api;

use App\Services\CityService;
use App\Http\Requests\Api\City\ListCityByState;

class CityController
{
    protected $service;

    public function __construct()
    {
        $this->service = new CityService();
    }

    public function listByState(ListCityByState $request)
    {
        return $this->service->listByState($request->siglaUf)->getMessageDTO();
    }
}
