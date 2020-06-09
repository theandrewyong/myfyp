<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];
$process_id = $_GET["pid"];

$get_month = $_GET["month"];
$get_year = $_GET["year"];

if(isset($_POST["submit"])){

$new_wages = $_POST["new_adhoc_wages"];
$new_commission = $_POST["new_commission"];
$new_allowance = $_POST["new_allowance"];
$new_claims = $_POST["new_claims"];
$new_bonus = $_POST["new_bonus"];
$new_others = $_POST["new_others"];
$new_unpaid_leave = $_POST["new_unpaid_leave"];
$adhoc_amt = $_POST["adhoc_amt"];
$adhoc_type = $_POST["adhoc_type"];

$new_epf = $adhoc_amt;

$epf_formula_sql = mysqli_query($conn, "SELECT * FROM epf_formula"); 

while($ef = mysqli_fetch_assoc($epf_formula_sql)){
$ef_start = $ef["epf_formula_wage_start"]; 
$ef_end = $ef["epf_formula_wage_end"]; 

if(($new_epf >= $ef_start) && ($new_epf <= $ef_end)){
$epf_employee_deduction = $ef["epf_formula_employee_amt"]; 
$epf_employer_deduction = $ef["epf_formula_employer_amt"]; 
}
}

mysqli_query($conn, "UPDATE process_adhoc SET process_adhoc_type = '$adhoc_type', process_adhoc_wage = '$new_wages', process_adhoc_bonus = '$new_bonus', process_adhoc_allowance = '$new_allowance', process_adhoc_commission = '$new_commission', process_adhoc_claims = '$new_claims', process_adhoc_unpaid_leave = '$new_unpaid_leave', process_adhoc_others = '$new_others', epf_employee_deduction = '$epf_employee_deduction', epf_employer_deduction = '$epf_employer_deduction', adhoc_amt = '$adhoc_amt' WHERE process_adhoc_id = '$process_id'");

//echo $new_unpaid_leave;
}        

$get_all_sql = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_id = '$process_id'");
$get_result = mysqli_fetch_assoc($get_all_sql);
$process_date = $get_result["process_adhoc_process_date"];
$process_from = $get_result["process_adhoc_from"];
$process_to = $get_result["process_adhoc_to"];
$process_month = $get_result["process_adhoc_process_month"];
$process_year = $get_result["process_adhoc_process_year"];
$employee_name = $get_result["emp_full_name"];

$adhoc_type = $get_result["process_adhoc_type"];
$adhoc_wages = $get_result["process_adhoc_wage"];
$adhoc_commission = $get_result["process_adhoc_commission"];
$adhoc_allowance = $get_result["process_adhoc_allowance"];
$adhoc_claims = $get_result["process_adhoc_claims"];
$adhoc_bonus = $get_result["process_adhoc_bonus"];
$adhoc_others = $get_result["process_adhoc_others"];
$employee_epf = $get_result["epf_employee_deduction"];
$adhoc_unpaid_leave = $get_result["process_adhoc_unpaid_leave"];

$employer_epf = $get_result["epf_employer_deduction"];

$adhoc_amt = $get_result["adhoc_amt"];

//echo $adhoc_others;


