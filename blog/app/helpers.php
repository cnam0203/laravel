<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

function getStackChartData($query, $stackType) {
    $results = DB::select($query);
    $rows = json_decode(json_encode($results), true);

    $listDate = [];
    $listCategories = [];

    $listDateIndex = new \stdClass();
    $listCategoriesIndex = new \stdClass();
    $listTotalByCategory = [];
    $listTotalByDate = [];
    
    $listDate = array_map(function ($row) { return $row['DATE']; }, $rows);
    $listCategories = array_map(function ($row) { return $row['CATEGORY']; }, $rows);
     
    $listDate = array_unique($listDate);
    $listCategories = array_unique($listCategories);
    $listTotalByDate = array_fill(0, sizeof($listDate), 0);

    sort($listDate);
    $listDate = array_values($listDate);
    natsort($listCategories);
    $listCategories = array_values($listCategories);

    array_walk($listDate, 
                function ($date, $index, &$listDateIndex) 
                { 
                    $listDateIndex->$date = $index; 
                }, $listDateIndex);

    array_walk($listCategories, 
                function ($category, $index, &$listCategoriesIndex) 
                { 
                    $listCategoriesIndex->$category = $index; 
                }, $listCategoriesIndex);

    foreach($listCategories as $category) {
        $listUserByAction = new \stdClass();
        $listUserByAction->name = $category;
        $listUserByAction->type = $stackType;
        $listUserByAction->data = array_fill(0, sizeof($listDate), 0);
        array_push($listTotalByCategory, $listUserByAction);
    }
    foreach($rows as $row) {
        $category = $row["CATEGORY"];
        $date = $row["DATE"];
        $categoryIndex = $listCategoriesIndex->$category;
        $dateIndex = $listDateIndex->$date;
        
        ($listTotalByCategory[$categoryIndex]->data)[$dateIndex] = floatval($row["SUM"]);
        $listTotalByDate[$dateIndex] += floatval($row["SUM"]);
    }

    if ($stackType == "column") {
        $total_colum = new \stdClass();
        $total_colum->name = "Total";
        $total_colum->data = $listTotalByDate;
        array_push($listTotalByCategory, $total_colum);
    }
    return [$listDate, $listTotalByCategory];
}

function checkCondition($params) {
    $condition = '';
    $checkAnd = false;
    
    if (array_key_exists("startDate", $params) && $params["startDate"] != NULL) {
            $condition = $condition." DATE >= "."'".$params["startDate"]."'";
            $checkAnd = true;
    }
    if (array_key_exists("endDate", $params)  && $params["endDate"] != NULL ) {
        if ($checkAnd)
            $condition = $condition." and ";
        $condition = $condition." DATE <= "."'".$params["endDate"]."'";
    }

    return $condition;
}

function createStackChart($chartTitle="", $xTitle="", $yTitle="", $chartData=array(), $legendAlign = "right", $verticalAlign = "top", $layout = "vertical") {
    $chart = new \stdClass();
    $chart->title = $chartTitle;
    $chart->xTitle = $xTitle;
    $chart->yTitle = $yTitle;
    $chart->data = $chartData;
    $chart->legendAlign = $legendAlign;
    $chart->verticalAlign = $verticalAlign;
    $chart->layout = $layout;

    return $chart;
}