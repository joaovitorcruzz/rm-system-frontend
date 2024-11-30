<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NestApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('NEST_API_URL');
    }

    public function register(array $data)
    {
        return Http::post($this->baseUrl . '/auth/register', $data)->json();
    }

    public function login(array $data)
    {
        return Http::post($this->baseUrl . '/auth/login', $data)->json();
    }
}
