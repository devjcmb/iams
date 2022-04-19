<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IpAddressRepository;

class IpAddressController extends BaseController
{
    protected $repo;
    protected $logData;

    public function __construct(IpAddressRepository $ipAddressRepo) {
        $this->repo = $ipAddressRepo;
        $this->logData = [
            'controller' => 'IpAddressController',
            'method' => null
        ];
    }

}
