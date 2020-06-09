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

        $month = $_POST["month"];
        $year = $_POST["year"]; 

        $select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$month' AND process_payroll_process_year = '$year'"); 

        //validate
        $validate = mysqli_query($conn, "SELECT * FROM process_payroll");
        while($validation = mysqli_fetch_assoc($validate)){
            if ($validation["process_payroll_process_month"]==$month && $validation["process_payroll_process_year"]==$year){
                $view_table = TRUE;
            }
        }
    }
//Declare empty variables
$total_payslip_wages = 0;
$total_payslip_overtime = 0;
$total_payslip_commission = 0;
$total_payslip_allowance = 0;
$total_payslip_claims = 0;
$total_payslip_director_fees = 0;
$total_payslip_advance_paid = 0;
$total_payslip_bonus = 0;
$total_payslip_others = 0;
$total_payslip_epf = 0;
$total_payslip_socso = 0;
$total_payslip_eis = 0;
$total_payslip_deduction = 0;
$total_payslip_loan = 0;
$total_payslip_unpaid_leave = 0;
$total_payslip_advance_deduct = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Dashboard</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4"><a href="reports.php" class="btn btn-primary">Back</a> Payslip Report</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-3 bg-white rounded shadow mb-5">
                    <form action="payslip_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="month">Month</label>
                            <input type="number" class="form-control" id="month" name="month" value="<?php echo $month; ?>">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="year">Year</label>
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

                    <p><a target="_blank" href="payslip_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a></p>
                    </div>
                </div>
            </div>

            <div class="p-3 bg-white rounded shadow mb-5">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Wages</th>
                                <th>Overtime</th>
                                <th>Commission</th>
                                <th>Allowance</th>
                                <th>Claims</th>
                                <th>Director Fees</th>
                                <th>Advance Paid</th>
                                <th>Bonus</th>
                                <th>Others</th>
                                <th>EPF</th>
                                <th>SOCSO</th>
                                <th>EIS</th>
                                <th>Deduction</th>
                                <th>Loan</th>
                                <th>Unpaid Leave</th>
                                <th>Advance Deduct</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($view_table){
                                while($select_result = mysqli_fetch_assoc($select_sql)){
                                    $payslip_name = $select_result["emp_full_name"];
                                    $payslip_wages = $select_result["process_payroll_wage"];
                                    $payslip_overtime = $select_result["process_payroll_overtime"];
                                    $payslip_commission = $select_result["process_payroll_commission"];
                                    $payslip_allowance = $select_result["process_payroll_allowance"];
                                    $payslip_claims = $select_result["process_payroll_claims"];
                                    $payslip_director_fees = $select_result["process_payroll_director_fees"];
                                    $payslip_advance_paid = $select_result["process_payroll_advance_paid"];
                                    $payslip_bonus = $select_result["process_payroll_bonus"];
                                    $payslip_others = $select_result["process_payroll_others"];
                                    $payslip_epf = $select_result["epf_employee_deduction"];
                                    $payslip_socso = $select_result["socso_employee_deduction"];
                                    $payslip_eis = $select_result["eis_employee_deduction"];
                                    $payslip_deduction = $select_result["process_payroll_deduction"];
                                    $payslip_loan = $select_result["process_payroll_loan"];
                                    $payslip_unpaid_leave = $select_result["process_payroll_unpaid_leave"];
                                    $payslip_advance_deduct = $select_result["process_payroll_advance_deduct"];


                                    echo '<tr>';
                                    echo '<td>' . $payslip_name . '</td>';
                                    echo '<td>' . $payslip_wages . '</td>';
                                    echo '<td>' . $payslip_overtime . '</td>';
                                    echo '<td>' . $payslip_commission . '</td>';
                                    echo '<td>' . $payslip_allowance . '</td>';
                                    echo '<td>' . $payslip_claims . '</td>';
                                    echo '<td>' . $payslip_director_fees . '</td>';
                                    echo '<td>' . $payslip_advance_paid . '</td>';
                                    echo '<td>' . $payslip_bonus . '</td>';
                                    echo '<td>' . $payslip_others . '</td>';
                                    echo '<td>' . $payslip_epf . '</td>';
                                    echo '<td>' . $payslip_socso . '</td>';
                                    echo '<td>' . $payslip_eis . '</td>';
                                    echo '<td>' . $payslip_deduction . '</td>';
                                    echo '<td>' . $payslip_loan . '</td>';
                                    echo '<td>' . $payslip_unpaid_leave . '</td>';
                                    echo '<td>' . $payslip_advance_deduct . '</td>';
                                    echo '</tr>'; 

                                    //Count total
                                    $total_payslip_wages = $total_payslip_wages + $payslip_wages;
                                    $total_payslip_overtime = $total_payslip_overtime + $payslip_overtime;
                                    $total_payslip_commission = $total_payslip_commission + $payslip_commission;
                                    $total_payslip_allowance = $total_payslip_allowance + $payslip_allowance;
                                    $total_payslip_claims = $total_payslip_claims + $payslip_claims;
                                    $total_payslip_director_fees = $total_payslip_director_fees + $payslip_director_fees;
                                    $total_payslip_advance_paid = $total_payslip_advance_paid + $payslip_advance_paid;
                                    $total_payslip_bonus = $total_payslip_bonus + $payslip_bonus;
                                    $total_payslip_others = $total_payslip_others + $payslip_others;
                                    $total_payslip_epf = $total_payslip_epf + $payslip_epf;
                                    $total_payslip_socso = $total_payslip_socso + $payslip_socso;
                                    $total_payslip_eis = $total_payslip_eis + $payslip_eis;
                                    $total_payslip_deduction = $total_payslip_deduction + $payslip_deduction;
                                    $total_payslip_loan = $total_payslip_loan + $payslip_loan;
                                    $total_payslip_unpaid_leave = $total_payslip_unpaid_leave + $payslip_unpaid_leave;
                                    $total_payslip_advance_deduct = $total_payslip_advance_deduct + $payslip_advance_deduct;                        

                                }                    
                            }
                        ?> 
                            <tr>
                                <td><b>Total</b></td>
                                <td><b><?php echo number_format($total_payslip_wages,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_overtime,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_commission,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_allowance,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_claims,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_director_fees,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_advance_paid,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_bonus,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_others,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_epf,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_socso,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_eis,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_deduction,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_loan,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_unpaid_leave,2);?></b></td>
                                <td><b><?php echo number_format($total_payslip_advance_deduct,2);?></b></td>
                            </tr>                
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>
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