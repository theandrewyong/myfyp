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
<h1 class="mt-4">New Payroll</h1>
<!-- dashboard conten here -->


<?php

    
if(isset($_POST["check"])){
    $check_month = $_POST["process_payroll_process_month"];
    $check_year = $_POST["process_payroll_process_year"];
    //check if empty
    $all_check_sql = mysqli_query($conn, "SELECT * FROM temp_process");
   // $acs = mysqli_fetch_assoc($all_check_sql);
    if(mysqli_num_rows($all_check_sql) == 0){
        $check_sql = mysqli_query($conn, "INSERT INTO temp_process (temp_month, temp_year) VALUES ('$check_month', '$check_year')");
    }else{
        $check_sql = mysqli_query($conn, "UPDATE temp_process SET temp_month = '$check_month', temp_year = '$check_year'");
    }
}    
    
    
    


$all_check_sql = mysqli_query($conn, "SELECT * FROM temp_process");
$acs = mysqli_fetch_assoc($all_check_sql);

    
$all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");
    
    
$process_date = date("Y-m-d");
$process_date_month = $acs["temp_month"]; 
$process_date_year = $acs["temp_year"]; 
$to_process_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$process_date_month' AND process_payroll_process_year = '$process_date_year'");

if(mysqli_num_rows($all_employee_sql) != 0){
    while($all_emp_data = mysqli_fetch_assoc($all_employee_sql)){
        $emp_array[] = $all_emp_data["emp_id"];
    }
}else{
    $emp_array[] = "";
}
if(mysqli_num_rows($to_process_sql) != 0){
    while( $compare_data = mysqli_fetch_assoc($to_process_sql)){
        $process_array[] = $compare_data["emp_id"];
    }
}else{
    $process_array[] = "";
}
    
