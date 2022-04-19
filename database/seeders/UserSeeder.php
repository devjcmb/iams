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
        // get ip addresses
        $ipAddresses = $this->getIpAddresses();

        // generate a user factory
        $user = $this->repo->getModel();

        return $user->factory()
            ->count(1)
            ->hasAttached($ipAddresses, ['label' => 'test'])
            ->create();
    }

    public function createTestUser()
    {
        $this->repo->create([
            'email' => 'test@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }

    public function getIpAddresses()
    {
        return $this->ipAddressRepo->index(null);
    }
}
