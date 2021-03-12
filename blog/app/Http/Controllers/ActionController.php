<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function handleChart(Request $request)
    {
        $condition = '';
        if (checkCondition($request->all()) != '')
            $condition = " where ".checkCondition($request->all());

        $querySumByUser = "select DATE, ACTIONID as CATEGORY, NUM_USER as SUM from game_metrics.daily_report_action".$condition;
        $userData = getStackChartData($querySumByUser, "column");
        $userChart = createStackChart("Number of Users by Action per day", "Date", "nUsers", $userData);

        $querySumByAction = "select DATE, ACTIONID as CATEGORY, NUM_ACTION as SUM from game_metrics.daily_report_action".$condition;
        $actionData = getStackChartData($querySumByAction, "column");
        $actionChart = createStackChart("Number of Actions per day", "Date", "nActions", $actionData);

        $resultData = [$userChart, $actionChart];
        
        return view('daily_report', compact('resultData'));
    }
};
