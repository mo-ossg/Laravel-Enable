<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Broker extends Authenticatable
{
    use HasFactory, HasRoles,Notifiable,HasApiTokens;

    public function getUserNameAttribute()
    {
        return $this->name;
    }

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username)
    {
        return $this->where('email', $username)->first(); // username هو الافتراضي بكون column email هيك انا قلتله الفحص بدو يتم على

        // ->first قبل ->orWhere('username', $username) مثلا بقله email or username لو عندي انو بقدر يسجل دخول باستخدام
    }

    //     /**
    //  * Validate the password of the user for the Passport password grant.
    //  */
    // public function validateForPassportPasswordGrant(string $password): bool
    // {
    //     return Hash::check($password, $this->password);
    // }
    // هادي منفذة افتراضيا بس لو بدي تخصيص بحطها
}
