<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

 $query = "SELECT emp_gender, count(*) as number FROM employee_info GROUP BY emp_gender";  
 $result = mysqli_query($conn, $query); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Dashboard</title>
<?php include "all_css.php"; ?>
    <!--
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawChart);  
function drawChart()  
{  
    var data = google.visualization.arrayToDataTable([  
              ['Gender', 'Number'],  
              <?php  
              while($row = mysqli_fetch_array($result))  
              {  
                   echo "['".$row["emp_gender"]."', ".$row["number"]."],";  
              }  
              ?>  
         ]);  
    var options = {  
          title: 'Percentage of Male and Female Employee',  
          //is3D:true,  
          pieHole: 0.4  
         };  
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
    chart.draw(data, options);  
}  
</script>   -->   
</head>
<body> 
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <hr>
            
            <div style="width:900px;">  
                  
                <br />  
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
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