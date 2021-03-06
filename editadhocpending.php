<?php
	session_start();
	include "conn.php";
	if(empty($_SESSION["username"])){
	header("location:index.php");
	}

	$username = $_SESSION["username"];
	$get_adhoc_id = $_GET["adhoc_id"];

	if(isset($_POST["submit"])){
		// Assign variables
		$adhoc_wages = $_POST["adhoc_wages"];
		$adhoc_bonus = $_POST["adhoc_bonus"];
		$adhoc_allowance = $_POST["adhoc_allowance"];
		$adhoc_commission = $_POST["adhoc_commission"];
		$adhoc_claims = $_POST["adhoc_claims"];
		$adhoc_unpaid_leave = $_POST["adhoc_unpaid_leave"];
		$adhoc_others = $_POST["adhoc_others"];
		$adhoc_amt = $_POST["adhoc_amt"];

		mysqli_query($conn, "UPDATE adhoc_pending SET adhoc_wages = '$adhoc_wages', adhoc_bonus = '$adhoc_bonus', adhoc_allowance = '$adhoc_allowance', adhoc_commission = '$adhoc_commission', adhoc_claims = '$adhoc_claims', adhoc_unpaid_leave = '$adhoc_unpaid_leave', adhoc_others = '$adhoc_others', adhoc_amt = '$adhoc_amt' WHERE adhoc_id = '$get_adhoc_id'");
		header("location:newadhoc.php");
	}

	//Select all existing adhoc pending
	$select_all_sql = mysqli_query($conn, "SELECT * FROM adhoc_pending WHERE adhoc_id = '$get_adhoc_id'");
	$specific_result = mysqli_fetch_assoc($select_all_sql);

	$s_name = $specific_result["emp_full_name"]; //Get Employee Name
	$s_wages = $specific_result["adhoc_wages"]; //Get Wages
	$s_bonus = $specific_result["adhoc_bonus"]; //Get Bonus
	$s_allowance = $specific_result["adhoc_allowance"]; //Get Sllowance
	$s_commission = $specific_result["adhoc_commission"];  //Get Commission
	$s_claims = $specific_result["adhoc_claims"]; //Get Claims
	$s_unpaid_leave = $specific_result["adhoc_unpaid_leave"]; //Get Unpaid Leave
	$s_others = $specific_result["adhoc_others"]; //Get Others
	$s_amt = $specific_result["adhoc_amt"]; //Get adhoc Amount
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Add New AdHoc</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
	<div id="page-content-wrapper">
	<?php include "navbar.php"; ?>
		<div class="container-fluid">
		<h1 class="mt-4">Edit AdHoc Employee info</h1>
		<hr>
			<div class="p-3 bg-white rounded shadow mb-5">    
			<form action="editadhocpending.php?adhoc_id=<?php echo $get_adhoc_id; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
				<div class="form-group">
					<label>Employee Name</label>
					<select id="" class="form-control" name="adhoc_emp_name" disabled>
						<option><?php echo $s_name; ?></option>
					</select>
				</div>
				<div class="form-group">
					<label>Adhoc Type</label>
				</div>

				<div class="form-group">
					<input type="hidden" class="checkbox-inline" name="adhoc_wages" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_wages" name="adhoc_wages" value="1" <?php if($s_wages){echo "checked";}?>>
					<label for="adhoc_wages">Wages</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_bonus" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_bonus" name="adhoc_bonus" value="1" <?php if($s_bonus){echo "checked";}?>>
					<label for="adhoc_bonus">Bonus</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_allowance" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_allowance" name="adhoc_allowance" value="1" <?php if($s_allowance){echo "checked";}?>>
					<label for="adhoc_allowance">Allowance</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_commission" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_commission" name="adhoc_commission" value="1" <?php if($s_commission){echo "checked";}?>>
					<label for="adhoc_commission">Commission</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_claims" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_claims" name="adhoc_claims" value="1" <?php if($s_claims){echo "checked";}?>>
					<label for="adhoc_claims">Claims</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_unpaid_leave" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_unpaid_leave" name="adhoc_unpaid_leave" value="1" <?php if($s_unpaid_leave){echo "checked";}?>>
					<label for="adhoc_unpaid_leave">Unpaid Leave</label><br/>

					<input type="hidden" class="checkbox-inline" name="adhoc_others" value="0">
					<input type="checkbox" class="checkbox-inline" id="adhoc_others" name="adhoc_others" value="1" <?php if($s_others){echo "checked";}?>>
					<label for="adhoc_others">Others</label>
				</div>
				<div class="form-group">
					<label for="pwd">Amount</label>
					<input type="text" class="form-control" name="adhoc_amt" value="<?php echo $s_amt; ?>">
				</div>                
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
			</div>
		</div>
	</div>
</div>
	
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	
<script>
	$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
	});

	$(document).ready( function() {
	$('#example').dataTable( {
	language: {
	search: "",
	"lengthMenu": "_MENU_",
	searchPlaceholder: "Search records"
	},
	"sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
	} );
	} );    

</script>
</body>
	
</html>