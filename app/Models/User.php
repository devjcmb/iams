<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * IP Addresses that belongs to the User
     */
    public function ipAddresses()
    {
        return $this->belongsToMany(IpAddress::class, 'user_ip_addresses', 'user_id', 'ip_address_id');
    }

    // /**
    //  * Check if User has and IP Address
    //  *
    //  * @param integer $ipAddressId
    //  * @return boolean
    //  */
    // public function hasIpAddress($ipAddressId)
    // {
    //     return $this->ipAddress()->where('id', $ipAddressId);
    // }

    // public function assignIpAddress($ipAddress)
    // {

    // }

    // public function 
}
