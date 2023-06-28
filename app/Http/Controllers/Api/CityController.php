<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CityService;
use App\Http\Requests\Api\City\ListCity;

class CityController
{
    protected $service;

    public function __construct()
    {
        $this->service = new CityService();
    }

    public function list(Request $request)
    {
        return $this->service->list($request)->getMessageDTO();
    }
}
