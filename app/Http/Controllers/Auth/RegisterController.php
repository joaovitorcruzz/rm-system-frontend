<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Symfony\Component\Clock\now;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],

        ];

        $client = new Client();

        try {
            $response = $client->post('http://localhost:3000/auth/register', [
                'json' => $payload,
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            $user = new User([
                'name' => $responseData['name'],
                'email' => $responseData['email'],
                // Como a senha geralmente não é retornada, configure algo genérico ou deixe vazio
                // 'password' => Hash::make($data['password']),

            ]);

            return $user;
        } catch (\Exception $e) {
            // Trate o erro adequadamente
            dd('Erro ao registrar usuário:', $e->getMessage());
        }
    }

    /**
     * Substitui o comportamento padrão de registro.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Valida os dados do formulário
        $this->validator($request->all())->validate();

        // Cria o usuário, mas não autentica
        $this->create($request->all());

        // Redireciona para a página de login com uma mensagem de sucesso
        return redirect($this->redirectTo)->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }
}
