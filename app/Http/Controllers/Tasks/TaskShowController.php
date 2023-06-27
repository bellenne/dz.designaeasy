<?php

namespace App\Http\Controllers\Tasks;
use App\Http\Controllers\AcademicSubjectController;
use App\Models\FinalyTask;
use App\Models\Lessen;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class TaskShowController extends Controller
{
    public function __invoke()
    {
        $taskId = request()->get("taskId");
        $taskInfo = Task::get()->where('id',$taskId);
        $taskResult = FinalyTask::get()->where('user_id', auth()->id())->where('task_id', "=", $taskId)->value("result");
//        dd();
        $taskInfo = Arr::add($taskInfo,"result", $taskResult);
        return json_encode($taskInfo);

    }

    public function showTask(){
        $taskId = request()->get("taskId");
        $taskInfo = Task::get()->where('id',$taskId);
        $taskResult = FinalyTask::get()->where('user_id', auth()->id())->where('task_id', "=", $taskId)->value("result");
//        dd();
        $taskInfo = Arr::add($taskInfo,"result", $taskResult);

        $academic_subjects = AcademicSubjectController::getAcademicSubjects();
//        $lessenId = Lessen::get()->where('id',$lessen)->value('id');
//        $lessenTitle = Lessen::get()->where('id',$lessen)->value('title');
//        $tasks = Task::all()->where('lessen_id', $lessenId);
        return view("task.show", compact("taskInfo"));;
    }
}
