<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use GuzzleHttp\Client;

// class AuthController extends Controller
// {
//     public function register(Request $request)
//     {
//         $client = new Client();
//         dd("Chegou no authcontroller");
//         $response = $client->post('http://localhost:3000/auth/register', [
//             'form_params' => [
//                 'username' => $request->username,
//                 'email' => $request->email,
//                 'password' => $request->password,
//             ]
//         ]);

//         return json_decode($response->getBody()->getContents());
//     }

//     public function login(Request $request)
//     {
//         $client = new Client();

//         $response = $client->post('http://localhost:3000/auth/login', [
//             'form_params' => [
//                 'username' => $request->username,
//                 'password' => $request->password,
//             ]
//         ]);

//         return json_decode($response->getBody()->getContents());
//     }
// }
