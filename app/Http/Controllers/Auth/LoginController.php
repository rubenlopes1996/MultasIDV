<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Mail;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Http\Controllers\EmailController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('getAuthUser', 'logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->firstLogin == 1) {
                $token = $user->createToken(rand())->accessToken;
                return response()->json(['user' => Auth::user()], 200)->header('Authorization', $token);
            } else {
                $users = \Adldap\Laravel\Facades\Adldap::search()->find($request->email);
                $user->type = $users->title[0];
                $user->course = $users->description[0];
                $user->school = $users->company[0];
                $user->number = $users->mailnickname[0];
                $user->departmentNumber = $users->departmentnumber[0];
                $user->firstLogin = 1;
                $user->save();
                $token = $user->createToken(rand())->accessToken;
                return response()->json(['user' => Auth::user()], 200)->header('Authorization', $token);
            }
        } else {
            auth()->logout();
            return response()->json(['message' => 'Credenciais inválidas. Por favor tente novamente.'], 401);
        }
    }

    public function getAuthUser()
    {
        return Auth::user();
    }
}
