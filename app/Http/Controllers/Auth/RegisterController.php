<?php

namespace App\Http\Controllers\Auth;

use App\Job;
use App\Stat;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

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
     * @return \App\User
     */
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'finish_job' => Carbon::now()->subMinutes(1),
    ]);
    $user->stats()->attach(1);
    $user->stats()->attach(2);
    $user->stats()->attach(3);
    $user->stats()->attach(4);
    $user->stats()->attach(5);
    $user->stats()->attach(6);
    $user->stats()->attach(10);
    $user->stats()->attach(11);
    $user->stats()->updateExistingPivot(1, ['value'=>1]);
    $user->stats()->updateExistingPivot(2, ['value'=>1]);
    $user->stats()->updateExistingPivot(3, ['value'=>1]);
    $user->stats()->updateExistingPivot(4, ['value'=>100]);
    $user->stats()->updateExistingPivot(5, ['value'=>0]);
    $user->stats()->updateExistingPivot(6, ['value'=>0]);
    $user->stats()->updateExistingPivot(10, ['value'=>0]);
    $user->stats()->updateExistingPivot(11, ['value'=>1]);
    return $user;
}
}
