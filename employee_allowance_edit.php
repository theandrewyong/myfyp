<?php
    session_start();
	include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];

	//Get employee ID and allowance ID from previous page
	$get_emp_allowance_id = $_GET["emp_allowance_id"];
	$get_emp_id = $_GET["emp_id"];
?>

<?php
	$error = FALSE;
	$error_rate =''; 

	if(isset($_POST["submit"])){
    	$allowance_rate = $_POST["allowance_rate"];
		
		//If allowance rate is empty or 0 value, warning message will be shown
		if(empty($allowance_rate) || $allowance_rate == 0 || $allowance_rate == 0.00) {
			$error_rate = '<label class="text-danger">Error: Rate should NOT be 0.00</label>';
			$error = TRUE;
		}
		
		//If error is false, allows webiste to update data to employee_allowance table
		if($error == FALSE){
			$update_sql = mysqli_query($conn, "UPDATE employee_allowance SET allowance_rate='$allowance_rate' WHERE emp_allowance_id ='$get_emp_allowance_id'");
		}
  }

  //show all existing value in all input fields
    $show_sql = mysqli_query($conn, "SELECT * FROM employee_allowance WHERE emp_allowance_id = '$get_emp_allowance_id'");
    $show_data = mysqli_fetch_assoc($show_sql);
    $show_allowance_id = $show_data['allowance_id'];
    $show_allowance_desc = $show_data['allowance_desc'];
    $show_allowance_rate = $show_data['allowance_rate'];
?>
								
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Edit Allowance</title>
<?php include "all_css.php"; ?>
</head>

<body>
<div class="d-flex" id="wrapper">
<!-- Sidebar -->
<?php include "sidebar.php"; ?>
<!-- /#sidebar-wrapper -->
	<!-- Page Content -->
	<div id="page-content-wrapper">
	<?php include "navbar.php"; ?> 
		<div class="container-fluid">
		<!-- dashboard conten here --><br>
		<h1><a href="editemployee.php?emp_id=<?php echo $get_emp_id; ?>" class="btn btn-primary">Back</a> Edit Allowance</h1>
			<div class="row">
				<div class="col-md-12">
					<form method="POST">
						<div class="p-3 bg-white rounded shadow mb-2">
							<div class="form-group">
								<label for="allowance_desc" class="col-md-12 control-label"><h6>Allowance Desc</h6></label>
								<div class="col-md-12">
									<input type="text" id="allowance_desc" name="allowance_desc" class="form-control" value="<?php echo $show_allowance_desc; ?>" disabled>
								</div>
							</div>

							<div class="form-group">
								<label for="allowance_rate" class="col-md-12 control-label"><h6>Allowance Rate <?php echo $error_rate ?></h6></label>
								<div class="col-md-12">
									<input type="text" id="allowance_rate" placeholder="Email" class="form-control" name= "allowance_rate" value="<?php echo $show_allowance_rate; ?>">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Edit Item">
								</div>
							</div>
						</div>
						<?php
							$table_sql = mysqli_query($conn, "SELECT * FROM employee_allowance WHERE emp_id = $get_emp_id");		
							$allowance_total = 0;

							if($datarows = mysqli_num_rows($table_sql) > 0){
								while($data = mysqli_fetch_assoc($table_sql)){
									$allowance_rate = $data["allowance_rate"];
									$allowance_total = $allowance_total + $allowance_rate;
								}
							}
							$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_allowance='$allowance_total' WHERE emp_id ='$get_emp_id'");
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /#page-content-wrapper -->
</div>	

<!-- /#wrapper -->
<!-- footer here -->
<?php include "footer.php"; ?>   
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
	$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
	});
</script>
	
</body>
</html>