?>    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Edit History</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
<div id="page-content-wrapper">
<?php include "navbar.php"; ?>
<div class="container-fluid">
<h1 class="mt-4"><a href="historyadhoc.php?month=<?php echo $get_month; ?>&year=<?php echo $get_year; ?>" class="btn btn-primary">Back</a> Edit History</h1>
<hr>
<div class="p-3 bg-white rounded shadow mb-5">
<form action="editadhochistory.php?pid=<?php echo $process_id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
<div class="row">
<div class="col-md-6 col-12">
<div class="p-3 bg-white rounded shadow mb-5">
<p><b>AdHoc information</b></p>
<hr>
<label>Adhoc Type</label>
<div class="form-group">
<input type="text" class="form-control" name="adhoc_type" value="<?php echo $adhoc_type; ?>">
</div>                            
<div class="row">
<div class="col-md-12">
<label>AdHoc Description</label>
<div class="form-check">
<label class="form-check-label" for="new_wages">
<input type="hidden" class="form-check-input" id="new_wages" name="new_adhoc_wages" value="0">
<input type="checkbox" class="form-check-input" id="new_wages" name="new_adhoc_wages" value="1" <?php if($adhoc_wages){echo "checked";}?>>Wages
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_bonus">
<input type="hidden" class="form-check-input" id="new_bonus" name="new_bonus" value="0">
<input type="checkbox" class="form-check-input" id="new_bonus" name="new_bonus" value="1" <?php if($adhoc_bonus){echo "checked";}?>>Bonus
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_allowance">
<input type="hidden" class="form-check-input" id="new_allowance" name="new_allowance" value="0">
<input type="checkbox" class="form-check-input" id="new_allowance" name="new_allowance" value="1" <?php if($adhoc_allowance){echo "checked";}?>>Allowance
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_commission">
<input type="hidden" class="form-check-input" id="new_commission" name="new_commission" value="0">
<input type="checkbox" class="form-check-input" id="new_commission" name="new_commission" value="1" <?php if($adhoc_commission){echo "checked";}?>>Commission
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_claims">
<input type="hidden" class="form-check-input" id="new_claims" name="new_claims" value="0">
<input type="checkbox" class="form-check-input" id="new_claims" name="new_claims" value="1" <?php if($adhoc_claims){echo "checked";}?>>Claims
</label>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_unpaid_leave">
<input type="hidden" class="form-check-input" id="new_unpaid_leave" name="new_unpaid_leave" value="0">
<input type="checkbox" class="form-check-input" id="new_unpaid_leave" name="new_unpaid_leave" value="1" <?php if($adhoc_unpaid_leave){echo "checked";}?>>Unpaid Leave
</label>
</div>
</div>
</div> 
<div class="row">
<div class="col-md-12">
<div class="form-check">
<label class="form-check-label" for="new_others">
<input type="hidden" class="form-check-input" id="new_others" name="new_others" value="0">
<input type="checkbox" class="form-check-input" id="new_others" name="new_others" value="1" <?php if($adhoc_others){echo "checked";}?>>Others
</label>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md-6">
<label for="">AdHoc Amount</label>
<input type="text" class="form-control" name="adhoc_amt" value="<?php echo $adhoc_amt; ?>"> 
</div>
</div>                            
</div>
</div>
<div class="col-md-6 col-12">
<div class="p-3 bg-white rounded shadow mb-5">
<?php echo "<h4><b>" . $employee_name . "</b></h4>"; ?> 
<p class="text-success"><b><?php echo "Month End (" . $process_month . "." . $process_year . ")"; ?></b></p>
</div>
<div class="p-3 bg-white rounded shadow mb-5">
<p class="text-secondary">Employer EPF: <span class="float-right"><?php echo $employer_epf; ?></span></p>
</div>                                        
</div>
</div>
<input type="submit" class="btn btn-success" name="submit">
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

document.getElementById("total_gross_pay").innerHTML = <?php echo $total_gross_pay; ?>;    
document.getElementById("total_gross_deduct").innerHTML = <?php echo $total_gross_deduct; ?>;    
document.getElementById("net_pay").innerHTML = <?php echo $net_pay; ?>;    

function countNetPay() {
var wages = document.getElementById("wages").value;
var overtime = document.getElementById("overtime").value;
var commission = document.getElementById("commission").value;
var allowance = document.getElementById("allowance").value;
var claims = document.getElementById("claims").value;
var director_fees = document.getElementById("director_fees").value;
var advance_paid = document.getElementById("advance_paid").value;
var bonus = document.getElementById("bonus").value;
var others = document.getElementById("others").value;
var total_gp = parseFloat(wages) + parseFloat(overtime) + parseFloat(commission) + parseFloat(allowance) + parseFloat(claims) + parseFloat(director_fees) + parseFloat(advance_paid) + parseFloat(bonus) + parseFloat(others);
var epf = document.getElementById("epf").value;
var socso = document.getElementById("socso").value;
var eis = document.getElementById("eis").value;
var deduction = document.getElementById("deduction").value;
var loan = document.getElementById("loan").value;
var unpaid_leave = document.getElementById("unpaid_leave").value;
var advance_deduct = document.getElementById("advance_deduct").value;
var total_gd = parseFloat(epf) + parseFloat(socso) + parseFloat(eis) + parseFloat(deduction) + parseFloat(loan) + parseFloat(unpaid_leave) + parseFloat(advance_deduct);    
var adjustment = document.getElementById("adjustment").value;
var net_pay = total_gp - total_gd + parseFloat(adjustment);
document.getElementById("total_gross_pay").innerHTML = total_gp;
document.getElementById("total_gross_deduct").innerHTML = total_gd;
document.getElementById("net_pay").innerHTML = net_pay;
}    
</script>
</body>
</html>