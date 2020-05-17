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

<title>Payroll Software - Dashboard</title>

<?php include "all_css.php"; ?>

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
<h1 class="mt-4">Payslip Report</h1>
<hr>
    <div class="p-3 bg-white rounded shadow mb-5">
        <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
            <li class="nav-item flex-sm-fill">
                <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Month-End Payslip</a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">AdHoc Payslip</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-1 py-3 show active">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded shadow mb-5">
                        <form action="payslip_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Month</label>
                                        <input type="text" class="form-control" id="month" name="month" value="<?php echo (int)date("m"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pwd">Year</label>
                                        <input type="text" class="form-control" id="year" name="year" value="<?php echo date("Y"); ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>            
                        </div>        
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded shadow mb-5">
                        <?php
                            $month = "";
                            $year = "";
                            $view_table = FALSE;
                            if(isset($_POST["submit"])){
                                $view_table = TRUE;
                                $month = $_POST["month"];
                                $year = $_POST["year"]; 

                                $select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$month' AND process_payroll_process_year = '$year'"); 
                            }

                        ?>
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

                                        //count total
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
                                    <td><b><?php echo $total_payslip_wages;?></b></td>
                                    <td><b><?php echo $total_payslip_overtime;?></b></td>
                                    <td><b><?php echo $total_payslip_commission;?></b></td>
                                    <td><b><?php echo $total_payslip_allowance;?></b></td>
                                    <td><b><?php echo $total_payslip_claims;?></b></td>
                                    <td><b><?php echo $total_payslip_director_fees;?></b></td>
                                    <td><b><?php echo $total_payslip_advance_paid;?></b></td>
                                    <td><b><?php echo $total_payslip_bonus;?></b></td>
                                    <td><b><?php echo $total_payslip_others;?></b></td>
                                    <td><b><?php echo $total_payslip_epf;?></b></td>
                                    <td><b><?php echo $total_payslip_socso;?></b></td>
                                    <td><b><?php echo $total_payslip_eis;?></b></td>
                                    <td><b><?php echo $total_payslip_deduction;?></b></td>
                                    <td><b><?php echo $total_payslip_loan;?></b></td>
                                    <td><b><?php echo $total_payslip_unpaid_leave;?></b></td>
                                    <td><b><?php echo $total_payslip_advance_deduct;?></b></td>
                                </tr>                
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
            <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">

            
            </div>
        </div>
    </div>
</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->  
    
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
