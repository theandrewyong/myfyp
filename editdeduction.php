<?php
	session_start();
	include "conn.php";
	if(empty($_SESSION["username"])){
		header("location:index.php");
	}

	$username = $_SESSION["username"];
	$deduction_id = $_GET["id"];
	$error = FALSE;
	$error_deduction_id = "";
	$error_deduction_desc = "";
	$error_deduction_rate = "";

	if(isset($_POST["submit"])){
		$edited_deduction_display_id = $_POST["edited_id"];
		$edited_deduction_desc = $_POST["edited_desc"];
		$edited_deduction_rate = $_POST["edited_rate"];

		if(empty($edited_deduction_display_id)){
			$error_deduction_id = '<span class="text-danger"> *Invalid Deduction ID</span>'; //If deduction ID is empty return Invalid message and error boolean is TRUE
			$error = TRUE;
		}

		if(empty($edited_deduction_desc)){
		   $error_deduction_desc = '<span class="text-danger"> *Invalid Deduction Description</span>'; //If deduction password is empty return Invalid message and error boolean is TRUE
		   $error = TRUE; 
		}

		if(empty($edited_deduction_rate)){
			$error_deduction_rate = '<span class="text-danger"> *Invalid Deduction Rate</span>'; //If deduction rate is empty return Invalid message and error boolean is TRUE
			$error = TRUE;
		}

		if($error == FALSE){
			//If all fields are valid and error boolean is FALSE, update the deduction details
			mysqli_query($conn, "UPDATE deduction SET deduction_display_id = '$edited_deduction_display_id', deduction_desc = '$edited_deduction_desc', deduction_rate = '$edited_deduction_rate' WHERE deduction_id = '$deduction_id'");
			echo "<script>alert('Updated Successfully!');document.location='maintainemployee.php'</script>";
		}    
	}

	$show_sql = mysqli_query($conn, "SELECT * FROM deduction WHERE deduction_id = '$deduction_id'");
	$show_data = mysqli_fetch_assoc($show_sql);
	$deduction_display_id = $show_data["deduction_display_id"]; //Get deduction ID
	$deduction_desc = $show_data["deduction_desc"]; //Get deduction description
	$deduction_rate = $show_data["deduction_rate"]; //Get deduction rate
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Edit Deduction</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4"><a href="maintainemployee.php" class="btn btn-primary">Back</a> Edit Deduction</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
				<form action="editdeduction.php?id=<?php echo $deduction_id; ?>" method="post">
					<p>Deduction ID <?php echo $error_deduction_id; ?>
						<input type="text" name="edited_id" value="<?php echo $deduction_display_id; ?>" class="form-control">
					</p>
					<p>Deduction Desc <?php echo $error_deduction_desc; ?>
						<input type="text" name="edited_desc" value="<?php echo $deduction_desc; ?>" class="form-control">
					</p>
					<p>Deduction Rate <?php echo $error_deduction_rate; ?>
						<input type="text" name="edited_rate" value="<?php echo $deduction_rate; ?>" class="form-control">
					</p>
					<input type="submit" name="submit" class="btn btn-primary">
				</form>
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