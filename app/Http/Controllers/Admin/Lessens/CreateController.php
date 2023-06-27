<?php

namespace App\Http\Controllers\Admin\Lessens;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;

class CreateController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        unset($id["_token"]);
        Lessen::create($id);
        $academicSubjects = json_encode(AcademicSubject::get());
        $lessens = json_encode(Lessen::get());
        return compact("lessens",'academicSubjects');
    }
}
