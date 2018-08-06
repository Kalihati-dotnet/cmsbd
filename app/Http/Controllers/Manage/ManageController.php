<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class ManageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        \View::composer(['*'], function() {
            view()->share([
                'manageMenus' => \App\Models\Menu::where('parent_id', '=', null)->get(),
                'manageCategories' => \App\Models\Category::where('parent_id', '=', null)->get(),
                'manageTags' => \App\Models\Tag::get()->pluck('name', 'id')->toArray()
            ]);
        });
    }
}