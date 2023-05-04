<?php

namespace App\Http\Controllers;

use App\Services\CepService;
use Illuminate\Http\Request;

class CepController extends Controller
{
    public function __invoke($cep, CepService $cepService)
    {
        return $cepService->consultarCEP($cep);
    }
}
