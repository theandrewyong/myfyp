<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
//Get month
$current_month = date("m"); 

//For previous month function
if($current_month != 1){
    //Set previous month from current month -1
    $previous_month = $current_month - 1;

}else{
    //If current month is 1, January
    $previous_month = 1;
}

//Get year
$get_year = date("Y"); 

if(isset($_POST["submit_year"])){
    $get_year = $_POST["select_year"];
}

//Data for chart 1
$query1 = "SELECT process_payroll_net_pay, process_payroll_process_month, SUM(process_payroll_net_pay) as number FROM process_payroll WHERE process_payroll_process_year = '$get_year' GROUP BY process_payroll_process_month";  
$result1 = mysqli_query($conn, $query1); //chart 1

//Data for chart 2
$query2 = "SELECT process_payroll_net_pay, emp_display_id, SUM(process_payroll_net_pay) as number FROM process_payroll WHERE process_payroll_process_year = '$get_year' GROUP BY emp_display_id";  
$result2 = mysqli_query($conn, $query2); //chart 2


$all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");
$to_process_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$previous_month' AND process_payroll_process_year = '$get_year'");

//If data is not empty, employee data into array
if(mysqli_num_rows($all_employee_sql) != 0){

    while($all_emp_data = mysqli_fetch_assoc($all_employee_sql)){
        //Put data to array
        $emp_array[] = $all_emp_data["emp_id"]; 
        
    }
}else{
    //If no, array is empty
    $emp_array[] = ""; 
    
}
//If process payroll data is not empty
if(mysqli_num_rows($to_process_sql) != 0){

    while( $compare_data = mysqli_fetch_assoc($to_process_sql)){
        //Put data to array
        $process_array[] = $compare_data["emp_id"]; 
        
    }
}else{
    //If no, array is empty
    $process_array[] = ""; 
}
//Do comparison from both array
$show_table_data = array_diff($emp_array, $process_array); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Dashboard</title>
<?php include "all_css.php"; ?>
<style>
/* Chart css */
.chart {
    width: 100%; 
    min-height: 450px;
    overflow: hidden;
}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
<script type="text/javascript">  
//Chart 1
//Load visualization from google chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart1);
//Chart 1 function
function drawChart1() {
    var data = google.visualization.arrayToDataTable([  
    ['Month', 'Net Pay'],  
    <?php  
        //Get data from database to put in google charts
        while($row = mysqli_fetch_array($result1)){  
            echo "['".date("M", mktime(0, 0, 0, $row["process_payroll_process_month"], 10))."', ".$row["number"]."],";  
        }      
    ?>  
    ]); 
    //Charts options
    var options = {
        title: 'Total NetPay(NP) by Month',
        colors: ['#e0440e', '#e6693e'],
        hAxis: {title: 'Month', titleTextStyle: {color: '#333'}}
    };
    //Execute Chart
    var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
    chart.draw(data, options);
}

//Chart 2
//Load visualization from google chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart2);
//Chart 2 function
function drawChart2() {
    var data = google.visualization.arrayToDataTable([  
    ['Employee', 'Net Pay'], 
    <?php  
        //Get data from database to put in google charts
        while($row = mysqli_fetch_array($result2)){  
            echo "['".$row["emp_display_id"]."', ".$row["number"]."],";  
        }  
    ?>  
    ]); 
    //Charts options
    var options = {
        title: 'Total Net Pay(NP) by Employee',
        colors: ['#e0440e', '#e6693e'],
        hAxis: {title: 'Employee ID', titleTextStyle: {color: '#333'}}
    };
    //Execute Chart
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
}
//Chart resize on different screen size
$(window).resize(function(){
    drawChart1();
    drawChart2();
});
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
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Process Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //Foreach individual array after comparison
                foreach($emp_array as $ea){
                    
                    //Get all data from both table
                    $find_done = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll.process_payroll_process_month = '$previous_month' AND process_payroll.process_payroll_process_year = '$get_year' AND process_payroll.emp_id = '$ea'");
                    $find_done_result = mysqli_fetch_assoc($find_done);
                    //Find the id
                    $fdr_id = $find_done_result["emp_id"];
                    //Check with employee info table
                    $gr = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$ea'");
                    $gr_result = mysqli_fetch_assoc($gr);
                    //Get data into variables
                    $gr_id = $gr_result["emp_id"];
                    $gr_disp = $gr_result["emp_display_id"];
                    $gr_name = $gr_result["emp_full_name"];
                    echo '<tr>';
                    echo '<td>' . $gr_disp . '</td>';
                    echo '<td>' . $gr_name . '</td>';
                    //If processing id exists and employee exists
                    if($gr_id == $fdr_id){ 
                        echo '<td style="color:green;">' . 'Processed' . '</td>'; 
                    }else{
                        echo '<td style="color:red;">' . 'Not Processed' . '</td>';
                    }
                    echo '</tr>';                            
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
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                //Get adhoc pending data
                                $adhoc_pending_sql = "SELECT adhoc_pending.*, employee_info.* FROM adhoc_pending INNER JOIN employee_info ON adhoc_pending.emp_id = employee_info.emp_id WHERE adhoc_status = 'PENDING'";
                                $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $adhoc_pending_sql);
                                mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
                                $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 
                                //If result is more than 0
                                if($epf_result->num_rows > 0) { 
                                    //If result is true
                                    while ($data = $epf_result->fetch_assoc()) {
                                        //Declare variables from results
                                        $adhoc_id = $data["adhoc_id"];
                                        $delete_adhoc_id = $data["adhoc_id"];
                                        echo '<tr>';
                                        echo '<td>' . $data["emp_display_id"] . '</td>';
                                        echo '<td>' . $data["emp_full_name"] . '</td>';
                                        echo '<td>' . $data["adhoc_type"] . '</td>';
                                        echo '<td>' . $data["adhoc_amt"] . '</td>';
                                        //If data results is pending
                                        if( $data["adhoc_status"] == 'PENDING'){
                                            //Show red color status
                                            echo '<td style="color:red;">' . $data["adhoc_status"] . '</td>';
                                        }else{
                                            //Show green color status
                                            echo '<td style="color:green;">' . $data["adhoc_status"] . '</td>';
                                        }
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
                        //Show chart 1 data
                        $process_payroll_sql = mysqli_query($conn, "SELECT * FROM process_payroll");
                        if($pp_result = mysqli_num_rows($process_payroll_sql) > 0){
                            //Show chart if data exists
                            echo '<div id="chart_div1" class="chart"></div>'; 
                            
                        }else{
                            //Dont show chart if not data exists
                            echo '<p>There are currently no processed payroll</p>';
                        }  
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-3">
                        <p><b>Total Net Pay(NP) by Employee</b></p><hr>
                        <?php
                        //show chart 2 data
                        $process_payroll_sql = mysqli_query($conn, "SELECT * FROM process_payroll");
                        if($pp_result = mysqli_num_rows($process_payroll_sql) > 0){
                            //Show chart if data exists
                            echo '<div id="chart_div2" class="chart"></div>';      
                        }else{
                            //Dont show chart if not data exists
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
    
//Format date numbers to words
document.getElementById("para1").innerHTML = formatAMPM();

function formatAMPM() {
//Declare date
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