<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  
  <style>
    p{
        font-family:"Bahnschrift";
        font-size:25px
    }
    a{
        text-decoration: none;
    }
    .widget{
        height:30px;
        width:20px;
    }
    h2{
        color:black;
    }
    .card{
        background-color: rgb(0 0 0 / 8%);
    }
    .card-title{
        font-size:10px;
        font-family:Arial;
    }
    #chartdiv {
  width: 100%;
  height: 250px;
}
    </style>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(
  am5xy.XYChart.new(root, {
    focusable: true,
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX"
  })
);

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(
  am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "day", count: 1 },
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
  })
);

var yAxis = chart.yAxes.push(
  am5xy.ValueAxis.new(root, {
    renderer: am5xy.AxisRendererY.new(root, {})
  })
);

var color = root.interfaceColors.get("background");

// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(
  am5xy.CandlestickSeries.new(root, {
    fill: color,
    stroke: color,
    name: "MDXI",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "close",
    openValueYField: "open",
    lowValueYField: "low",
    highValueYField: "high",
    valueXField: "date",
    tooltip: am5.Tooltip.new(root, {
      pointerOrientation: "horizontal",
      labelText: "open: {openValueY}\nlow: {lowValueY}\nhigh: {highValueY}\nclose: {valueY},\nmediana: {mediana}"
    })
  })
);

// mediana series
var medianaSeries = chart.series.push(
  am5xy.StepLineSeries.new(root, {
    stroke: root.interfaceColors.get("background"),
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "mediana",
    valueXField: "date",
    noRisers: true
  })
);

// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  xAxis: xAxis
}));
cursor.lineY.set("visible", false);

var data = [
  {
    date: "2019-08-01",
    open: 132.3,
    high: 136.96,
    low: 131.15,
    close: 136.49
  },
  {
    date: "2019-08-02",
    open: 135.26,
    high: 135.95,
    low: 131.5,
    close: 131.85
  },
  {
    date: "2019-08-03",
    open: 129.9,
    high: 133.27,
    low: 128.3,
    close: 132.25
  },
  {
    date: "2019-08-04",
    open: 132.94,
    high: 136.24,
    low: 132.63,
    close: 135.03
  },
  {
    date: "2019-08-05",
    open: 136.76,
    high: 137.86,
    low: 132.0,
    close: 134.01
  },
  {
    date: "2019-08-06",
    open: 131.11,
    high: 133.0,
    low: 125.09,
    close: 126.39
  },
  {
    date: "2019-08-09",
    open: 131.11,
    high: 133.0,
    low: 122.09,
    close: 124.39
  }
];

addMediana();

function addMediana() {
  for (var i = 0; i < data.length; i++) {
    var dataItem = data[i];
    dataItem.mediana =
      Number(dataItem.low) + (Number(dataItem.high) - Number(dataItem.low)) / 2;
  }
}

series.data.processor = am5.DataProcessor.new(root, {
  dateFields: ["date"],
  dateFormat: "yyyy-MM-dd"
});

series.data.setAll(data);
medianaSeries.data.setAll(data);

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
series.appear(1000, 100);
medianaSeries.appear(1000, 100);
chart.appear(1000, 100);

}); // end am5.ready()
</script>
</head>

<body>
<div class=".container-fluid" style="background-color: rgb(0 0 0 / 8%);"> 
 <div  class="rounded" style="margin:10px 10px; background-color: white">
    <div class="col-md-12">
        <p>Karma Yoga, you have <b>3 activities</b> live on Switch.<br>
         You've had <b><a href="#">6,254 people</a></b> look at your activities this month.<br>
        You managed to turn that into <a href="#">52 bookings</a></p>
    </div>
    <div class="container-fluid" >
    <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"><b>Revenue for December </b><i class='fas fa-angle-down'></i> <i style="float:right" class='fas fa-chevron-right'></i></h6>
        <div class="col-md-6">
            <img src="coin.png" style="float:left; padding-top:5px"class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h3 style="float:left">6,800</h3><h6 style="padding-top:10px">AED</h6><br>TOTAL THIS MONTH
            </div>
        </div>
        <div class="col-md-6" style="float:left">
            <img src="flash.png" style="float:left; padding-top:5px"class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h3 style="float:left">4,100</h3><h6 style="padding-top:10px">AED</h6><br>FROM SWITCH+ MEMBERS
            </div>
        </div>
        <div class="col-md-6">
            <img src="satellite.png" style="float:left; padding-top:5px"class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h3 style="float:left">670</h3><h6 style="padding-top:10px"></h6><br>BOOKING THIS MONTH
            </div>
        </div>
        <div class="col-md-6" style="float:left">
            <img src="eye.png" style="float:left; padding-top:5px"class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h3 style="float:left">2,390</h3><h6 style="padding-top:10px"></h6><br>VIEWS THIS MONTH
            </div>
        </div>
        <!-- <div>            
                        <img src="flash.png" class="widget">
                        <b>4,100 AED</b>
                        <strong> FROM SWITCH+ MEMBERS</strong>
        </div> -->
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"><b>Switch Credit </b><i class='fas fa-angle-down'></i><i style="float:right" class='fas fa-angle-right '></i> </h6>
        <div class="col-md-6">
            <img src="coin.png" style="float:left; padding-top:5px"class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h3 style="float:left">70,540</h3><h6 style="padding-top:10px">AED</h6><br>TOTAL THIS MONTH
            </div>
        </div>
        <div class="col-md-6" style="float:left">
            <div style="float:left"> 
                <h5 style="float:left">of Switch Credit is available this month for activities like yours</h5>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-sm-6" style="margin-top:20px ">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"><b>Top Performer </b><i class='fas fa-angle-down'></i><i style="float:right" class='fas fa-angle-right '></i> </h6>
        
        <div class="col-md-6">
            <img src="cd.png" style="float:left; padding-top:5px "class="widget">
            <!-- </div> -->
            <div style="float:left"> 
                <h6 style="float:left">Dune Buggy Extreme </h3><h6 style="padding-top:10px"> 790 AED</h6><br>
            </div>
        </div>
        <div class="col-md-3" style="float:left;margin-left:10px">
        <img src="ticket.png" style="float:left; padding-top:5px"class="widget">
            <div style="float:left"> 
                <h5 style="float:left">52 Bookings</h5>
            </div>
        </div>
        <div class="col-md-3" style="float:left">
        <img src="coin.png" style="float:left; padding-top:5px"class="widget">
            <div style="float:left">        
                <h3 style="float:left">70,540</h3><h6 style="padding-top:10px">AED</h6><br>Avg Value of each month

            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6" >
    <div class="card">
      <div class="card-body">
<h6 class="card-title"><b>Conversion for December </b><i class='fas fa-angle-down'></i><i style="float:right" class='fas fa-angle-right '></i></h6>
       <div class="row">
        <div class="col-md-4">
            <div id="chartdiv"></div>
        </div>
    
        <div class="col-md-4" style="float:right">
        
            <div style="float:left"> 
            <img src="eye.png" style="float:left; padding-top:5px"class="widget"><br>
                <h5 style="float:left">90 Views</h5>
            </div>
            <div style="float:left"> 
            <img src="ticket.png" style="float:left; padding-top:5px"class="widget"><br>
                <h5 style="float:left">18 Bookings</h5>
            </div>
        </div>
</div>
      </div>
    </div>
  </div>
</div>

    </div>
    
</div>
</div>

</body>

</html><?php /**PATH C:\Users\hp\Desktop\Laravel-proj\laravel-proj-demo\resources\views/bootstrapp.blade.php ENDPATH**/ ?>