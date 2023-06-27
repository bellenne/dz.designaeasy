<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class DestroyController extends Controller
{
    public function __invoke()
    {
        $id = request()->all();
        Task::destroy($id["task_id"]);
        $tasks = DB::table("tasks")
            ->select('*','tasks.deleted_at as task_deleted_at', 'tasks.id as task_id','tasks.title AS task')
            ->join('lessens', 'lessens.id', '=', 'tasks.lessen_id')
            ->join('academic_subjects', 'academic_subjects.id', '=', 'lessens.academicSubject_id')
            ->get()->where('task_deleted_at', '=', '');
//        dd($tasks);
        return json_encode($tasks);
    }
}
