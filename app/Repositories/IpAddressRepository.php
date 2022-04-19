<?php

namespace App\Repositories;

use App\Models\IpAddress;

class IpAddressRepository extends BaseRepository
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->model = new IpAddress;
    }
}
