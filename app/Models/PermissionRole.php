<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
