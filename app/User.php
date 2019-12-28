<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const ROLE = [
        'role_admin' => 'Admin',
        'role_user' => 'Użytkownik'
    ];

    public function firstName()
    {
        return explode(' ', $this->name)[0];
    }

    public function hasAdminAccess() {
        return $this->role === 'role_admin';
    }

    public function getRole() {
        return self::ROLE[$this->role];
    }
}
