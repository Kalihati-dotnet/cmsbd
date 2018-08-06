<?php

return [

    'models' => [
        'user' => 'App\Models\User',
        'role' => 'App\Models\Role',
        'permission' => 'App\Models\Permission',
    ],

  
    'tables' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'role_user' => 'role_user',
        'permission_role' => 'permission_role',
        'permission_user' => 'permission_user',
    ],
    'foreign_keys' => [
        'user' => 'user_id',
        'role' => 'role_id',
        'permission' => 'permission_id'
    ],

];
