<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Config;


trait ManageUserTrait{

    public function roles()
    {
        return $this->belongsToMany(
            Config::get('manage.models.role'),
            Config::get('manage.tables.role_user'),
            Config::get('manage.foreign_keys.user'),
            Config::get('manage.foreign_keys.role')
        );
    }

    public function perms()
    {
        return $this->belongsToMany(
            Config::get('manage.models.permission'),
            Config::get('manage.tables.permission_role'),
            Config::get('manage.foreign_keys.role'),
            Config::get('manage.foreign_keys.permission')
        );
    }


    public function hasRole($name)
    {
        $name = $this->standardValue($name);
        if(is_array($name)){
            return null !== $this->roles()->whereIn('name', $name)->first();
        }
        return null !== $this->roles()->where('name', $name)->first();
    }

    public function hasPermission($key)
    {
        return null !== $this->perms()->where('key', $key)->first();
    }

    // public function hasPerm($key)
    // {
    //     return null !== $this->perms()->where('key', $key)->first();
    // }

    // public function hasAnyPerm($keys)
    // {
    //     return null !== $this->perms()->whereIn('key', $keys)->first();
    // }
    
    public function checkAbility($keys)
    {
        if(is_array($keys)){
            //$keys = explode(self::DELIMITER, $keys);
            return null !== $this->perms()->whereIn('key', $keys)->first();
        }
        return null !== $this->perms()->where('key', $key)->first();
    }

    /**
     * Checks if the string passed contains a pipe '|' and explodes the string to an array.
     * @param  string|array  $value
     * @return string|array
     */
    private function standardValue($value)
    {
        if (is_array($value) || strpos($value, '|') === false) {
            return $value;
        }
        return explode('|', $value);
    }
}