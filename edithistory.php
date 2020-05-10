<?php
    session_start();
    include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];
    $process_id = $_GET["pid"];
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
<h1 class="mt-4">Edit</h1>
<hr>
<!-- dashboard conten here -->
    <div class="p-5 bg-white rounded shadow mb-5">
        <?php
        //if submit
        if(isset($_POST["submit"])){
            //get new info from input
            $new_wages = $_POST["new_wages"];
            $new_overtime = $_POST["new_overtime"];
            $new_commission = $_POST["new_commission"];
            $new_allowance = $_POST["new_allowance"];
            $new_claims = $_POST["new_claims"];
            $new_director_fees = $_POST["new_director_fees"];
            $new_advance_paid = $_POST["new_advance_paid"];
            $new_bonus = $_POST["new_bonus"];
            $new_others = $_POST["new_others"];
            $new_epf = $_POST["new_epf"];
            $new_socso = $_POST["new_socso"];
            $new_eis = $_POST["new_eis"];
            $new_deduction = $_POST["new_deduction"];
            $new_loan = $_POST["new_loan"];
            $new_unpaid_leave = $_POST["new_unpaid_leave"];
            $new_advance_deduct = $_POST["new_advance_deduct"];
            $new_adjustment = $_POST["new_adjustment"];
            
            //update sql
            $update_sql = mysqli_query($conn, "UPDATE process_payroll SET process_payroll_wage = '$new_wages', process_payroll_overtime = '$new_overtime', process_payroll_commission = '$new_commission', process_payroll_allowance = '$new_allowance', process_payroll_claims = '$new_claims', process_payroll_director_fees = '$new_director_fees', process_payroll_advance_paid = '$new_advance_paid', process_payroll_bonus = '$new_bonus', process_payroll_others = '$new_others', epf_employee_deduction = '$new_epf', socso_employee_deduction = '$new_socso', eis_employee_deduction = '$new_eis', process_payroll_deduction = '$new_deduction', process_payroll_loan = '$new_loan', process_payroll_unpaid_leave = '$new_unpaid_leave', process_payroll_advance_deduct = '$new_advance_deduct', process_payroll_adjustment = '$new_adjustment' WHERE process_payroll_id = '$process_id'");
            
        }        
        
        
        //get all from values from database
        $get_all_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_id = '$process_id'");
        $get_result = mysqli_fetch_assoc($get_all_sql);
        //get process info
        $process_date = $get_result["process_payroll_process_date"];
        $process_from = $get_result["process_payroll_from"];
        $process_to = $get_result["process_payroll_to"];
        $process_month = $get_result["process_payroll_process_month"];
        $process_year = $get_result["process_payroll_process_year"];
        //get employee info
        $employee_name = $get_result["emp_full_name"];
        $employee_wages = $get_result["process_payroll_wage"];
        $employee_overtime = $get_result["process_payroll_overtime"];
        $employee_commission = $get_result["process_payroll_commission"];
        $employee_allowance = $get_result["process_payroll_allowance"];
        $employee_claims = $get_result["process_payroll_claims"];
        $employee_director_fees = $get_result["process_payroll_director_fees"];
        $employee_advance_paid = $get_result["process_payroll_advance_paid"];
        $employee_bonus = $get_result["process_payroll_bonus"];
        $employee_others = $get_result["process_payroll_others"];
        $employee_epf = $get_result["epf_employee_deduction"];
        $employee_socso = $get_result["socso_employee_deduction"];
        $employee_eis = $get_result["eis_employee_deduction"];
        $employee_deduction = $get_result["process_payroll_deduction"];
        $employee_loan = $get_result["process_payroll_loan"];
        $employee_unpaid_leave = $get_result["process_payroll_unpaid_leave"];
        $employee_advance_deduct = $get_result["process_payroll_advance_deduct"];
        $employee_adjustment = $get_result["process_payroll_adjustment"];
        //get employer info
        $employer_epf = $get_result["epf_employer_deduction"];
        $employer_socso = $get_result["socso_employer_deduction"];
        $employer_eis = $get_result["eis_employer_deduction"];
        //adjustment
        $adjustment = $get_result["process_payroll_adjustment"];
        
        //count total gross pay
        $total_gross_pay = $employee_wages + $employee_overtime + $employee_commission + $employee_allowance + $employee_claims + $employee_director_fees + $employee_advance_paid + $employee_bonus + $employee_others;
        //count total gross deduct
        $total_gross_deduct = $employee_epf + $employee_socso + $employee_eis + $employee_deduction + $employee_loan + $employee_unpaid_leave + $employee_advance_deduct;
        //count net pay
        $net_pay = $total_gross_pay - $total_gross_deduct + $employee_adjustment;
        

       
        
        ?>
        <form action="edithistory.php?pid=<?php echo $process_id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="row">
                <div class="col-6">
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_wages"><h5 class="pt-2">Wages</h5></label>
                        <input type="text" class="form-control" id="wages" onchange="countNetPay();" name="new_wages" value="<?php echo $employee_wages; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                        <label for="new_epf"><h5 class="pt-2">EPF:</h5></label>
                        <input type="text" class="form-control" id="epf" onchange="countNetPay()" name="new_epf" value="<?php echo $employee_epf; ?>">
                    </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_overtime"><h5 class="pt-2">Overtime:</h5></label>
                        <input type="text" class="form-control" id="overtime" onchange="countNetPay()" name="new_overtime" value="<?php echo $employee_overtime; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_socso"><h5 class="pt-2">SOCSO:</h5></label>
                        <input type="text" class="form-control" id="socso" onchange="countNetPay()" name="new_socso" value="<?php echo $employee_socso; ?>">
                    </div>
                </div>              
            </div>
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_commission"><h5 class="pt-2">Commission:</h5></label>
                        <input type="text" class="form-control" id="commission" onchange="countNetPay()" name="new_commission" value="<?php echo $employee_commission; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_eis"><h5 class="pt-2">EIS:</h5></label>
                        <input type="text" class="form-control" id="eis" onchange="countNetPay()" name="new_eis" value="<?php echo $employee_eis; ?>">
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_allowance"><h5 class="pt-2">Allowance:</h5></label>
                        <input type="text" class="form-control" id="allowance" onchange="countNetPay()" name="new_allowance" value="<?php echo $employee_allowance; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_deduction"><h5 class="pt-2">Deduction:</h5></label>
                        <input type="text" class="form-control" id="deduction" onchange="countNetPay()" name="new_deduction" value="<?php echo $employee_deduction; ?>">
                    </div>
                </div>               
            </div> 
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_claims"><h5 class="pt-2">Claims:</h5></label>
                        <input type="text" class="form-control" id="claims" onchange="countNetPay()" name="new_claims" value="<?php echo $employee_claims; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_loan"><h5 class="pt-2">Loan:</h5></label>
                        <input type="text" class="form-control" id="loan" onchange="countNetPay()" name="new_loan" value="<?php echo $employee_loan; ?>">
                    </div>
                </div>               
            </div>
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_director_fees"><h5 class="pt-2">Director Fees:</h5></label>
                        <input type="text" class="form-control" id="director_fees" onchange="countNetPay()" name="new_director_fees" value="<?php echo $employee_director_fees; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_unpaid_leave"><h5 class="pt-2">Unpaid Leave:</h5></label>
                        <input type="text" class="form-control" id="unpaid_leave" onchange="countNetPay()" name="new_unpaid_leave" value="<?php echo $employee_unpaid_leave; ?>">
                    </div>
                </div>               
            </div> 
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_advance_paid"><h5 class="pt-2">Advance Paid:</h5></label>
                        <input type="text" class="form-control" id="advance_paid" onchange="countNetPay()" name="new_advance_paid" value="<?php echo $employee_advance_paid; ?>">
                    </div>
                </div>
                <div class="col-6 text-danger">
                    <div class="form-group">
                    <label for="new_advance_deduct"><h5 class="pt-2">Advance Deduct:</h5></label>
                        <input type="text" class="form-control" id="advance_deduct" onchange="countNetPay()" name="new_advance_deduct" value="<?php echo $employee_advance_deduct; ?>">
                    </div>
                </div>               
            </div> 
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_bonus"><h5 class="pt-2">Bonus:</h5></label>
                        <input type="text" class="form-control" id="bonus" onchange="countNetPay()" name="new_bonus" value="<?php echo $employee_bonus; ?>">
                    </div>
                </div>
                <div class="col-6">

                </div>               
            </div>
            <div class="row">
                <div class="col-6 text-primary">
                    <div class="form-group">
                    <label for="new_others"><h5 class="pt-2">Others:</h5></label>
                        <input type="text" class="form-control" id="others" onchange="countNetPay()" name="new_others" value="<?php echo $employee_others; ?>">
                    </div>
                </div>
                <div class="col-6">

                </div>               
            </div>                
                </div>
                <div class="col-6">
                    <div class="p-4 bg-white rounded shadow mb-5">
                        <?php echo "<h4><b>" . $employee_name . "</b></h4>"; ?> 
                        <p class="text-success"><b><?php echo "Month End (" . $process_month . "." . $process_year . ")"; ?></b></p>
                    </div>
                    <div class="p-4 bg-white rounded shadow mb-5">
                        <p class="text-secondary">Employer EPF: <span class="float-right"><?php echo $employer_epf; ?></span></p>
                        <p class="text-secondary">Employer SOCSO: <span class="float-right"><?php echo $employer_socso; ?></span></p>
                        <p class="text-secondary">Employer EIS: <span class="float-right"><?php echo $employer_eis; ?></span></p>

                    </div>  
                    <div class="p-4 bg-white rounded shadow mb-5">
                        <p class="text-primary">Gross Pay:<span class="float-right" id="total_gross_pay"></span></p>
                        <p class="text-danger">Gross Deduct:<span class="float-right" id="total_gross_deduct"></span></p>
                        <p>Adjustment: <span class="float-right"><input type="text" id="adjustment" onchange="countNetPay()" name="new_adjustment" class="form-control" value="<?php echo $employee_adjustment; ?>"></span></p>
                   
                    </div>                      
                    <div class="p-4 bg-success rounded shadow mb-5 text-white">
                        
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
    

