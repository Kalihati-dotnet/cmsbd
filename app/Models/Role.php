<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ManageUserTrait;

class Role extends Model
{
    use ManageUserTrait;

    protected $table = 'roles';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function manageUsers()
    {
    	return $this->hasManyThrough('App\Models\Manage', 'App\Models\RoleUser', 'role_id', 'id', 'id', 'user_id');
    }
}
