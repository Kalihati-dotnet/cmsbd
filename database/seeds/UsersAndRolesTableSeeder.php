<?php

use Illuminate\Database\Seeder;

class UsersAndRolesTableSeeder extends Seeder
{

    protected $perms_type = ['browse', 'read', 'add', 'edit', 'delete'];
    protected $perms_table = [
        'users',
        'roles',
        'permissions',
        'posts',
        'categories',
        'menus',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [ 
              'id' => 1,
              'username' => 'super',
              'email' => 'super@cmsbd.net',
              'password' => bcrypt('sa236284'),
              'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
              'display_name' => 'Super Admin',
              'is_activated' => true,
              'created_at' => now()
            ],
            [ 
              'id' => 2,
              'username' => 'admin',
              'email' => 'admin@cmsbd.net',
              'password' => bcrypt('a236284'),
              'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
              'display_name' => 'Administrator',
              'is_activated' => true,
              'created_at' => now()
            ],
            [ 
              'id' => 3,
              'username' => 'editor',
              'email' => 'editor@cmsbd.net',
              'password' => bcrypt('e236284'),
              'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
              'display_name' => 'Editor',
              'is_activated' => true,
              'created_at' => now()
            ],
            [ 
              'id' => 4,
              'username' => 'contributor',
              'email' => 'contributor@cmsbd.net',
              'password' => bcrypt('c236284'),
              'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
              'display_name' => 'Contributor',
              'is_activated' => true,
              'created_at' => now()
            ],
            [
              'id' => 5,
              'username' => 'user',
              'email' => 'user@cmsbd.net',
              'password' => bcrypt('236284'),
              'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
              'display_name' => 'Normal User',
              'is_activated' => true,
              'created_at' => now()
            ],
        ]);
        DB::table('roles')->insert([
            [
              'id' => 1,
              'name' => 'super',
              'display_name' => 'Super Admin',
              'created_at' => now()
            ],
            [
              'id' => 2,
              'name' => 'admin',
              'display_name' => 'Admin',
              'created_at' => now()
            ],
            [ 
              'id' => 3,
              'name' => 'editor',
              'display_name' => 'Editor',
              'created_at' => now()
            ],
            [
              'id' => 4,
              'name' => 'contributor',
              'display_name' => 'Contributor',
              'created_at' => now()
            ]
        ]);
        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ],
            [ 
                'role_id' => 2,
                'user_id' => 2
            ],
            [ 
                'role_id' => 3,
                'user_id' => 3
            ],
            [
                'role_id' => 4,
                'user_id' => 4
            ]
        ]);


        $arr = [];
        foreach($this->perms_table as $tbl){
            foreach($this->perms_type as $prm){
                // $arr[]= array([
              $perms = \App\Models\Permission::create([
                    "key"=> $prm . '_' . $tbl,
                    "table_name"=> $tbl
                ]);
                \App\Models\PermissionRole::create([
                    'permission_id' => $perms->id,
                    'role_id' => 1
                ]);

            }
        }
    }
}
