<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke()
    {
        $data = request()->all();
        $student = User::find($data["id"]);
        $student->update([
            $data["column"]=>$data["value"]
        ]);
        $students = User::get()->where("role_id", 1);
        return json_encode($students);
    }
}
