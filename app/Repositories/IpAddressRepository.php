<?php

namespace App\Repositories;

use App\Models\IpAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    /**
     * Create an IP Address and assign it to the 
     * authenticated user
     *
     * @param App\Http\Requests\IpAddress\CreateRequest $request
     */
    public function storeIpAddress($request)
    {
        // get authenticated user
        $user = $request->user();

        // get all ip addresses from this user
        $ipAddresses = $user->ipAddresses();

        // check if IP Address already exists
        $ipAddress = $this->findBy('name', $request['name'])->first();

        // create an IP Address if it doesn't exist
        if (is_null($ipAddress)) {
            $ipAddress = $this->create($request->all());
        }

        // check if this IP is already assigned to the user, if not, add a label
        $exists = $ipAddresses->where('ip_address_id', $ipAddress->id)->first();

        if (is_null($exists)) {
            $ipAddresses->attach($ipAddress->id, ['label' => $request['label']]);
        } else {
            $ipAddress = $this->updateIpAddress($exists->id, $request);
        }

        return $ipAddress;
    }

    /**
     * Update the IP Address label
     *
     * @param App\Http\Requests\IpAddress\UpdateRequest $request
     * @param integer $id
     */
    public function updateIpAddress($id, $request)
    {
        // get authenticated user
        $user = $request->user();

        // update only the label
        $user->ipAddresses()->updateExistingPivot($id, ['label' => $request['label']]);

        return $this->find($id);
    }

}
