<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_users';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;



    // public function roles()
    // {
    // 	return $this->belongsToMany('App\Models\Role');
    // } 
}
