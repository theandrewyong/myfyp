<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
$process_id = $_GET["pid"];
$process_month = $_GET["month"];
$process_year = $_GET["year"];

//get wages, allowance from employee_info
$get_w_a = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$process_id'");
$get_w_a_result = mysqli_fetch_assoc($get_w_a);
	
	$new_emp_name = $get_w_a_result["emp_full_name"];
    $new_wages = $get_w_a_result["emp_wages"];
    $new_overtime = 0;
    $new_commission = 0;
    $new_allowance = $get_w_a_result["emp_total_allowance"] - $get_w_a_result["emp_total_deduction"];
    $new_claims = 0;
    $new_director_fees = 0;
    $new_advance_paid = 0;
    $new_bonus = 0;
    $new_others = 0;
    $new_epf = 0;
    $new_socso = 0;
    $new_eis = 0;
    $new_additional_deduction = 0;
    $new_loan = 0;
    $new_unpaid_leave = 0;
    $new_advance_deduct = 0;
    $new_adjustment = 0;

$validate_table = mysqli_query($conn, "SELECT * FROM pre_process_payroll WHERE emp_id='$process_id' AND pre_process_month='$process_month' AND pre_process_year='$process_year'");

if($datarows = mysqli_num_rows($validate_table) > 0){
	$fetch = mysqli_fetch_assoc($validate_table);
	
    $new_wages = $fetch["pre_process_payroll_wage"];
    $new_overtime = $fetch["pre_process_payroll_overtime"];
    $new_commission = $fetch["pre_process_payroll_commission"];
    $new_allowance = $fetch["pre_process_payroll_allowance"];
    $new_claims = $fetch["pre_process_payroll_claims"];
    $new_director_fees = $fetch["pre_process_payroll_director_fees"];
    $new_advance_paid = $fetch["pre_process_payroll_advance_paid"];
    $new_bonus = $fetch["pre_process_payroll_bonus"];
    $new_others = $fetch["pre_process_payroll_others"];
    $new_epf = $fetch["pre_epf_employee_deduction"];
    $new_socso = $fetch["pre_socso_employee_deduction"];
    $new_eis = $fetch["pre_eis_employee_deduction"];
    $new_additional_deduction = $fetch["pre_process_payroll_additional_deduction"];
    $new_loan = $fetch["pre_process_payroll_loan"];
    $new_unpaid_leave = $fetch["pre_process_payroll_unpaid_leave"];
    $new_advance_deduct = $fetch["pre_process_payroll_advance_deduct"];
    $new_adjustment = $fetch["pre_process_payroll_adjustment"];	
	
	//count epf contribution
    $new_epf = $new_wages + $new_bonus + $new_allowance + $new_commission + $new_claims - $new_unpaid_leave + $new_others;
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
	
	if(isset($_POST["submit"])){

		$new_wages = $_POST["new_wages"];
		$new_overtime = $_POST["new_overtime"];
		$new_commission = $_POST["new_commission"];
		$new_allowance = $_POST["new_allowance"];
		$new_claims = $_POST["new_claims"];
		$new_director_fees = $_POST["new_director_fees"];
		$new_advance_paid = $_POST["new_advance_paid"];
		$new_bonus = $_POST["new_bonus"];
		$new_others = $_POST["new_others"];
		$new_additional_deduction = $_POST["new_additional_deduction"];
		$new_loan = $_POST["new_loan"];
		$new_unpaid_leave = $_POST["new_unpaid_leave"];
		$new_advance_deduct = $_POST["new_advance_deduct"];
		$new_adjustment = $_POST["new_adjustment"];
		
		//count epf contribution
		$new_epf = $new_wages + $new_bonus + $new_allowance + $new_commission + $new_claims - $new_unpaid_leave + $new_others;
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


			//if socso contribution is in between start and end wages in view table
			if(($new_socso >= $sc_start) && ($new_socso <= $sc_end)){
			$socso_employee_deduction = $sc["socso_formula_employee_amt"]; //get employee socso deduction value
			$socso_employer_deduction = $sc["socso_formula_employer_amt"]; //get employer socso deduction value
			$sc_employee_contribution = $sc["socso_formula_employer_contribution"]; //get socso fixed contribution value	

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
    $new_gross_deduct = $epf_employee_deduction + $socso_employee_deduction + $eis_employee_deduction + $new_additional_deduction + $new_loan + $new_unpaid_leave + $new_advance_deduct; 
    //count net pay
    $new_netpay = $new_gross_pay - $new_gross_deduct + $new_adjustment;

		$update_sql = mysqli_query($conn, "UPDATE pre_process_payroll SET pre_process_payroll_wage = '$new_wages', pre_process_payroll_overtime = '$new_overtime', pre_process_payroll_commission = '$new_commission', pre_process_payroll_allowance = '$new_allowance', pre_process_payroll_claims = '$new_claims', pre_process_payroll_director_fees = '$new_director_fees', pre_process_payroll_advance_paid = '$new_advance_paid', pre_process_payroll_bonus = '$new_bonus', pre_process_payroll_others = '$new_others', pre_epf_employee_deduction = '$epf_employee_deduction', pre_epf_employer_deduction = '$epf_employer_deduction', pre_socso_employee_deduction = '$socso_employee_deduction', pre_socso_employer_deduction = '$socso_employer_deduction', pre_eis_employee_deduction = '$eis_employee_deduction', pre_eis_employer_deduction = '$eis_employer_deduction', pre_process_payroll_additional_deduction = '$new_additional_deduction', pre_process_payroll_loan = '$new_loan', pre_process_payroll_unpaid_leave = '$new_unpaid_leave', pre_process_payroll_advance_deduct = '$new_advance_deduct', pre_process_payroll_adjustment = '$new_adjustment', pre_process_payroll_net_pay = '$new_netpay' WHERE emp_id='$process_id' AND pre_process_month='$process_month' AND pre_process_year='$process_year'");
	}
	

	
}

else {
	//count epf contribution
    $new_epf = $new_wages + $new_bonus + $new_allowance + $new_commission + $new_claims - $new_unpaid_leave + $new_others;
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
		$new_additional_deduction = $_POST["new_additional_deduction"];
		$new_loan = $_POST["new_loan"];
		$new_unpaid_leave = $_POST["new_unpaid_leave"];
		$new_advance_deduct = $_POST["new_advance_deduct"];
		$new_adjustment = $_POST["new_adjustment"];
		// end get all new value from edited history

		//count epf contribution
		$new_epf = $new_wages + $new_bonus + $new_allowance + $new_commission + $new_claims - $new_unpaid_leave + $new_others;
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


			//if socso contribution is in between start and end wages in view table
			if(($new_socso >= $sc_start) && ($new_socso <= $sc_end)){
			$socso_employee_deduction = $sc["socso_formula_employee_amt"]; //get employee socso deduction value
			$socso_employer_deduction = $sc["socso_formula_employer_amt"]; //get employer socso deduction value
			$sc_employee_contribution = $sc["socso_formula_employer_contribution"]; //get socso fixed contribution value	

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
    $new_gross_deduct = $epf_employee_deduction + $socso_employee_deduction + $eis_employee_deduction + $new_additional_deduction + $new_loan + $new_unpaid_leave + $new_advance_deduct; 
    //count net pay
    $new_netpay = $new_gross_pay - $new_gross_deduct + $new_adjustment;

		$insert_sql = mysqli_query($conn, "INSERT INTO pre_process_payroll (emp_id, pre_process_month, pre_process_year, pre_process_payroll_wage, pre_process_payroll_allowance, pre_process_payroll_additional_deduction, pre_process_payroll_overtime, pre_process_payroll_commission, pre_process_payroll_claims, pre_process_payroll_director_fees, pre_process_payroll_bonus, pre_process_payroll_others, pre_process_payroll_advance_paid, pre_process_payroll_loan, pre_process_payroll_unpaid_leave, pre_process_payroll_advance_deduct, pre_epf_employee_deduction, pre_socso_employee_deduction, pre_eis_employee_deduction, pre_epf_employer_deduction, pre_socso_employer_deduction, pre_eis_employer_deduction, pre_process_payroll_adjustment, pre_process_payroll_net_pay, pre_socso_employee_contribution) VALUES ('$process_id', '$process_month', '$process_year', '$new_wages', '$new_allowance', '$new_additional_deduction', '$new_overtime', '$new_commission', '$new_claims', '$new_director_fees', '$new_bonus', '$new_others', '$new_advance_paid', '$new_loan', '$new_unpaid_leave', '$new_advance_deduct', '$epf_employee_deduction', '$socso_employee_deduction', '$eis_employee_deduction', '$epf_employer_deduction', '$socso_employer_deduction', '$eis_employer_deduction', '$new_adjustment', '$new_netpay', '$sc_employee_contribution')");
	}        


	
}


$total_gross_pay = $new_wages + $new_overtime + $new_commission + $new_allowance + $new_claims + $new_director_fees + $new_advance_paid + $new_bonus + $new_others;

	$total_gross_deduct = $epf_employee_deduction + $socso_employee_deduction + $eis_employee_deduction + $new_additional_deduction + $new_loan + $new_unpaid_leave + $new_advance_deduct;

	$net_pay = $total_gross_pay - $total_gross_deduct + $new_adjustment;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Pre-Process</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Pre-Process Payroll</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
            <form action="pre_process.php?pid=<?php echo $process_id . '&month=' . $process_month . '&year=' . $process_year; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_wages"><h5 class="pt-2">Wages</h5></label>
                                    <input type="text" class="form-control" id="wages" onchange="countNetPay();" name="new_wages" value="<?php echo $new_wages; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_epf"><h5 class="pt-2">EPF:</h5></label>
                                    <input type="text" class="form-control" id="epf" onchange="countNetPay()" name="new_epf" value="<?php echo $epf_employee_deduction; ?>">
                                </div>
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_overtime"><h5 class="pt-2">Overtime:</h5></label>
                                    <input type="text" class="form-control" id="overtime" onchange="countNetPay()" name="new_overtime" value="<?php echo number_format($new_overtime,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_socso"><h5 class="pt-2">SOCSO:</h5></label>
                                    <input type="text" class="form-control" id="socso" onchange="countNetPay()" name="new_socso" value="<?php echo $socso_employee_deduction; ?>">
                                </div>
                            </div>              
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_commission"><h5 class="pt-2">Commission:</h5></label>
                                    <input type="text" class="form-control" id="commission" onchange="countNetPay()" name="new_commission" value="<?php echo number_format($new_commission,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_eis"><h5 class="pt-2">EIS:</h5></label>
                                    <input type="text" class="form-control" id="eis" onchange="countNetPay()" name="new_eis" value="<?php echo $eis_employee_deduction; ?>">
                                </div>
                            </div>                
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_allowance"><h5 class="pt-2">Allowance:</h5></label>
                                    <input type="text" class="form-control" id="allowance" onchange="countNetPay()" name="new_allowance" value="<?php echo number_format($new_allowance,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_additional_deduction"><h5 class="pt-2">Deduction:</h5></label>
                                    <input type="text" class="form-control" id="deduction" onchange="countNetPay()" name="new_additional_deduction" value="<?php echo number_format($new_additional_deduction,2); ?>">
                                </div>
                            </div>               
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_claims"><h5 class="pt-2">Claims:</h5></label>
                                    <input type="text" class="form-control" id="claims" onchange="countNetPay()" name="new_claims" value="<?php echo number_format($new_claims,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_loan"><h5 class="pt-2">Loan:</h5></label>
                                    <input type="text" class="form-control" id="loan" onchange="countNetPay()" name="new_loan" value="<?php echo number_format($new_loan,2); ?>">
                                </div>
                            </div>               
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_director_fees"><h5 class="pt-2">Director Fees:</h5></label>
                                    <input type="text" class="form-control" id="director_fees" onchange="countNetPay()" name="new_director_fees" value="<?php echo number_format($new_director_fees,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_unpaid_leave"><h5 class="pt-2">Unpaid Leave:</h5></label>
                                    <input type="text" class="form-control" id="unpaid_leave" onchange="countNetPay()" name="new_unpaid_leave" value="<?php echo number_format($new_unpaid_leave,2); ?>">
                                </div>
                            </div>               
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_advance_paid"><h5 class="pt-2">Advance Paid:</h5></label>
                                    <input type="text" class="form-control" id="advance_paid" onchange="countNetPay()" name="new_advance_paid" value="<?php echo number_format($new_advance_paid,2); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-danger">
                                <div class="form-group">
                                    <label for="new_advance_deduct"><h5 class="pt-2">Advance Deduct:</h5></label>
                                    <input type="text" class="form-control" id="advance_deduct" onchange="countNetPay()" name="new_advance_deduct" value="<?php echo number_format($new_advance_deduct,2); ?>">
                                </div>
                            </div>               
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-6 text-primary">
                                <div class="form-group">
                                    <label for="new_bonus"><h5 class="pt-2">Bonus:</h5></label>
                                    <input type="text" class="form-control" id="bonus" onchange="countNetPay()" name="new_bonus" value="<?php echo number_format($new_bonus,2); ?>">
                                </div>
                            </div>              
                        </div>
                    <div class="row">
                        <div class="col-md-6 col-6 text-primary">
                            <div class="form-group">
                                <label for="new_others"><h5 class="pt-2">Others:</h5></label>
                                <input type="text" class="form-control" id="others" onchange="countNetPay()" name="new_others" value="<?php echo number_format($new_others,2); ?>">
                            </div>
                        </div>              
                    </div>                
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <?php echo "<h4><b>" . $new_emp_name . "</b></h4>"; ?> 
                            <p class="text-success"><b><?php echo "Month End (" . $process_month . "." . $process_year . ")"; ?></b></p>
                        </div>
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <p class="text-secondary">Employer EPF: <span class="float-right"><?php echo $epf_employer_deduction; ?></span></p>
                            <p class="text-secondary">Employer SOCSO: <span class="float-right"><?php echo $socso_employer_deduction; ?></span></p>
                            <p class="text-secondary">Employer EIS: <span class="float-right"><?php echo $eis_employer_deduction; ?></span></p>
                        </div>  
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <p class="text-primary">Gross Pay:<span class="float-right" id="total_gross_pay"></span></p>
                            <p class="text-danger">Gross Deduct:<span class="float-right" id="total_gross_deduct"></span></p>
                                                        <div class="form-group">
                                <label for="new_others"><p>Adjustment:</p></label>
                                <input type="text" id="adjustment" onchange="countNetPay()" name="new_adjustment" class="form-control" value="<?php echo number_format($new_adjustment,2); ?>">
                            </div>
                        </div>                      
                        <div class="p-3 bg-success rounded shadow mb-5 text-white">
                            <p>NP<span class="float-right">Net Pay</span></p>
                            <h1>RM<span class="float-right" id="net_pay"></span></h1>                       
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
    document.getElementById("total_gross_pay").innerHTML = total_gp.toFixed(2);
    document.getElementById("total_gross_deduct").innerHTML = total_gd.toFixed(2);
    document.getElementById("net_pay").innerHTML = net_pay.toFixed(2);   

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
    document.getElementById("total_gross_pay").innerHTML = total_gp.toFixed(2);
    document.getElementById("total_gross_deduct").innerHTML = total_gd.toFixed(2);
    document.getElementById("net_pay").innerHTML = net_pay.toFixed(2);
}    
</script>
</body>
</html>