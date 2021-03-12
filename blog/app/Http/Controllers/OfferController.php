<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function handleChart(Request $request)
    {
        $condition = '';
        if (checkCondition($request->all()) != '')
            $condition = " and".checkCondition($request->all());

        $querySumByActiveUser = "select DATE, OFFER_VALUE as CATEGORY, NUM_USER as SUM from game_metrics.daily_report_offer WHERE OFFER_TYPE = 'S'".$condition;
        $activeUserData = getStackChartData($querySumByActiveUser, "column");
        $activeUserChart = createStackChart("Number of Users by Active Offers per day", "Date", "nUsers", $activeUserData);


        $querySumByActiveOffer = "select DATE, OFFER_VALUE as CATEGORY, NUM_OFFER as SUM from game_metrics.daily_report_offer WHERE OFFER_TYPE = 'S'".$condition;
        $activeOfferData = getStackChartData($querySumByActiveOffer, "area");
        $activeOfferChart = createStackChart("Number of Active Offers by Source per day", "Date", "nOffers", $activeOfferData);


        $querySumByPayUser = "select DATE, OFFER_VALUE as CATEGORY, NUM_USER as SUM from game_metrics.daily_report_offer WHERE OFFER_TYPE = 'P'".$condition;
        $payUserData = getStackChartData($querySumByPayUser, "line");
        $payUserChart = createStackChart("Number Users by Pay Offers per day", "Date", "nUsers", $payUserData);

        $querySumByPayOffer = "select DATE, OFFER_VALUE as CATEGORY, NUM_OFFER as SUM from game_metrics.daily_report_offer WHERE OFFER_TYPE = 'P'".$condition;
        $payOfferData = getStackChartData($querySumByPayOffer, "bar");
        $payOfferChart = createStackChart("Number of Pay Offers by Source per day", "Date", "nOffers", $payOfferData);

        $resultData = [$activeUserChart, $activeOfferChart, $payUserChart, $payOfferChart];
        
        return view('daily_report', compact('resultData'));
    }
}
