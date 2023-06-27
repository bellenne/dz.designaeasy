<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function __invoke()
    {
//        $tasks = Task::get(); = DB::table('academic_subjects')->join('lessens','academic_subjects.id','=','lessens.academicSubject_id')->get();
        $tasks = DB::table("tasks")
            ->select('*','tasks.deleted_at as task_deleted_at', 'tasks.id as task_id','tasks.title AS task')
            ->join('lessens', 'lessens.id', '=', 'tasks.lessen_id')
            ->join('academic_subjects', 'academic_subjects.id', '=', 'lessens.academicSubject_id')
            ->get()->where('task_deleted_at', '=', '');
        $lessens = Lessen::get();
        $academicSubjects = AcademicSubject::get();
        return view("admin.tasks", compact("tasks",'lessens',"academicSubjects"));
    }

    public function loadLessens(){
        $id = request()->all();
        $lessens = Lessen::get()->where("academicSubject_id", $id['course_id'])->toArray();
//        var_dump(json_encode($lessens));
//        dd(response()->json($lessens));
        return $lessens;
    }
}
