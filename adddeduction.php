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

<title>Payroll Software - Add Employee</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">
<link href="css/addemployee_button.css" rel="stylesheet">

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
<h1 class="mt-4">Add Deduction Item</h1>
<hr>
<!-- dashboard conten here -->
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <br>

			<div id="tabsJustifiedContent" class="tab-content">
				
                <div id="profile1" class="tab-pane fade active show">
                    <div class="row pb-2">
                        <div class="col-md-12">
							<div class="container">
								
								<?php
									if(isset($_POST["submit"])){
										//get input data
									$deduction_desc = $_POST["deduction_desc"];
									$deduction_rate = $_POST["deduction_rate"];

									$new_deduction_sql = "INSERT INTO deduction (deduction_desc, deduction_rate) VALUES (?,?)";

									$prepared_stmt_insert = mysqli_prepare($conn, $new_deduction_sql);

									mysqli_stmt_bind_param($prepared_stmt_insert, 'ss', $deduction_desc, $deduction_rate);


									mysqli_stmt_execute($prepared_stmt_insert);
									mysqli_stmt_close($prepared_stmt_insert);
									}
									?>
								
								<form class="form-horizontal" role="form" method="post">
									
									
									<div class="form-group">
										<label for="deduction_desc" class="col-sm-3 control-label"><h6>Item Description</h6></label>
										<div class="col-sm-9">
											<input type="text" id="deduction_desc" name="deduction_desc" placeholder="Description Example: Advance" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="deduction_rate" class="col-sm-5 control-label"><h6>Rate of Item (RM)</h6></label>
										<div class="col-sm-9">
											<input type="number" id="deduction_rate" name="deduction_rate" step=".01" placeholder="Rate Example: 100" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn-block" name="submit">Add Item</button>
									</div>
									
								</form> <!-- /form -->
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
