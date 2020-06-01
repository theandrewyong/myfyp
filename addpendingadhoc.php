<?php
session_start();
include "conn.php";
    if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

//while loop select option
$select_all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");


if(isset($_POST["submit"])){
    $get_adhoc_emp_name = $_POST["adhoc_emp_name"];
    $adhoc_type = $_POST["adhoc_type"];
    $adhoc_wages = $_POST["adhoc_wages"];
	$adhoc_bonus = $_POST["adhoc_bonus"];
	$adhoc_allowance = $_POST["adhoc_allowance"];
	$adhoc_commission = $_POST["adhoc_commission"];
	$adhoc_claims = $_POST["adhoc_claims"];
	$adhoc_unpaid_leave = $_POST["adhoc_unpaid_leave"];
	$adhoc_others = $_POST["adhoc_others"];
    $get_adhoc_amt = $_POST["adhoc_amt"];
    //get emp id where name is
    $get_id_sql = mysqli_query($conn, "SELECT emp_id FROM employee_info WHERE emp_full_name = '$get_adhoc_emp_name'");
    $id_result = mysqli_fetch_assoc($get_id_sql);
    $get_adhoc_emp_id = $id_result["emp_id"];
    $get_adhoc_status = "PENDING";
    mysqli_query($conn, "INSERT INTO adhoc_pending (emp_id, emp_full_name, adhoc_type, adhoc_wages, adhoc_bonus, adhoc_allowance, adhoc_commission, adhoc_claims, adhoc_unpaid_leave, adhoc_others, adhoc_amt, adhoc_status) VALUES ('$get_adhoc_emp_id','$get_adhoc_emp_name','$adhoc_type','$adhoc_wages', '$adhoc_bonus', '$adhoc_allowance', '$adhoc_commission', '$adhoc_claims', '$adhoc_unpaid_leave', '$adhoc_others','$get_adhoc_amt','$get_adhoc_status')");
    
    header("location:newadhoc.php");
}

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
            <h1 class="mt-4"><a href="newadhoc.php" class="btn btn-primary">Back</a> Add New AdHoc</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">    
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                
                <div class="form-group">
                    <label>Employee Name</label>
                    <select id="" class="form-control" name="adhoc_emp_name">
                        <option>Select Employee</option>
                        <?php
                        while($select_all_employee_result = mysqli_fetch_assoc($select_all_employee_sql)){
                            echo '<option>';
                            echo $select_all_employee_result["emp_full_name"];
                            echo '</option>';
                        }
                            
                        ?>
                    </select>
                </div>
                
				<label>Adhoc Type</label>
				<div class="form-group">
					<input type="text" class="form-control" name="adhoc_type">
                </div>
                
				<label>Adhoc Description</label>
                <div class="form-group">
                    
					<input type="hidden" class="checkbox-inline" name="adhoc_wages" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_wages" name="adhoc_wages" value="1">
					<label for="adhoc_wages">Wages</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_bonus" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_bonus" name="adhoc_bonus" value="1">
					<label for="adhoc_bonus">Bonus</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_allowance" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_allowance" name="adhoc_allowance" value="1">
					<label for="adhoc_allowance">Allowance</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_commission" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_commission" name="adhoc_commission" value="1">
					<label for="adhoc_commission">Commission</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_claims" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_claims" name="adhoc_claims" value="1">
					<label for="adhoc_claims">Claims</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_unpaid_leave" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_unpaid_leave" name="adhoc_unpaid_leave" value="1">
					<label for="adhoc_unpaid_leave">Unpaid Leave</label><br/>
					
					<input type="hidden" class="checkbox-inline" name="adhoc_others" value="0">
                    <input type="checkbox" class="checkbox-inline" id="adhoc_others" name="adhoc_others" value="1">
					<label for="adhoc_others">Others</label>
					
                </div>
				
                <div class="form-group">
                    <label for="pwd">Amount</label>
                    <input type="number" class="form-control" name="adhoc_amt">
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