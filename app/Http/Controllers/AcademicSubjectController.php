<?php

namespace App\Http\Controllers;

use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class AcademicSubjectController extends Controller
{
    public static function getAcademicSubjects()
    {
        $academic_subjects = AcademicSubject::all();
//        dd($index);
        return $academic_subjects;
    }
}
