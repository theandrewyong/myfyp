<?php
    session_start();
	include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];

	$get_emp_deduction_id = $_GET["emp_deduction_id"];
	$get_emp_id = $_GET["emp_id"];
	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Payroll Software - Edit Deduction</title>

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
<!-- dashboard conten here -->
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">

			<div id="tabsJustifiedContent" class="tab-content">
				
                <div id="profile1" class="tab-pane fade active show">
                    <div class="row pb-2">
                        <div class="col-md-12">
							<div class="container">
								
								<?php
								  if(isset($_POST["submit"])){
									  
									$deduction_rate = $_POST["deduction_rate"];

									  $update_sql = mysqli_query($conn, "UPDATE employee_deduction SET deduction_rate='$deduction_rate' WHERE emp_deduction_id ='$get_emp_deduction_id'");

								  }
								
								  //show all existing value in all input fields
									$show_sql = mysqli_query($conn, "SELECT * FROM employee_deduction WHERE emp_deduction_id = '$get_emp_deduction_id'");
									$show_data = mysqli_fetch_assoc($show_sql);
									$show_deduction_id = $show_data['deduction_id'];
									$show_deduction_desc = $show_data['deduction_desc'];
									$show_deduction_rate = $show_data['deduction_rate'];
								  ?>
								
								<form method="POST">
									<a id="employee_section"><h1>Edit Deduction</h1></a>
									
										<div class="form-group">
										<label for="deduction_desc" class="col-sm-3 control-label"><h6>Deduction Desc</h6></label>
										<div class="col-sm-9">
											<input type="text" id="deduction_desc" name="deduction_desc" class="form-control" value="<?php echo $show_deduction_desc; ?>" disabled>
										</div>
										</div>
									
									<div class="form-group">
										<label for="deduction_rate" class="col-sm-3 control-label"><h6>Deduction Rate</h6></label>
										<div class="col-sm-9">
											<input type="text" id="deduction_rate" placeholder="Email" class="form-control" name= "deduction_rate" value="<?php echo $show_deduction_rate; ?>">
										</div>
									</div>
									
									<div class="container"><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Edit Item"> </div>
									
									<?php
											$table_sql = mysqli_query($conn, "SELECT * FROM employee_deduction WHERE emp_id = $get_emp_id");		
											$deduction_total = 0;
											
											if($datarows = mysqli_num_rows($table_sql) > 0){
                    						while($data = mysqli_fetch_assoc($table_sql)){
											$deduction_rate = $data["deduction_rate"];
											$deduction_total = $deduction_total + $deduction_rate;
											
											}}
												
											$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_deduction='$deduction_total' WHERE emp_id ='$get_emp_id'");
											?>
									
								  </form>
							</div>
						</div>
					</div>
                </div>				
            </div>
        </div>
	</div>
	
</section>
    
    
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
