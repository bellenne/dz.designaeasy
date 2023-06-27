<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\FinalyTask;

class FinalyTaskCreateController extends Controller
{
    public function __invoke()
    {
        $params = request()->all();

        unset($params["_token"]);

        $finalyTask = FinalyTask::firstOrCreate([
            'user_id' => $params["user_id"],
            'task_id' => $params["task_id"],
        ],$params);

        return $finalyTask ;
    }
}

