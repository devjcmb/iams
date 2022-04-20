<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpAddress\CreateRequest;
use App\Repositories\IpAddressRepository;
use Throwable;

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

    /**
     * Create an IP Address
     *
     * @param \App\Http\Requests\IpAddress\CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        try {
            $result = $this->repo->storeIpAddress($request);

            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Created successfully'
            );
        } catch (Throwable $e) {
            $this->logData['method'] = 'index';

            return $this->sendError(
                $e, 
                __('Failed to create data'),
                $this->logData
            );
        }  
    }
}
