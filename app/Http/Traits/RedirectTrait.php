<?php

namespace App\Http\Traits;
trait RedirectTrait{

    public function redTo(){
        if(redirect()->getUrlGenerator()->current() !== redirect()->getUrlGenerator()->previous()){
           return redirect()->getUrlGenerator()->previous();
        }
        return '/home';
    }
}