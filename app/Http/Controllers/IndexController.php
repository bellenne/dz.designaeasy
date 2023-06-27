<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $academic_subjects = AcademicSubjectController::getAcademicSubjects();
        $user = auth()->user();
        return view("index", compact("academic_subjects"));

    }
}
