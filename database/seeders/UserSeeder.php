<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Repositories\IpAddressRepository;
use Carbon\Carbon;
use App\Repositories\UserRepository;

class UserSeeder extends Seeder
{
    protected $repo;
    protected $ipAddressRepo;

    public function __construct(
        UserRepository $userRepo,
        IpAddressRepository $ipAddressRepo
    ) {
        $this->repo = $userRepo;
        $this->ipAddressRepo = $ipAddressRepo;

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $user = $this->repo->getModel();

        $ipAddresses = $this->getIpAddresses();
        return $user->factory()
            ->count(1)
            ->hasAttached($ipAddresses, ['label' => 'test'])
            ->create();
    }

    public function getIpAddresses()
    {
        return $this->ipAddressRepo->index(null);
    }
}
