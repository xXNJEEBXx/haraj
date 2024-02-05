<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
//get accounts_and_thire_ads
use App\Models\accounts_and_thire_ads;

class Controller extends BaseController
{


    public function git_progress_task()
    {
        return ["data" => self::git_progress_task_text()];
    }

    public function git_progress_task_text()
    {
        $tasks = accounts_and_thire_ads::all();

        foreach ($tasks as $task) {
            for ($i = 1; $i <= 3; $i++) {
                $now = time();
                //  return [$now, $task["ad" . $i . "_last_update"]];

                //chack if the task has not last_update record and the time did not take more than 1 hour
                if ($task["ad" . $i . "_last_update"] == null || $task["ad" . $i . "_last_update"] - self::git_next_time($task, $i, $now - (60 * 60)) > 60 * 60 || $task["ad" . $i . "_last_update"] - self::git_next_time($task, $i, $now - (60 * 60)) < 0) {
                    $task["ad" . $i . "_last_update"] = self::git_next_time($task, $i, $now);
                    $task->save();
                }
                //chack if the time is finished and the time did not take more than 1 hour
                if ($now >= (int)$task["ad" . $i . "_last_update"]) {
                    $task["ad" . $i . "_last_update"] =  $now + 60 * 3;
                    $task->save();
                    $task->ad_number = $i;
                    return $task;
                }
            }
        }
        return "no tasks";
    }

    public function git_next_time($task, $i, $now)
    {
        $next__task_time = $task["ad" . $i . "_time"];
        //$next_time is 0:00~23:59;
        $hour = (int)substr($next__task_time, 0, 2) - 3;
        $minute = (int)substr($next__task_time, 3, 2);
        $current_month = date('m');
        $current_day = date('d');
        $current_year = date('Y');
        $next_time = mktime($hour, $minute, 0, $current_month, $current_day, $current_year);
        if ($now > $next_time) {
            // If it's already past 9:00 AM, set next_time to 9:00 AM tomorrow
            $next_time = mktime($hour, $minute, 0, $current_month, $current_day + 1, $current_year);
        }
        return $next_time;
    }


    public function update_progress_task(Request $data)
    {
        $task = accounts_and_thire_ads::where('id', $data["id"])->first();
        if ($task) {
            $task->{"ad" . $data["ad_number"] . "_last_update"} = time() + 60 * 3;
            $task->save();
            return ["data" => "success"];
        }
        return ["data" => $data];
    }

    use AuthorizesRequests, ValidatesRequests;
}
