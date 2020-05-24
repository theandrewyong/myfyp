<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Yearly Wages Report</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Yearly Wages Report</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <form action="yearly_wages_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Year</label>
                                        <input type="text" class="form-control" id="year" name="year" value="<?php echo date("Y"); ?>">
                                    </div>
                                </div>
                            </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>            
                    </div>        
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-5">           
                    <?php
                    $month = "";
                    $year = "";
                    $view_table = FALSE;
						
                    if(isset($_POST["submit"])){
                        $year = $_POST["year"]; 
                        $select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_year = '$year'"); 
						
						//validate
						$validate = mysqli_query($conn, "SELECT * FROM process_payroll");
						while($validation = mysqli_fetch_assoc($validate)){
							if ($validation["process_payroll_process_year"]==$year){
								$view_table = TRUE;
							}
						}
                    }
                    $select_all_processed_payroll = mysqli_query($conn, "SELECT * FROM process_payroll");
                    while($select_result = mysqli_fetch_assoc($select_all_processed_payroll)){
                        $specific_month = $select_result["process_payroll_process_month"];
                        $specific_year = $select_result["process_payroll_process_year"];
                        $specific_month_array[] = $specific_month;
                        $specific_year_array[] = $specific_year;                    
                    }
                    $unique_month_array = array_unique($specific_month_array);
                    $unique_year_array = array_unique($specific_year_array);                
                    ?>
                    <p><a target="_blank" href="yearly_wages_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a></p>
                    </div>
                </div>
            </div>
            <div class="p-3 bg-white rounded shadow mb-5">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>January</th>
                                <th>Febuary</th>
                                <th>March</th>
                                <th>April</th>
                                <th>May</th>
                                <th>June</th>
                                <th>July</th>
                                <th>August</th>
                                <th>September</th>
                                <th>October</th>
                                <th>November</th>
                                <th>December</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                            if(isset($_POST["submit"])){
                            $year = $_POST["year"];
                            $count_employee_by_year_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_year = '$year'");
							$unique_employee[] ='';
                            while($result = mysqli_fetch_assoc($count_employee_by_year_sql)){
                            $employee_id_array[] = $result["emp_id"];
                            $unique_employee = array_unique($employee_id_array);
                            }
								
                            $countJan = 0;
                            $countFeb = 0;
                            $countMar = 0;
                            $countApr = 0;
                            $countMay = 0;
                            $countJun = 0;
                            $countJul = 0;
                            $countAug = 0;
                            $countSep = 0;
                            $countOct = 0;
                            $countNov = 0;
                            $countDec = 0;
							
							if(count($unique_employee)>0){
							
                            foreach($unique_employee as $ua){
                            echo '<tr>';
								
							$name_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$ua'");
							$result = mysqli_fetch_assoc($name_sql);
                            echo '<td>' . $result["emp_full_name"] . '</td>';
								
                            for($i=1;$i<=12;$i++){
                            $each_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll.emp_id = '$ua' AND process_payroll_process_month = '$i'");

                            $esresult = mysqli_fetch_assoc($each_sql);                            
                            if($i == 1){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countJan = $countJan + $esresult["process_payroll_wage"];
							$format_countJan = number_format("$countJan",2);
                            }
                            if($i == 2){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countFeb = $countFeb + $esresult["process_payroll_wage"];
							$format_countFeb = number_format("$countFeb",2);
                            }
                            if($i == 3){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countMar = $countMar + $esresult["process_payroll_wage"];
							$format_countMar = number_format("$countMar",2);
                            }
                            if($i == 4){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countApr = $countApr + $esresult["process_payroll_wage"];
							$format_countApr = number_format("$countApr",2);
                            }
                            if($i == 5){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countMay = $countMay + $esresult["process_payroll_wage"];
							$format_countMay = number_format("$countMay",2);
                            }
                            if($i == 6){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countJun = $countJun + $esresult["process_payroll_wage"];
							$format_countJun = number_format("$countJun",2);
                            }
                            if($i == 7){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countJul = $countJul + $esresult["process_payroll_wage"];
							$format_countJul = number_format("$countJul",2);
                            }
                            if($i == 8){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countAug = $countAug + $esresult["process_payroll_wage"];
							$format_countAug = number_format("$countAug",2);
                            }
                            if($i == 9){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countSep = $countSep + $esresult["process_payroll_wage"];
							$format_countSep = number_format("$countSep",2);
                            }
                            if($i == 10){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countOct = $countOct + $esresult["process_payroll_wage"];
							$format_countOct = number_format("$countOct",2);
                            }
                            if($i == 11){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countNov = $countNov + $esresult["process_payroll_wage"];
							$format_countNov = number_format("$countNov",2);
                            }
                            if($i == 12){
                            echo '<td>' . $esresult["process_payroll_wage"] . '</td>';
                            $countDec = $countDec + $esresult["process_payroll_wage"];
							$format_countDec = number_format("$countDec",2);
                            }                                                  
                            }                        
                            echo '</tr>';
                            }
							}
                            //show all employee that existed in the year
                            echo '<tr>';
                            echo '<td><b>' . "Total" . '</b></td>';
                            for($x=1;$x<=12;$x++){
                            if($x == 1){
                            echo '<td><b>' . $format_countJan . '</b></td>';
                            }
                            if($x == 2){
                            echo '<td><b>' . $format_countFeb . '</b></td>';
                            }
                            if($x == 3){
                            echo '<td><b>' . $format_countMar . '</b></td>';
                            }
                            if($x == 4){
                            echo '<td><b>' . $format_countApr . '</b></td>';
                            }
                            if($x == 5){
                            echo '<td><b>' . $format_countMay . '</b></td>';
                            }
                            if($x == 6){
                            echo '<td><b>' . $format_countJun . '</b></td>';
                            }
                            if($x == 7){
                            echo '<td><b>' . $format_countJul . '</b></td>';
                            }
                            if($x == 8){
                            echo '<td><b>' . $format_countAug . '</b></td>';
                            }
                            if($x == 9){
                            echo '<td><b>' . $format_countSep . '</b></td>';
                            }
                            if($x == 10){
                            echo '<td><b>' . $format_countOct . '</b></td>';
                            }
                            if($x == 11){
                            echo '<td><b>' . $format_countNov . '</b></td>';
                            }
                            if($x == 12){
                            echo '<td><b>' . $format_countDec . '</b></td>';
                            }                        

                            }
                            echo '</tr>';
                            }
                            ?>
                            </tr>
                        </tbody>
                    </table>
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
</script>
</body>
</html>