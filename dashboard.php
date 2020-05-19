<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

$query1 = "SELECT emp_gender, count(*) as number FROM employee_info GROUP BY emp_gender";  
$result1 = mysqli_query($conn, $query1); 

$query2 = "SELECT emp_gender, count(*) as number FROM employee_info GROUP BY emp_gender";  
$result2 = mysqli_query($conn, $query2); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Dashboard</title>
<?php include "all_css.php"; ?>
<style>
.chart {
width: 100%; 
min-height: 450px;
overflow: hidden;

}

</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  


google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);
function drawChart1() {
var data = google.visualization.arrayToDataTable([  
['Gender', 'Number'],  
<?php  
while($row = mysqli_fetch_array($result1)){  
echo "['".$row["emp_gender"]."', ".$row["number"]."],";  
}  
?>  
]); 

var options = {
title: 'Gender in Company',
colors: ['#e0440e', '#e6693e'],
//hAxis: {title: 'Year', titleTextStyle: {color: '#333'}}
};

var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
chart.draw(data, options);
}

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);
function drawChart2() {
var data = google.visualization.arrayToDataTable([  
['Gender', 'Number'],  
<?php  
while($row = mysqli_fetch_array($result2)){  
echo "['".$row["emp_gender"]."', ".$row["number"]."],";  
}  
?>  
]); 

var options = {
title: 'Gender in Company',
colors: ['#e0440e', '#e6693e'],
//hAxis: {title: 'Year', titleTextStyle: {color: '#333'}}
};

var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
chart.draw(data, options);
}
//window.onresize = function(){ location.reload(); }
$(window).resize(function(){
drawChart1();
drawChart2();
});

// Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //    
</script>  
</head>
<body> 
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
<div id="page-content-wrapper">
<?php include "navbar.php"; ?>
<div class="container-fluid">
<h1 class="mt-4">Dashboard</h1>
<hr>

<div class="row">

<div class="col-md-6">
<div id="chart_div1" class="chart"></div>
</div>
<div class="col-md-6">
<div id="chart_div2" class="chart"></div>
</div>
</div>


</div>
</div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});

if ($(window).width() < 922) {
$('#sidebar').collapse({
toggle: false
});
} else {
$('#sidebar').collapse({
toggle: true
});
}
</script>
</body>
</html>