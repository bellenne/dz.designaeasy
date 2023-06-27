<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke()
    {
        $academicSubjects = AcademicSubject::get();
        return view("admin.course", compact("academicSubjects"));
    }
}
