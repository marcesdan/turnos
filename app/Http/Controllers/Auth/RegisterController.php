<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\AuthService;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
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
    use SendsPasswordResetEmails;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/usuario';
    /**
     * @var AuthService
     */
    protected $authService;


    public function __construct(AuthService $authService)
    {
        $this->middleware('auth');
        $this->authService = $authService;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('user.create');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\AuthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRequest $request)
    {
        $input = $request->validated();
        $user = $this->authService->register($input);
        event(new Registered($user));
        $this->sendResetLinkEmail($request);
        return redirect($this->redirectPath());
    }
}
