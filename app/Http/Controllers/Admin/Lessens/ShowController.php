<?php

namespace App\Http\Controllers\Admin\Lessens;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function __invoke()
    {
//        $lessens = DB::table('academic_subjects')->join('lessens','academic_subjects.id','=','lessens.academicSubject_id')->get();
        $lessens = Lessen::get();
        $academicSubjects = AcademicSubject::get();
        return view("admin.lessens", compact("lessens",'academicSubjects'));
    }
}
