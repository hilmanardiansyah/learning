<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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
    public function __construct()
    {
        // $this->adminGuard = Auth::guard('admin');
        // $this->mahasiswaGuard = Auth::guard('mahasiswa');
        // $this->dosenGuard = Auth::guard('dosen');
        $this->middleware('guest:admin,mahasiswa,dosen')->except('logout');
    }

      /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */

    public function showLoginForm()
    {
        return view('auth.login');
    }

      /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if(
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if(Auth::guard('admin')->attempt($request->only('email','password'), $request->filled('remember'))){
            return redirect()->intended(route('dashboard.admin'));
        }elseif (Auth::guard('mahasiswa')->attempt($request->only('email','password'), $request->filled('remember'))) {
            return redirect()->intended(route('dashboard.mahasiswa'));
        }elseif(Auth::guard('dosen')->attempt($request->only('email','password'), $request->filled('remember'))){
            return redirect()->intended(route('dashboard.dosen'));
        }

        $this->incrementLoginAttemps($request);
        session()->flash('error', 'Email atau Password Salah, Silahkan cek kembali. ');
        return $this->sendFailedLoginResponse($request);
    }
     /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
    }
}
