<?php

namespace App\Http\Controllers\Lessens;

use App\Http\Controllers\AcademicSubjectController;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;

class LessenManagerController extends Controller
{
    public function __invoke($link)
    {
        $academic_subjects = AcademicSubjectController::getAcademicSubjects();
        $academicSubjectId = AcademicSubject::find(1)->where('url_address',$link)->value('id');
        $lessens = Lessen::all()->where('academicSubject_id', $academicSubjectId);
        return view("lessen.show", compact("lessens", 'academic_subjects'));
    }
}