//onchange event
document.getElementById("total_gross_pay").innerHTML = <?php echo $total_gross_pay; ?>;    
document.getElementById("total_gross_deduct").innerHTML = <?php echo $total_gross_deduct; ?>;    
document.getElementById("net_pay").innerHTML = <?php echo $net_pay; ?>;    
        

function countNetPay() {
    //get all gross pay values
    var wages = document.getElementById("wages").value;
    var overtime = document.getElementById("overtime").value;
    var commission = document.getElementById("commission").value;
    var allowance = document.getElementById("allowance").value;
    var claims = document.getElementById("claims").value;
    var director_fees = document.getElementById("director_fees").value;
    var advance_paid = document.getElementById("advance_paid").value;
    var bonus = document.getElementById("bonus").value;
    var others = document.getElementById("others").value;
    //count all gross pay
    var total_gp = parseFloat(wages) + parseFloat(overtime) + parseFloat(commission) + parseFloat(allowance) + parseFloat(claims) + parseFloat(director_fees) + parseFloat(advance_paid) + parseFloat(bonus) + parseFloat(others);
    
    //get all gross deduct values
    var epf = document.getElementById("epf").value;
    var socso = document.getElementById("socso").value;
    var eis = document.getElementById("eis").value;
    var deduction = document.getElementById("deduction").value;
    var loan = document.getElementById("loan").value;
    var unpaid_leave = document.getElementById("unpaid_leave").value;
    var advance_deduct = document.getElementById("advance_deduct").value;

    //count all gross deduct
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