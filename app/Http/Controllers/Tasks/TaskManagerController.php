<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\AcademicSubjectController;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use App\Models\Lessen;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskManagerController extends Controller
{
    public function __invoke($lessen)
    {
        $academic_subjects = AcademicSubjectController::getAcademicSubjects();
        $lessenId = Lessen::get()->where('id',$lessen)->value('id');
        $lessenTitle = Lessen::get()->where('id',$lessen)->value('title');
        $tasks = Task::all()->where('lessen_id', $lessenId);
        return view("task.show", compact("tasks", 'academic_subjects', 'lessenTitle',"lessenId"));
    }
}
