<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke()
    {
        $data = request()->all();

        $academicSubject = AcademicSubject::find($data["course_id"]);
        $academicSubject->update([
            $data["column"]=>$data["value"]
        ]);
        $academicSubjects = AcademicSubject::all();
        return json_encode($academicSubjects);
    }
}
