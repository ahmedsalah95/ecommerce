<?php

namespace App\Repositories\Interfaces;

interface AuthInterface
{
    public function Login($request);
    public function register($request);
}
