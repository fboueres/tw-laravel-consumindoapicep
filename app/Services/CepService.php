<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CepService
{
    private const API_URL = 'https://webmaniabr.com/api/1/cep';
    private const APP_KEY = 'DdR8TRXdBfdCzy2UWhl55frKvYto7kfM';
    private const APP_SECRET = 'oauSTdPT1ikmNp1DFH69GX0jMjEJgqz5QAudshjuawRoXlfZ';
    
    public function consultarCEP(string $cep)
    {
        $response = Http::get(CepService::API_URL . "/{$cep}/?app_key=" . CepService::APP_KEY . "&app_secret=" . CepService::APP_SECRET . "");

        return $response->json();
    }

    public function validarCEP(string $cep)
    {
        $response = Http::get(CepService::API_URL . "/{$cep}/?app_key=" . CepService::APP_KEY . "&app_secret=" . CepService::APP_SECRET . "");

        $endereco = $response->json();

        return !isset($endereco['error']);
    } 
}
