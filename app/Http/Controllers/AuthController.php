<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\AuthRepository;
use Throwable;

class AuthController extends BaseController
{
    protected $repo;
    protected $logData;

    public function __construct(AuthRepository $authRepo) {
        $this->repo = $authRepo;
        $this->logData = [
            'controller' => 'AuthController',
            'method' => null
        ];
    }

    public function register(RegisterRequest $request) {
        try {
            $result = $this->repo->register($request->all());

            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Registration successful'
            );
        } catch (Throwable $e) {
            $this->logData['method'] = 'register';

            return $this->sendError(
                $e, 
                __('Registration failed'),
                $this->logData
            );
        }   
    }

    public function login(LoginRequest $request) {
        try {
            $result = $this->repo->login($request->all());
            
            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Login successful'
            );
        } catch (Throwable $e) {
            $this->logData['method'] = 'login';

            return $this->sendError(
                $e, 
                __('Login failed'),
                $this->logData
            );
        }   
    }

    public function logout() {

    }
}
