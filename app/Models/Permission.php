<?php

namespace App\Models;

//use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    public function permissionRoles()
    {
        return $this->belongsToMany('App\Models\Permission')->using('App\Models\PermissionRole');
    }


}
