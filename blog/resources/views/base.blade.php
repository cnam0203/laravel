<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Laravel 8 Highcharts Demo</title>
</head>
<style>
    .chart-outer {
        max-width: 800px;
        margin: 2em auto;
    }
    #container {    
        height: 300px;
        margin-top: 2em;
        min-width: 380px;
    }
    .highcharts-data-table table {
        border-collapse: collapse;
        border-spacing: 0;
        background: white;
        min-width: 100%;
        margin-top: 10px;
        font-family: sans-serif;
        font-size: 0.9em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        border: 1px solid silver;
        padding: 0.5em;
    }
    .highcharts-data-table tr:nth-child(even), .highcharts-data-table thead tr {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #eff;
    }
    .highcharts-data-table caption {
        border-bottom: none;
        font-size: 1.1em;
        font-weight: bold;
    }
    /* Dropdown Button */
    .dropbtn {
        background-color: #000000;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #ddd;}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {display: block;}

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {background-color: #3e8e41;}

    input {
      box-sizing: border-box;
      position: relative;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
      background: transparent;
      cursor: pointer;
      position: absolute;
      height: 100%;
      width: 100%;
      top: 0;
      left: 0;
    }

    
</style>

<body>
    <h1>GAME ICA - DAILY REPORT</h1>
    <div class="dropdown">
        <button class="dropbtn">Choose Report</button>
        <div class="dropdown-content">
            <a href="./">Home</a>
            <a href="./daily_report_action">Action</a>
            <a href="./daily_report_level">Level</a>
            <a href="./daily_report_resource">Resource</a>
            <a href="./daily_report_offer">Offer</a>
            <a href="./daily_report_ending_gold">Ending Gold</a>
        </div>
    </div>
    @section('report')
    @show
    </div>
</body>
@stack("scripts")
</html>