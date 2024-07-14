<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\AuthInterface;

class AuthController extends Controller
{
    protected $authInterface;
    public function __construct(AuthInterface $authInterface){
        $this->authInterface = $authInterface;
    }

    public function login(LoginRequest $request){
        return $this->authInterface->login($request);
    }

    public function register(RegisterRequest $request){
        return $this->authInterface->register($request);
    }
}
