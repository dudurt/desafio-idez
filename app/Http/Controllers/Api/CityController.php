<?php

namespace App\Http\Controllers\Api;

use App\Services\CityService;
use Illuminate\Http\Request;
use App\Dtos\GenericDto;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\StateRepository;

class CityController
{
    protected $service;

    public function __construct()
    {
        $this->service = new CityService();
        $this->dto = new GenericDto();
        $this->stateArr = (new StateRepository())->stateArr;
    }

    public function index()
    {
        $stateAcronym = '';
        $stateArr = $this->stateArr;
        return view('citiesForm', compact('stateAcronym', 'stateArr'));
    }

    public function listByState($stateAcronym)
    {
        if (!isset($stateAcronym) && empty($stateAcronym)) {
            return $this->dto->errorMessage('Favor informar a UF do estado desejado após o list/ .')->getMessageDTO();
        }
        return $this->service->listByState($stateAcronym)->getMessageDTO();
    }

    public function listCities(Request $request)
    {
        $stateAcronym = $request->input('stateAcronym');
        if (!isset($stateAcronym) && empty($stateAcronym)) {
            return $this->dto->errorMessage('Favor informar a UF do estado desejado após o list/ .')->getMessageDTO();
        }

        $serviceResponse = $this->service->listByState($stateAcronym);
        if (!$serviceResponse->getSuccess()) {
            return $serviceResponse->getMessageDto();
        }

        $stateArr = $this->stateArr;
        $citiesArr = $this->paginate($serviceResponse->getData(), $stateAcronym, 15);
        return view('citiesForm', compact('citiesArr', 'stateAcronym', 'stateArr'));
    }

    private function paginate($serviceData, $stateAcronym, $perPage = 15, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $serviceData = $serviceData instanceof Collection ? $serviceData : Collection::make($serviceData);
        return new LengthAwarePaginator(
            $serviceData->forPage($page, $perPage),
            $serviceData->count(),
            $perPage,
            $page,
            ['path' => url("/buscaibgeEstado?stateAcronym=$stateAcronym")
        ]);
    }
}
