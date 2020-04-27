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
<title>Payroll Software - Add Employee</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
<div id="page-content-wrapper">
<?php include "navbar.php"; ?>
<div class="container-fluid">
<h1 class="mt-4">Add Allowance Item</h1>
<hr>
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
									$allowance_desc = $_POST["allowance_desc"];
									$allowance_rate = $_POST["allowance_rate"];

									$new_allowance_sql = "INSERT INTO allowance (allowance_desc, allowance_rate) VALUES (?,?)";

									$prepared_stmt_insert = mysqli_prepare($conn, $new_allowance_sql);

									mysqli_stmt_bind_param($prepared_stmt_insert, 'ss', $allowance_desc, $allowance_rate);


									mysqli_stmt_execute($prepared_stmt_insert);
									mysqli_stmt_close($prepared_stmt_insert);
									}
									?>
								
								<form class="form-horizontal" role="form" method="post">
									<div class="p-5 bg-white rounded shadow mb-5">
									
									<div class="form-group">
										<label for="allowance_desc" class="col-sm-3 control-label"><h6>Item Description</h6></label>
										<div class="col-sm-9">
											<input type="text" id="allowance_desc" name="allowance_desc" placeholder="Description Example: Petrol" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="allowance_rate" class="col-sm-5 control-label"><h6>Rate of Item (RM)</h6></label>
										<div class="col-sm-9">
											<input type="number" id="allowance_rate" name="allowance_rate" step=".01" placeholder="Rate Example: 100" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn-block" name="submit">Add Item</button>
									</div>
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
