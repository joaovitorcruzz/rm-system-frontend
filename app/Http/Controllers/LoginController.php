<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Services\NestApiService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

// class LoginController extends Controller
// {
//     public function login(Request $request)
//     {
//         dd("chegou no login fora auth");
//         $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);

//         // Enviar dados de login ao NestJS
//         $response = Http::post('http://localhost:3000/auth/login', [
//             'email' => $request->email,
//             'password' => $request->password,
//         ]);

//         if ($response->successful()) {
//             return response()->json($response->json());
//         }

//         return response()->json(['error' => 'Failed to login'], 401);
//     }
// }