$ccb = 0;
$show_table_data = array_diff($emp_array, $process_array);
if(isset($_POST["submit"])){

    $process_month = $_POST["process_payroll_process_month"];
    $process_year = $_POST["process_payroll_process_year"];
    $process_date = $_POST["process_payroll_process_date"];
    $process_from = $_POST["process_payroll_from"];
    $process_to = $_POST["process_payroll_to"];
    $process_desc1 = $_POST["process_payroll_desc_1"];
    $process_desc2 = $_POST["process_payroll_desc_2"];
    $process_ref1 = $_POST["process_payroll_ref_1"];
    $process_ref2 = $_POST["process_payroll_ref_2"];
                                    
                                    $show_table_data = array_diff($emp_array, $process_array);
    $counter = count($show_table_data) + 1;
    for($i=1;$i<$counter;$i++){
        if(isset($_POST["cb$i"])){
            ${"check_ca$i"} = $_POST["cb$i"];
            //echo ${"check_ca$i"} . "<br>";
            //get EPF formula to count
            $epf_formula_sql = mysqli_query($conn, "SELECT * FROM epf_formula");
            while($ef = mysqli_fetch_assoc($epf_formula_sql)){
                $ef_start = $ef["epf_formula_wage_start"];
                $ef_end = $ef["epf_formula_wage_end"];  
                //employee wages
                $specific_emp_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '${"check_ca$i"}'");
                $get_specific_result = mysqli_fetch_assoc($specific_emp_sql);
                $emp_wages = $get_specific_result["emp_wages"];// get individual employee wages
                $emp_allowance = $get_specific_result["emp_total_allowance"];
               // $emp_overtime = "";
               // $emp_commission = "";
               // $emp_claims = "";
               // $emp_director_fees = "";
               // $emp_bonus = "";
               // $emp_others = "";
               // $emp_advance_paid = "";
               // $emp_loan = "";
               // $emp_adhoc_deduction = "";
               // $emp_unpaid_leave = "";
               // $emp_advance_deduct = "";
                if(($emp_wages >= $ef_start) && ($emp_wages <= $ef_end)){ //if wages is in between
                    //echo $ef["epf_formula_employee_amt"]; //display employee epf amt for the range
                    $epf_employee_deduction = $ef["epf_formula_employee_amt"];
                    $epf_employer_deduction = $ef["epf_formula_employer_amt"];
                    //count SOCSO
                    $socso_formula_sql = mysqli_query($conn, "SELECT * FROM socso_formula");
                    while($sc = mysqli_fetch_assoc($socso_formula_sql)){
                        $sc_start = $sc["socso_formula_wage_start"];
                        $sc_end = $sc["socso_formula_wage_end"];
                        $sc_employee_contribution = $sc["socso_formula_wage_end"];
                        if(($emp_wages >= $sc_start) && ($emp_wages <= $sc_end)){
                            $socso_employee_deduction = $sc["socso_formula_employee_amt"];
                            $socso_employer_deduction = $sc["socso_formula_employer_contribution"];
                            //count EIS
                            $eis_formula_sql = mysqli_query($conn, "SELECT * FROM eis_formula");
                            while($es = mysqli_fetch_assoc($eis_formula_sql)){
                                $es_start = $es["eis_formula_wage_start"];
                                $es_end = $es["eis_formula_wage_end"];
                                if(($emp_wages >= $es_start) && ($emp_wages <= $es_end)){
                                    $eis_employee_deduction = $es["eis_formula_employee_amt"];
                                    $eis_employer_deduction = $es["eis_formula_employer_amt"];
                                    $insert_emp_sql = mysqli_query($conn, "INSERT INTO process_payroll (emp_id, process_payroll_process_month, process_payroll_process_year, process_payroll_process_date, process_payroll_from, process_payroll_to, process_payroll_desc_1, process_payroll_desc_2, process_payroll_ref_1, process_payroll_ref_2, process_payroll_wage, process_payroll_allowance, epf_employee_deduction, epf_employer_deduction, socso_employee_deduction, socso_employer_deduction, eis_employee_deduction, eis_employer_deduction, socso_employee_contribution) VALUES ('${"check_ca$i"}', '$process_month', '$process_year', '$process_date', '$process_from', '$process_to', '$process_desc1', '$process_desc2', '$process_ref1', '$process_ref2', '$emp_wages', '$emp_allowance', '$epf_employee_deduction', '$epf_employer_deduction', '$socso_employee_deduction', '$socso_employer_deduction', '$eis_employee_deduction', '$eis_employer_deduction', '$sc_employee_contribution')"); 
                                }
                            }                                                            
                        }
                    }                                                   
                }                                                
            }
        }  
    }
    header("Refresh:0");
}
    
    
?>
    
    <hr> <form action="newpayroll.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="p-5 bg-white rounded shadow mb-5">

           
            <p><b>Transaction Posting</b></p>
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Month</label>
                    <input type="number" name="process_payroll_process_month" class="form-control" value="<?php echo $process_date_month; ?>">
                </div>                
                <div class="col-md-6 col-12">
                    <label for="">Year</label>
                    <input type="text" name="process_payroll_process_year" class="form-control" value="<?php echo $process_date_year; ?>">
                </div>
            </div><br>
            <div class="row">
                <div class="col-12">
                    <input type="submit" class="btn btn-success" name="check">
                </div>    
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Process Date</label>
                    <input type="date" class="form-control" name="process_payroll_process_date" value="<?php echo date('Y-m-d'); ?>">
                </div>    
            </div>    
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Process From</label>
                    <input type="date" class="form-control" name="process_payroll_from" value="<?php echo date('Y-m-01'); ?>">
                </div>
                <div class="col-md-6 col-12">
                    <label for="">To</label>
                    <input type="date" class="form-control" name="process_payroll_to" value="<?php echo date('Y-m-t'); ?>">
                </div>
            </div>
            <br>
            <p><b>Description</b></p>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 1</label>
                    <input type="text" class="form-control" name="process_payroll_desc_1">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 2</label>
                    <input type="text" class="form-control" name="process_payroll_desc_2">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 1</label>
                    <input type="text" class="form-control" name="process_payroll_ref_1">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 2</label>
                    <input type="text" class="form-control" name="process_payroll_ref_2">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <br>
                    <input type="submit" class="btn btn-success" name="submit">
                    
                </div>    
            </div>
           
        </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="p-5 bg-white rounded shadow mb-5">
            <p><b>Employee</b></p>
                <div class="table-responsive">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>To process</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                        <?php
                        if(mysqli_num_rows($to_process_sql) >= 0){
                            foreach($show_table_data as $std){
                                $ccb++;
                                $get_name = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$std'");
                                $get_name_result = mysqli_fetch_assoc($get_name);
                                echo "<tr>";
                                echo "<td>" . $std . "</td>";
                                echo "<td>" . $get_name_result["emp_full_name"] . "</td>";
                                echo "<td>" . '<input value="' . $get_name_result["emp_id"] . '" type="checkbox" name="cb' . $ccb . '">' . "</td>";
                                echo "</tr>";                                   
                            }                                            
                        }else{
                            echo "<tr>";
                            echo "<td colspan='2'>All Employee processed for this Month and Year</td>";
                            echo "</tr>";
                        }

                        ?>
                                </tbody>
                                </table>

                            </div>
                        </div>                       
                    </div>        
                </div>
            </div>
        </div>
    </div> </form>
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
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>

</html>
