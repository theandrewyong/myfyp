<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - New Payroll</title>
<?php include "all_css.php"; ?>
</head>
<body onload="myFunction()">
    
       
    
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">New Payroll</h1>
            
  

            <p id="guide_new_payroll">
            
                
                
            <?php
            $process_date_month = (int)date("m");
            $process_date_year = date("Y");                
                
            if(isset($_POST["check"])){
                
                $check_month = $_POST["process_payroll_process_month"];
                $check_year = $_POST["process_payroll_process_year"];
                $all_check_sql = mysqli_query($conn, "SELECT * FROM temp_process");
                
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
            
            
            $show_table_data = array_diff($emp_array, $process_array);
            
            $ccb = 0;
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
                        
                        //select all data from epf view table
                        $epf_formula_sql = mysqli_query($conn, "SELECT * FROM epf_formula"); 
                        //while epf view table data exists
                        while($ef = mysqli_fetch_assoc($epf_formula_sql)){
                            
                            $specific_emp_info_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '${"check_ca$i"}'");
                            $get_emp_info_result = mysqli_fetch_assoc($specific_emp_info_sql);
                            //get specific data from employee table table
                            $specific_emp_sql = mysqli_query($conn, "SELECT * FROM pre_process_payroll WHERE emp_id = '${"check_ca$i"}'");
                            $get_specific_result = mysqli_fetch_assoc($specific_emp_sql);
                            
                            if(${"check_ca$i"} == $get_specific_result["emp_id"]){
                                //specific data into variables (for new employee info table, only wage and allowance)

                                $emp_bonus = $get_specific_result["pre_process_payroll_bonus"]; //bonus
                                $emp_allowance = $get_specific_result["pre_process_payroll_allowance"]; //allowance
                                $emp_additional_deduction = $get_specific_result["pre_process_payroll_additional_deduction"]; //deduction
                                $emp_commission = $get_specific_result["pre_process_payroll_commission"]; //commission
                                $emp_claims = $get_specific_result["pre_process_payroll_claims"]; //claims
                                $emp_unpaid_leave = $get_specific_result["pre_process_payroll_unpaid_leave"]; //unpaid leave
                                $emp_others = $get_specific_result["pre_process_payroll_others"]; //others
                                $emp_overtime = $get_specific_result["pre_process_payroll_overtime"]; //overtime
                                $emp_wages = $get_specific_result["pre_process_payroll_wage"]; //wages
                                $emp_director_fees = $get_specific_result["pre_process_payroll_director_fees"];//director fees
                                $emp_advance_paid = $get_specific_result["pre_process_payroll_advance_paid"];//advance paid
                                $emp_loan = $get_specific_result["pre_process_payroll_loan"];//loan
                                $emp_advance_deduct = $get_specific_result["pre_process_payroll_advance_deduct"];//advance deduct
                                $emp_adjustment = $get_specific_result["pre_process_payroll_adjustment"];//adjustment

                                //end specific data into variables    
                            }else{
                                $emp_bonus = 0; //bonus
                                $emp_allowance = $get_emp_info_result["emp_total_allowance"] - $get_emp_info_result["emp_total_deduction"]; //allowance
                                $emp_additional_deduction = 0; //deduction
                                $emp_commission = 0; //commission
                                $emp_claims = 0; //claims
                                $emp_unpaid_leave = 0; //unpaid leave
                                $emp_others = 0; //others
                                $emp_overtime = 0; //overtime
                                $emp_wages = $get_emp_info_result["emp_wages"]; //wages
                                $emp_director_fees = 0;//director fees
                                $emp_advance_paid = 0;//advance paid
                                $emp_loan = 0;//loan
                                $emp_advance_deduct = 0;//advance deduct
                                $emp_adjustment = 0;//adjustment                                
                            }
                        
                            
                            $ef_start = $ef["epf_formula_wage_start"]; //get epf starting wages value
                            $ef_end = $ef["epf_formula_wage_end"]; //get epf ending wages value
                            //count epf contribution
                            $epf_contribution = $emp_wages + $emp_bonus + $emp_allowance + $emp_commission + $emp_claims - $emp_unpaid_leave + $emp_others;
                            
                            //if epf contribution is in between start and end wages in view table
                            if(($epf_contribution >= $ef_start) && ($epf_contribution <= $ef_end)){
                                $epf_employee_deduction = $ef["epf_formula_employee_amt"]; //get employee epf deduction value
                                $epf_employer_deduction = $ef["epf_formula_employer_amt"]; //get employer epf deduction value
                                
                                //select all data from socso view table
                                $socso_formula_sql = mysqli_query($conn, "SELECT * FROM socso_formula"); 
                                //while socso view table data exists
                                while($sc = mysqli_fetch_assoc($socso_formula_sql)){
                                    
                                    $sc_start = $sc["socso_formula_wage_start"]; //get socso starting wages value
                                    $sc_end = $sc["socso_formula_wage_end"]; //get socso ending wages value
                                    
                                    //count socso contribution
                                    $socso_contribution = $emp_wages + $emp_allowance + $emp_others + $emp_overtime + $emp_commission;
                                    
                                    //if socso contribution is in between start and end wages in view table
                                    if(($socso_contribution >= $sc_start) && ($socso_contribution <= $sc_end)){
                                    $socso_employee_deduction = $sc["socso_formula_employee_amt"]; //get employee socso deduction value
                                    $socso_employer_deduction = $sc["socso_formula_employer_amt"]; //get employer socso deduction value
                                    $sc_employee_contribution = $socso_employee_deduction + $socso_employer_deduction;
                                    //select all data from eis view table
                                    $eis_formula_sql = mysqli_query($conn, "SELECT * FROM eis_formula");
                                        //while eis view table data exists
                                        while($es = mysqli_fetch_assoc($eis_formula_sql)){
                                            
                                            $es_start = $es["eis_formula_wage_start"]; //get eis starting wages value
                                            $es_end = $es["eis_formula_wage_end"]; //get eis ending wages value
                                            //count eis contribution
                                            $eis_contribution = $emp_wages;
                                            
                                            //if eis contribution is in between start and end wages in view table
                                            if(($eis_contribution >= $es_start) && ($eis_contribution <= $es_end)){
                                                $eis_employee_deduction = $es["eis_formula_employee_amt"]; //get employee eis deduction value
                                                $eis_employer_deduction = $es["eis_formula_employer_amt"]; //get employer eis deduction value
                                                
                                                //straight minus deduction from allowance
                                                //$emp_allowance = $emp_allowance - $emp_additional_deduction;
                                                
                                                //count net pay for insert
                                                $process_payroll_net_pay = $emp_wages + $emp_allowance - $emp_additional_deduction - $epf_employee_deduction - $socso_employee_deduction - $eis_employee_deduction;
                                                
                                                //get emp display id from employee info table
                                                $emp_display_id_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '${"check_ca$i"}'"); 
                                                $emp_display_id_result = mysqli_fetch_assoc($emp_display_id_sql);
                                                $emp_display_id = $emp_display_id_result["emp_display_id"];
                                                
                                                
                                                $insert_emp_sql = mysqli_query($conn, "INSERT INTO process_payroll (emp_id, emp_display_id,  process_payroll_process_month, process_payroll_process_year, process_payroll_process_date, process_payroll_from, process_payroll_to, process_payroll_desc_1, process_payroll_desc_2, process_payroll_ref_1, process_payroll_ref_2, process_payroll_wage, process_payroll_allowance, process_payroll_additional_deduction, epf_employee_deduction, epf_employer_deduction, socso_employee_deduction, socso_employer_deduction, eis_employee_deduction, eis_employer_deduction, socso_employee_contribution, process_payroll_net_pay, process_payroll_overtime, process_payroll_commission, process_payroll_claims, process_payroll_director_fees, process_payroll_bonus, process_payroll_others, process_payroll_advance_paid, process_payroll_loan, process_payroll_unpaid_leave, process_payroll_advance_deduct, process_payroll_adjustment) VALUES ('${"check_ca$i"}', '$emp_display_id', '$process_month', '$process_year', '$process_date', '$process_from', '$process_to', '$process_desc1', '$process_desc2', '$process_ref1', '$process_ref2', '$emp_wages', '$emp_allowance', '$emp_additional_deduction', '$epf_employee_deduction', '$epf_employer_deduction', '$socso_employee_deduction', '$socso_employer_deduction', '$eis_employee_deduction', '$eis_employer_deduction', '$sc_employee_contribution', '$process_payroll_net_pay', '$emp_overtime', '$emp_commission', '$emp_claims', '$emp_director_fees', '$emp_bonus', '$emp_others', '$emp_advance_paid', '$emp_loan', '$emp_unpaid_leave', '$emp_advance_deduct','$emp_adjustment')"); 
                                                
                                                //after insert, delete it from pre-process payroll
                                                $delete_pre_process_sql = mysqli_query($conn, "DELETE FROM pre_process_payroll WHERE emp_id = '${"check_ca$i"}' AND pre_process_month = '$process_month' AND pre_process_year = '$process_year'");
                                                
                                                //header("location:historydetails.php?month=$process_date_month&year=$process_date_year");
                                                header("location:reports.php");
                                            }
                                        }                                                            
                                    }
                                }                                                   
                            }                                                
                        }
                    }  
                }
            header("Refresh:0"); //refresh page after submit
            }
        ?>
        <!-- modal must put after php refresh page, if not header wont work -->        
        <div id="guide2" class="modal modal-wide fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Step 2: New Payroll</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <p>Select the month and year to process, click check</p>
                <p>Tick or Untick employee to process</p>
                <p>Edit employee overtime, etc with the edit button</p>
              </div>
              <div class="modal-footer">
                  <a href="" class="btn btn-primary" id="g1" data-dismiss="modal">Continue</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
            
        <hr>
        <form action="newpayroll.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <p><b>Transaction Posting</b></p>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="">Month</label>
                                <input type="number" name="process_payroll_process_month" class="form-control" value="<?php echo $process_date_month; ?>">
                            </div>                
                            <div class="col-md-6 col-12">
                                <label for="">Year</label>
                                <input type="number" name="process_payroll_process_year" class="form-control" value="<?php echo $process_date_year; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <input type="submit" class="btn btn-success" name="check" value="Check">
                            </div>    
                        </div>
                        <br>
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
                            <input type="submit" class="btn btn-success" name="submit" value="Process">
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <p><b>Employee</b></p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Edit</th>
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
                                                echo "<td>" . $get_name_result["emp_display_id"] . "</td>";
                                                echo "<td>" . $get_name_result["emp_full_name"] . "</td>";
                                                echo "<td>" . '<a href="pre_process.php?pid=' . $get_name_result["emp_id"] . '&month=' . $process_date_month . '&year=' . $process_date_year .'">Edit</a>' . "</td>";
                                                echo "<td>" . '<input value="' . $get_name_result["emp_id"] . '" type="checkbox" name="cb' . $ccb . '" checked>' . "</td>";
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
        </form>
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
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );   
} );    
</script>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

    
function myFunction() {
    if (localStorage.getItem("guidelines") !== null) {
      if (!sessionStorage.getItem('shown-modal2')){
        $('#guide2').modal('show');
        sessionStorage.setItem('shown-modal2', 'true');
      }
    }
} 
        
if (localStorage.getItem("guidelines") !== null) {
    
 document.getElementById("guide_new_payroll").innerHTML = '<div class="p-2 bg-white rounded shadow mb-1"><a class="btn btn-primary" href="maintainemployee.php">Step 1: Maintain Employee</a><b> ></b><a class="btn btn-primary" href="newpayroll.php">Step 2: New Payroll</a></div>';
}
            
</script>
</body>
</html>