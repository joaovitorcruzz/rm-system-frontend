<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\ValidationException;

// class LoginController extends Controller
// {
//     /**
//      * Cria uma nova instância do controlador.
//      * Garante que apenas visitantes possam acessar as rotas do controlador.
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }

//     /**
//      * Exibe o formulário de login.
//      *
//      * @return \Illuminate\View\View
//      */
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     /**
//      * Lida com a autenticação do usuário.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function login(Request $request)
//     {
//         $this->validateLogin($request);

//         if ($this->attemptLogin($request)) {
//             return $this->sendLoginResponse($request);
//         }

//         return $this->sendFailedLoginResponse($request);
//     }

//     /**
//      * Valida os dados enviados no formulário de login.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return void
//      */
//     protected function validateLogin(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|string',
//         ]);
//     }

//     /**
//      * Tenta autenticar o usuário.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return bool
//      */
//     protected function attemptLogin(Request $request)
//     {
//         return Auth::attempt(
//             $this->credentials($request),
//             $request->filled('remember')
//         );
//     }

//     /**
//      * Obtém as credenciais do formulário.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return array
//      */
//     protected function credentials(Request $request)
//     {
//         return $request->only('email', 'password');
//     }

//     /**
//      * Responde ao login bem-sucedido.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     protected function sendLoginResponse(Request $request)
//     {
//         $request->session()->regenerate();

//         return redirect()->intended($this->redirectPath());
//     }

//     /**
//      * Responde ao login falho.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     protected function sendFailedLoginResponse(Request $request)
//     {
//         throw ValidationException::withMessages([
//             'email' => [trans('auth.failed')],
//         ]);
//     }

//     /**
//      * Faz logout do usuário autenticado.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\RedirectResponse
//      */
//     public function logout(Request $request)
//     {
//         Auth::logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect('/home');
//     }

//     /**
//      * Define o caminho de redirecionamento após login.
//      *
//      * @return string
//      */
//     protected function redirectPath()
//     {
//         return '/home'; // Mude para onde deseja redirecionar após login.
//     }
// }


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $response = $this->attemptLoginWithNest($request);

        if ($response->successful() && $response->json('user')) {
            $user = $response->json('user');

            Auth::loginUsingId($user['id']);

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLoginWithNest(Request $request)
    {
        return Http::post('http://localhost:3000/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }

    protected function redirectPath()
    {
        return '/home';
    }
}
