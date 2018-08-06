<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
        '_token',
        '_method',
    ];
    
    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true)) {
            return $value;
        }
        return is_string($value) ? trim_str($value) : $value;
    }
}
