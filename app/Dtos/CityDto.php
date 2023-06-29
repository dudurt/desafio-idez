<?php

namespace App\Dtos;

class CityDto
{
    public $ibge_code;
    public $name;

    public function __construct($ibge_code, $name)
    {
        $this->ibge_code = $ibge_code;
        $this->name = $name;
    }
}
