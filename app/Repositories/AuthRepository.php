<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\AuthInterface;
use App\Traits\ApiResponse;

class AuthRepository implements AuthInterface{
    use ApiResponse;
    public function login($request)
    {

        if(auth()->attempt($request->all())){
            $user_login_token= auth()->user()->createToken('authToken')->accessToken;
            return $this->success([
                    'token'=>$user_login_token
                ],'Logged in successfully!');
        }
        return $this->error('Provided credentials does not match any on our records',403);
    }

    public function register($request)
    {
        $user = User::create($request->all());
        $user->addRole('User');
        $access_token = $user->createToken('authToken')->accessToken;
        return $this->success(
            ['token'=>$access_token],
            'User Registered successfully!'
        );
    }
}
