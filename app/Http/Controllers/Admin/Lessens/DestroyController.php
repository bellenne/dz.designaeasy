<?php

namespace App\Http\Controllers\Admin\Lessens;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        Lessen::destroy($id["course_id"]);
        $academicSubjects = json_encode(AcademicSubject::get());
        $lessens = json_encode(Lessen::get());
        return compact("lessens",'academicSubjects');
    }
}
