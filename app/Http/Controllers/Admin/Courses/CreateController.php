<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        unset($id["_token"]);
        AcademicSubject::create($id);
        $academicSubjects = AcademicSubject::get();
        return json_encode($academicSubjects);
    }
}
