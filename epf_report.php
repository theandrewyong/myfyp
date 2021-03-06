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
<title>Payroll Software - EPF Report</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
	<div id="page-content-wrapper">
	<?php include "navbar.php"; ?>
		<div class="container-fluid">
		<h1 class="mt-4"><a href="reports.php" class="btn btn-primary">Back</a> EPF Report</h1>
		<hr>
			<?php
				$month = (int)date("m");
				$year = date("Y");
				$view_table = FALSE;
				$ppresult = FALSE;

				if(isset($_POST["submit"])){
					$month = $_POST["month"];
					$year = $_POST["year"];
					
					//Select data from employee_info table and process_payroll table
					$select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$month' AND process_payroll_process_year = '$year'"); 

					//Select data from employee_info table and process_adhoc table
					$select_adhoc_sql = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_process_month = '$month' AND process_adhoc_process_year = '$year'");

					//Two validations
					$validate = mysqli_query($conn, "SELECT * FROM process_payroll");
					$validate2 = mysqli_query($conn, "SELECT * FROM process_adhoc");

					//Validate if there is any data from process_payroll
					while($validation = mysqli_fetch_assoc($validate)){
						if ($validation["process_payroll_process_month"]==$month && $validation["process_payroll_process_year"]==$year){
							$view_table = TRUE;
						}
					}

					//Validate if there is any data from process_adhoc
					while($validation2 = mysqli_fetch_assoc($validate2)){
						if ($validation2["process_adhoc_process_month"]==$month && $validation2["process_adhoc_process_year"]==$year){
							$view_table = TRUE;
						}
					}                            
				}
			?>            
			<div class="row">
				<div class="col-md-6">
					<div class="p-3 bg-white rounded shadow mb-5">
						<form action="epf_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
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
						<p><a target="_blank" href="epf_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a></p>
					</div>
				</div>
			</div>
			<div class="p-3 bg-white rounded shadow mb-5">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered">
						<thead>
							<tr>
							<th>Employee Name</th>
							<th>Employee EPF Amount</th>
							<th>Employer EPF Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_epf_employee_deduction = 0;
								$total_epf_employer_deduction = 0;
							
								if($view_table == TRUE){
									//Result for adhoc only    
									if(mysqli_num_rows($select_sql) == 0){
										while($select_adhoc_result = mysqli_fetch_assoc($select_adhoc_sql)){
											$epf_employee_deduction = $select_adhoc_result["epf_employee_deduction"];
											$epf_employer_deduction = $select_adhoc_result["epf_employer_deduction"];  

											$total_epf_employee_deduction = $total_epf_employee_deduction + $epf_employee_deduction;
											$format_total_epf_employee_deduction = number_format ("$total_epf_employee_deduction",2);

											$total_epf_employer_deduction = $total_epf_employer_deduction + $epf_employer_deduction;
											$format_total_epf_employer_deduction = number_format("$total_epf_employer_deduction",2);                                    

											echo '<tr>';
											echo '<td>' . $select_adhoc_result["emp_full_name"] . '</td>';
											echo '<td>' . $epf_employee_deduction . '</td>';
											echo '<td>' . $epf_employer_deduction . '</td>';
											echo '</tr>';
										}
									}
									
									else{
										//month end + adhoc
										while($select_result = mysqli_fetch_assoc($select_sql)){
											$epf_employee_deduction = $select_result["epf_employee_deduction"];
											$epf_employer_deduction = $select_result["epf_employer_deduction"];
											$pp_emp_id = $select_result["emp_id"];
											
											//get adhoc info
											$select_adhoc_sql = mysqli_query($conn, "SELECT * FROM process_adhoc WHERE process_adhoc_process_month = '$month' AND process_adhoc_process_year = '$year' AND emp_id = '$pp_emp_id'");
											$get_adhoc_result = mysqli_fetch_assoc($select_adhoc_sql);
											$adhoc_epf_employee_deduction = $get_adhoc_result["epf_employee_deduction"];
											$adhoc_epf_employer_deduction = $get_adhoc_result["epf_employer_deduction"];

											$final_epf_employee_deduction = $epf_employee_deduction + $adhoc_epf_employee_deduction;
											$final_epf_employer_deduction = $epf_employer_deduction + $adhoc_epf_employer_deduction;

											echo '<tr>';
											echo '<td>' . $select_result["emp_full_name"] . '</td>';
											echo '<td>' . number_format($final_epf_employee_deduction, 2) . '</td>';
											echo '<td>' . number_format($final_epf_employer_deduction, 2) . '</td>';
											echo '</tr>'; 
											$total_epf_employee_deduction = $total_epf_employee_deduction + $final_epf_employee_deduction;
											$format_total_epf_employee_deduction = number_format ("$total_epf_employee_deduction",2);

											$total_epf_employer_deduction = $total_epf_employer_deduction + $final_epf_employer_deduction;
											$format_total_epf_employer_deduction = number_format("$total_epf_employer_deduction",2);
										}
									}
								}
							?> 
							<tr>
							<td><b>Total</b></td>
							<td><b><?php if($total_epf_employee_deduction != 0){echo $format_total_epf_employee_deduction;}?></b></td>
							<td><b><?php if($total_epf_employer_deduction != 0){echo $format_total_epf_employer_deduction;}?></b></td>
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