<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

$month = (int)date("m");
$year = date("Y");
$view_table = FALSE;

if(isset($_POST["submit"])){
$year = $_POST["year"]; 
$month = $_POST["month"];

	
//validate
$validate = mysqli_query($conn, "SELECT * FROM process_payroll");
while($validation = mysqli_fetch_assoc($validate)){
	if ($validation["process_payroll_process_year"]==$year && $validation["process_payroll_process_month"]==$month){
		$view_table = TRUE;
	}
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Payroll Summary Report</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Payroll Summary Report</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <form action="payroll_summary_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">Month</label>
                                        <input type="number" class="form-control" id="year" name="month" value="<?php echo $month; ?>">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="month">Year</label>
                                        <input type="number" class="form-control" id="year" name="year" value="<?php echo $year; ?>">
                                    </div>
                                    </div>                                    
                                </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded shadow mb-5">
                            <p><a target="_blank" href="payroll_summary_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Wages</th>
                                        <th>Overtime</th>
                                        <th>Commission</th>
                                        <th>Allowance</th>
                                        <th>Claims</th>
                                        <th>Director Fees</th>
                                        <th>Advance Paid</th>
                                        <th>Bonus</th>
                                        <th>Others</th>
                                        <th>Gross Pay</th>
                                        <th>EPF</th>
                                        <th>SOCSO</th>
                                        <th>EIS</th>
                                        <th>Deduction</th>
                                        <th>Loan</th>
                                        <th>Unpaid Leave</th>
                                        <th>Advance Deduct</th>
                                        <th>Gross Deduct</th>
                                        <th>Employer EPF</th>
                                        <th>Employer SOCSO</th>
                                        <th>Employer EIS</th>
                                        <th>Net Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_wage = 0;    
                                $total_overtime = 0;    
                                $total_commission = 0;    
                                $total_allowance = 0;    
                                $total_claims = 0;    
                                $total_director_fees = 0;    
                                $total_advance_paid = 0;    
                                $total_bonus = 0;    
                                $total_others = 0;    
                                $total_epf = 0;    
                                $total_socso = 0;    
                                $total_eis = 0;    
                                $total_deduction = 0;    
                                $total_loan = 0;    
                                $total_unpaid_leave = 0;    
                                $total_advance_deduct = 0;      
                                    
                                $sum_gross_pay = 0;    
                                $total_gross_pay = 0;    
                                    
                                $sum_gross_deduct = 0;    
                                $total_gross_deduct = 0; 
                                $total_net_pay = 0;
                                    
                                $total_employer_epf = 0;
                                $total_employer_socso = 0;
                                $total_employer_eis = 0;
                                    
                                $get_info_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id");
                                $each_emp_wages = 0;
                                while($select_result = mysqli_fetch_assoc($get_info_sql)){
                                    $emp_id = $select_result["emp_id"];
                                    $emp_wages = $select_result["process_payroll_wage"];
                                    $emp_id_array[] = $emp_id;
                                    $each_emp_wages = $each_emp_wages + $emp_wages;
                                }
                                $emp_id_unique = array_unique($emp_id_array);
                                foreach($emp_id_unique as $eiu){
                                     $sum_gross_pay = 0;
                                     $sum_gross_deduct = 0;
                                    //count the total wages for each employee
                                    /*$sql = mysqli_query($conn, "SELECT SUM(process_payroll_wage) AS sum_wage, SUM(process_payroll_allowance) AS sum_allowance, SUM(process_payroll_overtime) AS sum_overtime, SUM(process_payroll_commission) AS sum_commission, SUM(process_payroll_claims) AS sum_claims, SUM(process_payroll_director_fees) AS sum_director_fees, SUM(process_payroll_advance_paid) AS sum_advance_paid, SUM(process_payroll_bonus) AS sum_bonus, SUM(process_payroll_others) AS sum_others, SUM(epf_employee_deduction) AS sum_employee_epf, SUM(epf_employee_deduction) AS sum_epf, SUM(socso_employee_deduction) AS sum_socso, SUM(eis_employee_deduction) AS sum_eis, SUM(process_payroll_deduction) AS sum_deduction, SUM(process_payroll_loan) AS sum_loan, SUM(process_payroll_unpaid_leave) AS sum_unpaid_leave, SUM(process_payroll_advance_deduct) AS sum_advance_deduct FROM process_payroll WHERE emp_id = '$eiu' AND process_payroll_process_year = '$year' AND process_payroll_process_month = '$month'");
                                    */
                                    //echo $month;
                                    $sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$month' AND process_payroll_process_year = '$year' AND emp_id = '$eiu'");
                                    $get_name_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$eiu'");
                                    $namesql = mysqli_fetch_assoc($get_name_sql);
                                    $usql = mysqli_fetch_assoc($sql);
                                    $emp_name = $namesql["emp_full_name"];
                                    /*
                                    $sum_wage = $usql["sum_wage"];
                                    $sum_overtime = $usql["sum_overtime"];
                                    $sum_commission = $usql["sum_commission"];
                                    $sum_allowance = $usql["sum_allowance"];
                                    $sum_claims = $usql["sum_claims"];
                                    $sum_director_fees = $usql["sum_director_fees"];
                                    $sum_advance_paid = $usql["sum_advance_paid"];
                                    $sum_bonus = $usql["sum_bonus"];
                                    $sum_others = $usql["sum_others"];
                                    $sum_epf = $usql["sum_epf"];
                                    $sum_socso = $usql["sum_socso"];
                                    $sum_eis = $usql["sum_eis"];
                                    $sum_deduction = $usql["sum_deduction"];
                                    $sum_loan = $usql["sum_loan"];
                                    $sum_unpaid_leave = $usql["sum_unpaid_leave"];
                                    $sum_advance_deduct = $usql["sum_advance_deduct"];*/
                                    
                                    $sum_netpay = $usql["process_payroll_net_pay"];
                                    
                                    $epf_employer_deduction = $usql["epf_employer_deduction"];
                                    $socso_employer_deduction = $usql["socso_employer_deduction"];
                                    $eis_employer_deduction = $usql["eis_employer_deduction"];
                                    
                                    $sum_wage = $usql["process_payroll_wage"];
                                    $sum_overtime = $usql["process_payroll_overtime"];
                                    $sum_commission = $usql["process_payroll_commission"];
                                    $sum_allowance = $usql["process_payroll_allowance"];
                                    $sum_claims = $usql["process_payroll_claims"];
                                    $sum_director_fees = $usql["process_payroll_director_fees"];
                                    $sum_advance_paid = $usql["process_payroll_advance_paid"];
                                    $sum_bonus = $usql["process_payroll_bonus"];
                                    $sum_others = $usql["process_payroll_others"];
                                    
                                    $sum_gross_pay = $sum_gross_pay + $sum_wage + $sum_overtime + $sum_commission + $sum_allowance + $sum_claims + $sum_director_fees + $sum_advance_paid + $sum_bonus + $sum_others;
                                    
                                    $total_gross_pay = $total_gross_pay + $sum_gross_pay;
                                    
                                    
                                    $sum_epf = $usql["epf_employee_deduction"];
                                    $sum_socso = $usql["socso_employee_deduction"];
                                    $sum_eis = $usql["eis_employee_deduction"];
                                    $sum_deduction = $usql["process_payroll_additional_deduction"];
                                    $sum_loan = $usql["process_payroll_loan"];
                                    $sum_unpaid_leave = $usql["process_payroll_unpaid_leave"];
                                    $sum_advance_deduct = $usql["process_payroll_advance_deduct"];              
                                    
                                    
                                    $sum_gross_deduct = $sum_gross_deduct + $sum_epf + $sum_socso + $sum_eis + $sum_deduction + $sum_loan + $sum_unpaid_leave + $sum_advance_deduct;
                                    
                                    $total_gross_deduct = $total_gross_deduct + $sum_gross_deduct;     
                                    
                                    
                                    //employer
                                    $total_employer_epf = $total_employer_epf + $epf_employer_deduction;
                                    $total_employer_socso = $total_employer_socso + $socso_employer_deduction;
                                    $total_employer_eis = $total_employer_eis + $eis_employer_deduction;
                                    
                                    
                                    
                                    $total_net_pay = $total_net_pay + $sum_netpay;

                                    echo '<tr>';
                                    echo '<td>' . $emp_name . '</td>';
                                    echo '<td style="color:blue;">' . $sum_wage . '</td>';
                                    echo '<td style="color:blue;">' . $sum_overtime . '</td>';
                                    echo '<td style="color:blue;">' . $sum_commission . '</td>';
                                    echo '<td style="color:blue;">' . $sum_allowance . '</td>';
                                    echo '<td style="color:blue;">' . $sum_claims . '</td>';
                                    echo '<td style="color:blue;">' . $sum_director_fees . '</td>';
                                    echo '<td style="color:blue;">' . $sum_advance_paid . '</td>';
                                    echo '<td style="color:blue;">' . $sum_bonus . '</td>';
                                    echo '<td style="color:blue;">' . $sum_others . '</td>';
                                    echo '<td style="color:green;">' . number_format($sum_gross_pay,2) . '</td>';
                                    
                                    echo '<td style="color:red;">' . '-' . $sum_epf . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_socso . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_eis . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_deduction . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_loan . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_unpaid_leave . '</td>';
                                    echo '<td style="color:red;">' . '-' . $sum_advance_deduct . '</td>';
                                    
                                    echo '<td style="color:green;">' . '-' . number_format($sum_gross_deduct,2) . '</td>';
                                    
                                    echo '<td style="color:black;">' . '-' . number_format($epf_employer_deduction,2) . '</td>';
                                    echo '<td style="color:black;">' . '-' . number_format($socso_employer_deduction,2) . '</td>';
                                    echo '<td style="color:black;">' . '-' . number_format($eis_employer_deduction,2) . '</td>';
                                    
                                    
                                    echo '<td style="color:green;">' . number_format($sum_netpay,2) . '</td>';
                                    echo '</tr>';
                                    
                                    //count wages for all employee
                                    $total_wage = $total_wage + $sum_wage;
                                    $total_overtime = $total_overtime + $sum_overtime;
                                    $total_commission = $total_commission + $sum_commission;
                                    $total_allowance = $total_allowance + $sum_allowance;
                                    $total_claims = $total_claims + $sum_claims;
                                    $total_director_fees = $total_director_fees + $sum_director_fees;
                                    $total_advance_paid = $total_advance_paid + $sum_advance_paid;
                                    $total_bonus = $total_bonus + $sum_bonus;
                                    $total_others = $total_others + $sum_others;
                                    $total_epf = $total_epf + $sum_epf;
                                    $total_socso = $total_socso + $sum_socso;
                                    $total_eis = $total_eis + $sum_eis;
                                    $total_deduction = $total_deduction + $sum_deduction;
                                    $total_loan = $total_loan + $sum_loan;
                                    $total_unpaid_leave = $total_unpaid_leave + $sum_unpaid_leave;
                                    $total_advance_deduct = $total_advance_deduct + $sum_advance_deduct;
                                }
                                ?>
                                <tr>
                                    <td><b>Total (RM)</b></td>    
                                    <td style="color:blue;"><b><?php echo number_format($total_wage,2); ?></b></td>    
                                    <td style="color:blue;"><b><?php echo number_format($total_overtime,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_commission,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_allowance,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_claims,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_director_fees,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_advance_paid,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_bonus,2); ?></b></td>      
                                    <td style="color:blue;"><b><?php echo number_format($total_others,2); ?></b></td>      
                                    
                                    <td style="color:green;"><b><?php echo number_format($total_gross_pay,2); ?></b></td>  
                                    
                                    <td style="color:red;"><b>-<?php echo number_format($total_epf,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_socso,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_eis,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_deduction,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_loan,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_unpaid_leave,2); ?></b></td>      
                                    <td style="color:red;"><b>-<?php echo number_format($total_advance_deduct,2); ?></b></td> 
                                    
                                    <td style="color:green;"><b>-<?php echo number_format($total_gross_deduct,2); ?></b></td>  
  
                                    <td style="color:black;"><b>-<?php echo number_format($total_employer_epf,2); ?></b></td>  
                                    <td style="color:black;"><b>-<?php echo number_format($total_employer_socso,2); ?></b></td>  
                                    <td style="color:black;"><b>-<?php echo number_format($total_employer_eis,2); ?></b></td>               
                                    
                                    <td style="color:green;"><b><?php echo number_format($total_net_pay,2); ?></b></td>      
                                </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
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