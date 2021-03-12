@extends("base")
@section("report")
    <br>
    <br>
    <br>
    <div id="timeInput">
        <form name="myForm" id="demoForm" method="GET" action="" onsubmit="return validateForm()">
            <!-- The start date field -->
            <label>From: </label>
            <input type="date" name="startDate">

            <!-- The end date field -->
            <label style="margin-left:20px">To: </label>
            <input type="date" name="endDate">
            <input style="margin-left:20px" type="submit" value="Submit">
        </form>
    </div>
    <br>
    <style>
        #timeInput {
            border: 1px solid #000000;
            padding: 10px;
            width: max-content;
        }
    </style>
    <div id="container">
    </div>
@endsection
@push('scripts')
<script>
    function validateForm() {
        var startDate = Date.parse(document.forms["myForm"]["startDate"].value);
        var endDate = Date.parse(document.forms["myForm"]["endDate"].value);
        if (startDate > endDate) {
            alert("Start date must be earlier than end date !");
            return false;
        }
    }
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript">
    var resultData = <?php echo json_encode($resultData)?>;
    resultData.map((chart, index) => {
        console.log(chart)
        // Create container div for each chart
        var container = document.getElementById("container");
        var containerName = "container" + index.toString();
        var newChildDiv = document.createElement("div");
        newChildDiv.id = containerName;
        container.appendChild(newChildDiv);

        Highcharts.chart(containerName, {
            legend: {
                align: chart.legendAlign,
                verticalAlign: chart.verticalAlign,
                layout: chart.layout 
            },
            title: {
                text: chart.title
            },
            xAxis: {
                categories: chart.data[0],
                title: {
                    text: chart.xTitle
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: chart.yTitle
                }
            },
            plotOptions: {
                column: {
                    stacking: "normal"
                }
            },
            series: chart.data[1]
        });
    })
</script>
@endpush