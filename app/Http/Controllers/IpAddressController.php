<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpAddress\CreateRequest;
use App\Http\Requests\IpAddress\UpdateRequest;
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
            $this->logData['method'] = 'create';

            return $this->sendError(
                $e, 
                __('Failed to create data'),
                $this->logData
            );
        }  
    }

    /**
     * Update an IP Address
     *
     * @param integer $id
     * @param \App\Http\Requests\IpAddress\UpdateRequest $request
     */
    public function update($id, UpdateRequest $request)
    {
        try {
            $result = $this->repo->updateIpAddress($id, $request);

            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Updated successfully'
            );
        } catch (Throwable $e) {
            $this->logData['method'] = 'update';

            return $this->sendError(
                $e, 
                __('Failed to create data'),
                $this->logData
            );
        }  
    }

    /**
     * Find an IP Address
     *
     * @param integer $id
     */
    public function find($id) {
        try {
            $result = $this->repo->find($id);

            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Item found'
            );
        } catch (Throwable $e) {

            $this->logData['method'] = 'find';

            return $this->sendError(
                $e, 
                __('Failed to find data'),
                $this->logData
            );
        }  
    }
}
