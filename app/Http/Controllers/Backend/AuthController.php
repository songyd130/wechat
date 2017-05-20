<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\AdminUser;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/backend';
    protected $guard = 'backend';
    protected $loginView = 'backend.auth.login';
    protected $registerView = 'backend.auth.register';

    public function __construct()
    {
        $this->middleware('guest:backend', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function create(array $data)
    {
        return AdminUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

}
