<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class ExternalApiController extends Controller
{
    public function __invoke(): Factory | View | Application
    {
        $url = 'https://jsonplaceholder.typicode.com/users';

        $response = Http::get($url);
        $data     = $response->json();

        return view('external-api', compact('url','data'));
    }
}
