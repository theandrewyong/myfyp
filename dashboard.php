<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

//get current month
$current_month = date("m");
//get previous month
if($current_month != 1){
    $previous_month = $current_month - 1;
    //echo $previous_month;
}else{
    $previous_month = 1;
}

//get year 
$get_year = date("Y");

if(isset($_POST["submit_year"])){
    $get_year = $_POST["select_year"];
}

$query1 = "SELECT process_payroll_net_pay, process_payroll_process_month, SUM(process_payroll_net_pay) as number FROM process_payroll WHERE process_payroll_process_year = '$get_year' GROUP BY process_payroll_process_month";  
$result1 = mysqli_query($conn, $query1); //chart 1

$query2 = "SELECT employee_info.*, process_payroll.*, process_payroll.SUM(process_payroll_net_pay) as number FROM process_payroll INNER JOIN employee_info ON employee_info.emp_id = process_payroll.emp_id WHERE process_payroll_process_year = '$get_year' GROUP BY emp_id";  
$result2 = mysqli_query($conn, $query2); //chart 2



//do comparison
$all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");
$to_process_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$previous_month' AND process_payroll_process_year = '$get_year'");

if(mysqli_num_rows($all_employee_sql) != 0){
    //get all employee from employee info table
    while($all_emp_data = mysqli_fetch_assoc($all_employee_sql)){
        $emp_array[] = $all_emp_data["emp_id"];
    }
}else{
    $emp_array[] = "";
}
if(mysqli_num_rows($to_process_sql) != 0){
    //get all processed employee from process payroll
    while( $compare_data = mysqli_fetch_assoc($to_process_sql)){
        $process_array[] = $compare_data["emp_id"];
    }
}else{
    $process_array[] = "";
}


$show_table_data = array_diff($emp_array, $process_array);

//echo print_r($process_array);



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

//Chart 1
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);
function drawChart1() {
    var data = google.visualization.arrayToDataTable([  
    ['Month', 'Wages'],  
    <?php  
        while($row = mysqli_fetch_array($result1)){  
            echo "['".$row["process_payroll_process_month"]."', ".$row["number"]."],";  
        }      
    ?>  
    ]); 

    var options = {
        title: 'Total NetPay(NP) by Month',
        colors: ['#e0440e', '#e6693e'],
        hAxis: {title: 'Month', titleTextStyle: {color: '#333'}}
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
    chart.draw(data, options);
}

//Chart 2
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);
function drawChart2() {
    var data = google.visualization.arrayToDataTable([  
    ['Employee', 'NetPay'], 
    <?php  
        while($row = mysqli_fetch_array($result2)){  
            echo "['".$row["emp_display_id"]."', ".$row["number"]."],";  
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
        <div class="p-3 bg-white rounded shadow mb-3">
            <h5>Welcome, <?php echo $username; ?></h5><hr>
            <h5><div id="para1"></div></h5>
        </div>
    </div>    
    <div class="col-md-6">
        <div class="p-3 bg-white rounded shadow mb-3">
            <div class="form-group">
                <label for="select_year"><b>Select Year (Process Year)</b></label>
                <div class="form-inline">
                    <form action="dashboard.php" method="POST">
                    <input type="text" class="form-control" name="select_year" value="<?php echo date('Y'); ?>">
                    <input type="submit" class="btn btn-primary" name="submit_year" value="Select Year">
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>    
    
<div class="row">
<div class="col-md-6">
<div class="p-3 bg-white rounded shadow mb-3">
    <p><b>Previous Month Processed Employee</b></p><hr>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php
                    foreach($emp_array as $ea){
                        $find_done = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll.process_payroll_process_month = '$previous_month' AND process_payroll.process_payroll_process_year = '$get_year' AND process_payroll.emp_id = '$ea'");
                        $find_done_result = mysqli_fetch_assoc($find_done);
                        if($find_done_result){
                        echo '<tr>';
                        echo '<td>' . $find_done_result["emp_display_id"] . '</td>';
                        echo '<td>' . $find_done_result["emp_full_name"] . '</td>';
                        echo '</tr>';                            
                        }

                    }       
                    ?>
                    </tbody>
                    </table>
                </div>     
    </div>
</div>
<div class="col-md-6">
<div class="p-3 bg-white rounded shadow mb-3">
    <p><b>Pending AdHoc List</b></p><hr>
    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>AdHoc Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $adhoc_pending_sql = "SELECT adhoc_pending.*, employee_info.* FROM adhoc_pending INNER JOIN employee_info ON adhoc_pending.emp_id = employee_info.emp_id";
            $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $adhoc_pending_sql);
            mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
            $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 

            if($epf_result->num_rows > 0) { 
                while ($data = $epf_result->fetch_assoc()) {
                    $adhoc_id = $data["adhoc_id"];
                    $delete_adhoc_id = $data["adhoc_id"];
                    echo '<tr>';
                    echo '<td>' . $data["emp_display_id"] . '</td>';
                    echo '<td>' . $data["emp_full_name"] . '</td>';
                    echo '<td>' . "bonus" . '</td>';
                    echo '<td>' . $data["adhoc_amt"] . '</td>';
                    echo '<td>' . $data["adhoc_status"] . '</td>';
                    echo '<td>' . '<a class="btn btn-primary" href="editadhocpending.php?adhoc_id=' . $adhoc_id . '">Edit</a>' . '</td>';
                    echo '<td>' . '<a class="btn btn-danger" href="newadhoc.php?delete_adhoc_id=' . $delete_adhoc_id . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . '</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>     
    </div> 
</div>
</div>
    
<div class="row">
<div class="col-md-6">
<div class="p-3 bg-white rounded shadow mb-3">
<p><b>Total Net Pay(NP) by Month</b></p><hr>
<?php
//if process payroll is not empty, show charts
    $process_payroll_sql = mysqli_query($conn, "SELECT * FROM process_payroll");
  if($pp_result = mysqli_num_rows($process_payroll_sql) > 0){
    echo '<div id="chart_div1" class="chart"></div>';      
  }else{
      echo '<p>There are currently no processed payroll</p>';
  }  
?>

    </div>
</div>
<div class="col-md-6">
<div class="p-3 bg-white rounded shadow mb-3">
<p><b>Total Net Pay(NP) by Employee</b></p><hr>
<?php
//if process payroll is not empty, show charts
    $process_payroll_sql = mysqli_query($conn, "SELECT * FROM process_payroll");
  if($pp_result = mysqli_num_rows($process_payroll_sql) > 0){
    echo '<div id="chart_div2" class="chart"></div>';      
  }else{
      echo '<p>There are currently no processed payroll</p>';
  }  
?>
    </div>
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

    
    
    
document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
var d = new Date(),
    minutes = d.getMinutes().toString().length == 1 ? '0'+d.getMinutes() : d.getMinutes(),
    hours = d.getHours().toString().length == 1 ? '0'+d.getHours() : d.getHours(),
    ampm = d.getHours() >= 12 ? 'pm' : 'am',
    months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
return days[d.getDay()]+' , '+months[d.getMonth()]+' '+d.getDate()+' , '+d.getFullYear()+' - '+hours+':'+minutes+ampm;
}    
    
    
</script>
</body>
</html>