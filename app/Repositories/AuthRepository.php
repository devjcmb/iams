<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepository
{

    /**
     * The user repository
     *
     * @var App/Repositories/UserRepository;
     */
    protected $userRepo;

    /**
     * Initialize the class
     * 
     * @param UserRepository $userRepo the user repo
     */
    public function __construct(
        UserRepository $userRepo
    ) {
        $this->model = new User;
        $this->userRepo = $userRepo;
    }

    /**
     * Get the current user
     * The $id parameter will override this function
     * 
     * @param integer $id the user's unique id
     * 
     * @return void
     */
    public function getCurrentUser($id = null) 
    {
        return is_null($id) 
            ? Auth::user()
            : $this->userRepo->find($id);
    }

    /**
     * Registers a user
     *
     * @param array $data user's data
     * 
     * @return void
     */
    public function register($data) 
    {
        DB::beginTransaction();

        try {
            $user = null;

            // hash the password
            $data['password'] = Hash::make($data['password']);

            // create a user
            $user = $this->userRepo->create($data);

            // create token
            $token = $this->userRepo->createToken($user->id);

            DB::commit();

            return [
                'token' => $token,
                'user' => $user
            ];
    
        } catch (\Throwable $e) {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * Reserved function
     *
     * @return void
     */
    public function login() 
    {

    }

    /**
     * Reserved function
     *
     * @return void
     */
    public function logout() 
    {

    }

}
