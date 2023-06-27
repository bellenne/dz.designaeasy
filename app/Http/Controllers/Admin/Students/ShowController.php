<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $students = User::get()->where("role_id", 1);
        return view("admin.students", compact("students"));
    }
}
