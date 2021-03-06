<?php
session_start();
include "conn.php";

if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];
?>

<?php
$month = (int)date("m");
$year = date("Y");
$view_table = FALSE;

if(isset($_POST["submit"])){

	$month = $_POST["month"];
	$year = $_POST["year"]; 

	//Select employee data from employee_info table and payroll data from porcess_payroll table
	$select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$month' AND process_payroll_process_year = '$year'"); 

	//Validation to check if searched data exist
	$validate = mysqli_query($conn, "SELECT * FROM process_payroll");
	while($validation = mysqli_fetch_assoc($validate)){
		if ($validation["process_payroll_process_month"]==$month && $validation["process_payroll_process_year"]==$year){
			$view_table = TRUE;
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - EIS Report</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4"><a href="reports.php" class="btn btn-primary">Back</a> EIS Report</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-5">
                    <form action="eis_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <input type="number" class="form-control" id="month" name="month" value="<?php echo $month; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" id="year" name="year" value="<?php echo $year; ?>">
                                </div>
                            </div>
                        </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>            
                    </div>        
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <a target="_blank" href="eis_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a>
                    </div>
                </div>
            </div>
            <div class="p-3 bg-white rounded shadow mb-5">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Employee Name</th>
							<th>Employee EIS Amount</th>
							<th>Employer EIS Amount</th>
						</tr>
					</thead>
                    <tbody>
						<?php
							$total_eis_employee_deduction = 0;
							$total_eis_employer_deduction = 0;
							if($view_table){
								while($select_result = mysqli_fetch_assoc($select_sql)){
									$eis_employee_deduction = $select_result["eis_employee_deduction"];
									$eis_employer_deduction = $select_result["eis_employer_deduction"];
									echo '<tr>';
									echo '<td>' . $select_result["emp_full_name"] . '</td>';
									echo '<td>' . $eis_employee_deduction . '</td>';
									echo '<td>' . $eis_employer_deduction . '</td>';
									echo '</tr>'; 
									$total_eis_employee_deduction = $total_eis_employee_deduction + $eis_employee_deduction;
									$format_total_eis_employee_deduction = number_format("$total_eis_employee_deduction",2);

									$total_eis_employer_deduction = $total_eis_employer_deduction + $eis_employer_deduction;
									$format_total_eis_employer_deduction = number_format("$total_eis_employer_deduction",2);
								}                    
							}
						?> 
						<tr>
						<td><b>Total</b></td>
						<td><b><?php if($total_eis_employee_deduction != 0){echo $format_total_eis_employee_deduction;}?></b></td>
						<td><b><?php if($total_eis_employer_deduction != 0){echo $format_total_eis_employer_deduction;}?></b></td>
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