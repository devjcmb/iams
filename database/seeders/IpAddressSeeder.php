<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Repositories\IpAddressRepository;
use App\Repositories\UserRepository;

class IpAddressSeeder extends Seeder
{
    protected $repo;
    protected $userRepo;

    public function __construct(IpAddressRepository $ipAddressRepo, UserRepository $userRepo)
    {
        $this->repo = $ipAddressRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ipAddresses = $this->createIpAddresses();

        $users = $this->userRepo->index();

        foreach($users as $user) {
            $user->ipAddresses()->sync($ipAddresses);
        }
    }

    public function createIpAddresses() 
    {
        $ipAddress = $this->repo->getModel();

        return $ipAddress->factory()->count(5)->create();
    }
}
