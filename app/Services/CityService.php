<?php

namespace App\Services;

use App\Services\Dto\DataTransferObject;
use App\Models\City;
use Illuminate\Http\Request;

class CityService
{
    protected $dto;

    public function __construct()
    {
        $this->dto = new DataTransferObject();
    }

    public function list() {
        //env('PROVIDERS')

        $this->dto->setSuccess(true);
        $this->dto->setMessage("Teste dto certo");
        return $this->dto;
    }

}
