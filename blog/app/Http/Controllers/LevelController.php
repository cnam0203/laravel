<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function handleChart(Request $request)
    {
        $condition = '';
        if (checkCondition($request->all()) != '')
            $condition = " where ".checkCondition($request->all());

        $querySumByLevel = "select DATE, LEVEL as CATEGORY, num_user as SUM from game_metrics.daily_report_level".$condition;
        $levelData = getStackChartData($querySumByLevel, "area");
        $levelChart = createStackChart("Number of Users by Level per day", "Date", "nUsers", $levelData);

        $resultData = [$levelChart];
        
        return view('daily_report', compact('resultData'));
    }
}
