<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CountyService;
use App\Http\Requests\Api\County\ListCounty;

class CountyController
{
    protected $service;

    public function __construct()
    {
        $this->service = new CountyService();
    }

    public function list(Request $request)
    {
        return $this->service->list($request)->getMessageDTO();
    }
}
