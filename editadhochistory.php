<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
$process_id = $_GET["pid"];

if(isset($_POST["submit"])){
    //get all new value from edited history
    $new_wages = $_POST["new_wages"];
    $new_overtime = $_POST["new_overtime"];
    $new_commission = $_POST["new_commission"];
    $new_allowance = $_POST["new_allowance"];
    $new_claims = $_POST["new_claims"];
    $new_director_fees = $_POST["new_director_fees"];
    $new_advance_paid = $_POST["new_advance_paid"];
    $new_bonus = $_POST["new_bonus"];
    $new_others = $_POST["new_others"];
    //$new_epf = $_POST["new_epf"];
    //$new_socso = $_POST["new_socso"];
    $new_eis = $_POST["new_eis"];
    $new_deduction = $_POST["new_deduction"];
    $new_loan = $_POST["new_loan"];
    $new_unpaid_leave = $_POST["new_unpaid_leave"];
    $new_advance_deduct = $_POST["new_advance_deduct"];
    $new_adjustment = $_POST["new_adjustment"];
    // end get all new value from edited history
    
    //count epf contribution
    $new_epf = $new_wages + $new_bonus + $new_allowance + $new_commission + $new_claims + $new_unpaid_leave + $new_others;
    //select all data from epf view table
    $epf_formula_sql = mysqli_query($conn, "SELECT * FROM epf_formula"); 
    //while epf view table data exists
    while($ef = mysqli_fetch_assoc($epf_formula_sql)){
        $ef_start = $ef["epf_formula_wage_start"]; //get epf starting wages value
        $ef_end = $ef["epf_formula_wage_end"]; //get epf ending wages value
        
        //if epf contribution is in between start and end wages in view table
        if(($new_epf >= $ef_start) && ($new_epf <= $ef_end)){
            $epf_employee_deduction = $ef["epf_formula_employee_amt"]; //get employee epf deduction value
            $epf_employer_deduction = $ef["epf_formula_employer_amt"]; //get employer epf deduction value
        }
    }
    //count socso contribution
    $new_socso = $new_wages + $new_others + $new_overtime + $new_allowance + $new_commission;
    //select all data from socso view table
    $socso_formula_sql = mysqli_query($conn, "SELECT * FROM socso_formula");
    //while socso view table data exists
    while($sc = mysqli_fetch_assoc($socso_formula_sql)){
        $sc_start = $sc["socso_formula_wage_start"]; //get socso starting wages value
        $sc_end = $sc["socso_formula_wage_end"]; //get socso ending wages value
        $sc_employee_contribution = $sc["socso_formula_wage_end"]; //get socso fixed contribution value
        
        //if socso contribution is in between start and end wages in view table
        if(($new_socso >= $sc_start) && ($new_socso <= $sc_end)){
        $socso_employee_deduction = $sc["socso_formula_employee_amt"]; //get employee socso deduction value
        $socso_employer_deduction = $sc["socso_formula_employer_contribution"]; //get employer socso deduction value
        }
    }
    //count eis contribution
    $new_eis = $new_wages;
   //select all data from eis view table
    $eis_formula_sql = mysqli_query($conn, "SELECT * FROM eis_formula");
    //while eis view table data exists
    while($es = mysqli_fetch_assoc($eis_formula_sql)){

        $es_start = $es["eis_formula_wage_start"]; //get eis starting wages value
        $es_end = $es["eis_formula_wage_end"]; //get eis ending wages value 
        //if eis contribution is in between start and end wages in view table
        if(($new_eis >= $es_start) && ($new_eis <= $es_end)){
            $eis_employee_deduction = $es["eis_formula_employee_amt"]; //get employee eis deduction value
            $eis_employer_deduction = $es["eis_formula_employer_amt"]; //get employer eis deduction value   
        }
    }
    //count gross pay
    $new_gross_pay = $new_wages + $new_overtime + $new_commission + $new_allowance + $new_claims + $new_director_fees + $new_advance_paid + $new_bonus + $new_others;
    //count gross deduction
    $new_gross_deduct = $epf_employee_deduction + $socso_employee_deduction + $eis_employee_deduction + $new_deduction + $new_loan + $new_unpaid_leave + $new_advance_deduct; 
    //count net pay
    $new_netpay = $new_gross_pay - $new_gross_deduct + $new_adjustment;

    
    $update_sql = mysqli_query($conn, "UPDATE process_adhoc SET process_adhoc_wage = '$new_wages', process_adhoc_overtime = '$new_overtime', process_adhoc_commission = '$new_commission', process_adhoc_allowance = '$new_allowance', process_adhoc_claims = '$new_claims', process_adhoc_director_fees = '$new_director_fees', process_adhoc_advance_paid = '$new_advance_paid', process_adhoc_bonus = '$new_bonus', process_adhoc_others = '$new_others', epf_employee_deduction = '$epf_employee_deduction', epf_employer_deduction = '$epf_employer_deduction', socso_employee_deduction = '$socso_employee_deduction', socso_employer_deduction = '$socso_employer_deduction', eis_employee_deduction = '$eis_employee_deduction', eis_employer_deduction = '$eis_employer_deduction', process_adhoc_deduction = '$new_deduction', process_adhoc_loan = '$new_loan', process_adhoc_unpaid_leave = '$new_unpaid_leave', process_adhoc_advance_deduct = '$new_advance_deduct', process_adhoc_adjustment = '$new_adjustment', process_adhoc_net_pay = '$new_netpay' WHERE process_adhoc_id = '$process_id'");
}        

