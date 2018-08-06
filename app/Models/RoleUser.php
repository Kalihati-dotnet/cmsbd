<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
