<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Manage\ManageController;


class ManageBoardController extends ManageController
{
    public function dashboard(Request $request)
    {
        return view('manage.dashboard');
    }
}
