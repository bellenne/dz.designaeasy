<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        User::destroy($id["id"]);
        $students = User::get()->where("role_id", 1);
        return json_encode($students);
    }
}
