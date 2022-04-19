<?php

namespace App\Repositories;

use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressRepository extends BaseRepository
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->model = new IpAddress;
    }

    public function index(Request $request = null)
    {
        return is_null($request) 
            ? $this->model->all() 
            : $request->user()->ipAddresses()->get();
    }
}
