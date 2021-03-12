<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function handleChart(Request $request)
    {
        $condition = '';
        if (checkCondition($request->all()) != '')
            $condition = " and".checkCondition($request->all());

        $querySumEarnGold = "select DATE, SOURCE as CATEGORY, SUM_GOLD as SUM from game_metrics.daily_report_gold where ACTION = 'E'".$condition;
        $earnGoldData = getStackChartData($querySumEarnGold, "column");
        $earnGoldChart = createStackChart("Amount of Earned Gold per day", "Date", "Gold", $earnGoldData);


        $querySumSpentGold = "select DATE, SOURCE as CATEGORY, SUM_GOLD as SUM from game_metrics.daily_report_gold where ACTION = 'S'".$condition;
        $spentGoldData = getStackChartData($querySumSpentGold, "column");
        $spentGoldChart = createStackChart("Amount of Spent Gold per day", "Date", "Gold", $spentGoldData);


        $querySumEarnGem = "select DATE, SOURCE as CATEGORY, SUM_GEM as SUM from game_metrics.daily_report_gem where ACTION = 'E'".$condition;
        $earnGemData = getStackChartData($querySumEarnGem, "column");
        $earnGemChart = createStackChart("Amount of Earned Gem per day", "Date", "Gem", $earnGemData);

        $querySumSpentGem = "select DATE, SOURCE as CATEGORY, SUM_GEM as SUM from game_metrics.daily_report_gem where ACTION = 'S'".$condition;
        $spentGemData = getStackChartData($querySumSpentGem, "column");
        $spentGemChart = createStackChart("Amount of Spent Gem per day", "Date", "Gem", $spentGemData);

        $querySumEarnItem = "select DATE, SOURCE as CATEGORY, SUM_ITEM as SUM from game_metrics.daily_report_item where ACTION = 'E'".$condition;
        $earnItemData = getStackChartData($querySumEarnItem, "column");
        $earnItemChart = createStackChart("Number of Earned Items per day", "Date", "nItems", $earnItemData);

        $querySumSpentItem = "select DATE, SOURCE as CATEGORY, SUM_ITEM as SUM from game_metrics.daily_report_item where ACTION = 'S'".$condition;
        $spentItemData = getStackChartData($querySumSpentItem, "column");
        $spentItemChart = createStackChart("Number of Spent Items per day", "Date", "nItems", $spentItemData);

        $querySumEarnShell = "select DATE, SOURCE as CATEGORY, SUM_SHELL as SUM from game_metrics.daily_report_shell where ACTION = 'E'".$condition;
        $earnShellData = getStackChartData($querySumEarnShell, "column");
        $earnShellChart = createStackChart("Amount of Earned Shell per day", "Date", "Shell", $earnShellData);

        $querySumSpentShell = "select DATE, SOURCE as CATEGORY, SUM_SHELL as SUM from game_metrics.daily_report_shell where ACTION = 'S'".$condition;
        $spentShellData = getStackChartData($querySumSpentShell, "column");
        $spentShellChart = createStackChart("Amount of Spent Shell per day", "Date", "Shell", $spentShellData);

        $resultData = [$earnGoldChart, $spentGoldChart, $earnGemChart, $spentGemChart, $earnItemChart, $spentItemChart, $earnShellChart, $spentShellChart];
        return view('daily_report', compact('resultData'));
    }
}
