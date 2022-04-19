<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->model = new User;
    }

    public function createToken($id) {
        $user = $this->find($id);

        // create token
        $accessToken = $user->createToken(config('app.key'))->accessToken;

        return $accessToken;
    }
}
