<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        unset($id["_token"]);
        Task::create($id);
        $tasks = DB::table("tasks")
            ->select('*','tasks.deleted_at as task_deleted_at', 'tasks.id as task_id','tasks.title AS task')
            ->join('lessens', 'lessens.id', '=', 'tasks.lessen_id')
            ->join('academic_subjects', 'academic_subjects.id', '=', 'lessens.academicSubject_id')
            ->get()->where('task_deleted_at', '=', '');
//        dd($tasks);
        return json_encode($tasks);
    }
}
