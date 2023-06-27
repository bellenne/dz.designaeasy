<?php

namespace App\Http\Controllers\Admin\Lessens;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;

class UpdateController extends Controller
{
    public function __invoke()
    {
        $data = request()->all();

        $lessen = Lessen::find($data["lessen_id"]);
        $lessen->update([
            $data["column"]=>$data["value"]
        ]);
        $academicSubjects = json_encode(AcademicSubject::get());
        $lessens = json_encode(Lessen::get());
        return compact("lessens",'academicSubjects');
    }
}