$get_all_sql = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_id = '$process_id'");
$get_result = mysqli_fetch_assoc($get_all_sql);
$process_date = $get_result["process_adhoc_process_date"];
$process_from = $get_result["process_adhoc_from"];
$process_to = $get_result["process_adhoc_to"];
$process_month = $get_result["process_adhoc_process_month"];
$process_year = $get_result["process_adhoc_process_year"];
$employee_name = $get_result["emp_full_name"];
$employee_wages = $get_result["process_adhoc_wage"];
$employee_overtime = $get_result["process_adhoc_overtime"];
$employee_commission = $get_result["process_adhoc_commission"];
$employee_allowance = $get_result["process_adhoc_allowance"];
$employee_claims = $get_result["process_adhoc_claims"];
$employee_director_fees = $get_result["process_adhoc_director_fees"];
$employee_advance_paid = $get_result["process_adhoc_advance_paid"];
$employee_bonus = $get_result["process_adhoc_bonus"];
$employee_others = $get_result["process_adhoc_others"];
$employee_epf = $get_result["epf_employee_deduction"];
$employee_socso = $get_result["socso_employee_deduction"];
$employee_eis = $get_result["eis_employee_deduction"];
$employee_deduction = $get_result["process_adhoc_deduction"];
$employee_loan = $get_result["process_adhoc_loan"];
$employee_unpaid_leave = $get_result["process_adhoc_unpaid_leave"];
$employee_advance_deduct = $get_result["process_adhoc_advance_deduct"];
$employee_adjustment = $get_result["process_adhoc_adjustment"];
$employer_epf = $get_result["epf_employer_deduction"];
$employer_socso = $get_result["socso_employer_deduction"];
$employer_eis = $get_result["eis_employer_deduction"];
$adjustment = $get_result["process_adhoc_adjustment"];

$total_gross_pay = $employee_wages + $employee_overtime + $employee_commission + $employee_allowance + $employee_claims + $employee_director_fees + $employee_advance_paid + $employee_bonus + $employee_others;

$total_gross_deduct = $employee_epf + $employee_socso + $employee_eis + $employee_deduction + $employee_loan + $employee_unpaid_leave + $employee_advance_deduct;

$net_pay = $total_gross_pay - $total_gross_deduct + $employee_adjustment;
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
            <h1 class="mt-4">Edit History</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
            <form action="edithistory.php?pid=<?php echo $process_id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <p><b>AdHoc Type includes</b></p>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check_wages">
                                            <input type="checkbox" class="form-check-input" id="check_wages" name="check_wages" value="yes" checked>Wages
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check_bonus">
                                            <input type="checkbox" class="form-check-input" id="check_bonus" name="check_bonus" value="yes" checked>Bonus
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>Allowance
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>Commission
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>Claims
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>Unpaid Leave
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label" for="check1">
                                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>Others
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">AdHoc Amount</label>
                                <input type="text" class="form-control" name="process_adhoc_ref_1"> 
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