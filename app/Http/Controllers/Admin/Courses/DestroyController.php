<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        AcademicSubject::destroy($id["course_id"]);
        $academicSubjects = AcademicSubject::get();
        return json_encode($academicSubjects);
    }
}
