<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Http\Traits\ManageUserTrait;

use Auth;

//use Illuminate\Support\Collection;
class Manage extends Authenticatable
{
    use Notifiable;

    use ManageUserTrait;

    protected $guard = 'manage';
    
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
