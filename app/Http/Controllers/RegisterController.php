<?php

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Services\NestApiService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Validator;

// class RegisterController extends Controller
// {
//     protected function validator(array $data)
//     {
//         dd("chegou no register fora auth");
//         return Validator::make($data, [
//             'username' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }

//     public function register(Request $request)
//     {
//         // Validação local
//         $validator = $this->validator($request->all());

//         if ($validator->fails()) {
//             return response()->json(['errors' => $validator->errors()], 422);
//         }

//         // Dados validados, enviar ao backend NestJS
//         $response = Http::post('http://localhost:3000/auth/register', [
//             'username' => $request->username,
//             'email' => $request->email,
//             'password' => $request->password,
//         ]);

//         if ($response->successful()) {
//             return response()->json($response->json());
//         }

//         return response()->json(['error' => 'Failed to register'], 500);
//     }
// }
