<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $ecommerce;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->ecommerce = Ecommerce::query()->first();
    }

    public function showLoginForm()
    {
        session()->put('brand', $this->ecommerce->brand->name ?? null);
        session()->put('favicon', $this->ecommerce->favicon->name ?? null);
        session()->put('ecommerce_id', $this->ecommerce->id);
        return view('auth.login');
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        return $request->wantsJson()
            ? new Response('', 204)
            : redirect($this->redirectPath());
    }

}
