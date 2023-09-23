<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Broker extends Authenticatable
{
    use HasFactory, HasRoles;

    public function getUserNameAttribute()
    {
        return $this->name;
    }

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username): User
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
