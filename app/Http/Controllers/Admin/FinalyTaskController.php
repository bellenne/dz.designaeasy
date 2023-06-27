<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinalyTaskController extends Controller
{
    public function __invoke()
    {
        $tasks = DB::table("finaly_tasks")
            ->select('finaly_tasks.id as ft_id','finaly_tasks.user_id', 'finaly_tasks.task_id as task_id','finaly_tasks.result AS ft_result', 'finaly_tasks.deleted_at as ft_deleted_at', 'users.name as fio','tasks.id as t_id', 'tasks.lessen_id', 'tasks.title as t_title', 'lessens.id as l_id', 'lessens.academicSubject_id', 'lessens.title as l_title', "academic_subjects.id as as_id", 'academic_subjects.name as as_name')
            ->join('users', 'users.id', '=', 'finaly_tasks.user_id')
            ->join('tasks', 'tasks.id', '=', 'finaly_tasks.task_id')
            ->join('lessens', 'lessens.id', '=', 'tasks.lessen_id')
            ->join('academic_subjects', 'academic_subjects.id', '=', 'lessens.academicSubject_id')
            ->get()->where('ft_deleted_at', '=', '');
//        dd($tasks);
        return view("admin.finalytask", compact("tasks"));
    }
}
