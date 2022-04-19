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

    public function findBy($field, $value)
    {
        return $this->model->where($field, $value);
    }

    public function createToken($id) {
        $user = $this->find($id);

        // create token
        $accessToken = $user->createToken('access-token')->accessToken;

        return $accessToken;
    }
}
