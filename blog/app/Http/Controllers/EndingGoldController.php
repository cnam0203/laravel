<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndingGoldController extends Controller
{
    public function handleChart(Request $request)
    {
        $condition = '';
        if (checkCondition($request->all()) != '')
            $condition = " where ".checkCondition($request->all());
            
        $querySumByLevel = "select DATE, LEVEL as CATEGORY, SUM_GOLD as SUM from game_metrics.daily_report_ending_gold_level".$condition;        
        $endingGoldData = getStackChartData($querySumByLevel, "column");
        $endingGoldChart = createStackChart("Amount of Ending Gold by Level per day", "Date", "Gold", $endingGoldData);

        $resultData = [$endingGoldChart];
        
        
        return view('daily_report', compact('resultData'));
    }
}
