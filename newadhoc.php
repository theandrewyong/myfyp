<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];


$process_date = date("Y-m-d");
$process_date_month = 5;
$process_date_year = 2020;
$ccb = 0; //checkbox variable
$ecount = 0;
$all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");
$to_process_sql = mysqli_query($conn, "SELECT * FROM adhoc_pending");
$to_process_result = mysqli_fetch_assoc($to_process_sql);



//if submited
if(isset($_POST["submit"])){
    //geta all input values
    $cal_epf = $_POST["cal_epf"];
    $process_month = $_POST["process_adhoc_process_month"];
    $process_year = $_POST["process_adhoc_process_year"];
    $process_date = $_POST["process_adhoc_process_date"];
    $process_from = $_POST["process_adhoc_from"];
    $process_to = $_POST["process_adhoc_to"];
    $process_desc1 = $_POST["process_adhoc_desc_1"];
    $process_desc2 = $_POST["process_adhoc_desc_2"];
    $process_ref1 = $_POST["process_adhoc_ref_1"];
    $process_ref2 = $_POST["process_adhoc_ref_2"];    
    //get array diff
    //count how many employees added in table
    $count_emp_sql = mysqli_query($conn, "SELECT count(emp_id) as total from adhoc_pending");
    $count_result = mysqli_fetch_assoc($count_emp_sql);
    $counter = $count_result["total"] + 1;
    
    for($i=0;$i<$counter;$i++){ //count must be dynamic
        //if employee checkbox is checked where cb + number is checkbox name
        if(isset($_POST["cb$i"])){
            ${"check_ca$i"} = $_POST["cb$i"]; //get checkbox value into variable

            
            //select all data from epf view table
            $epf_formula_sql = mysqli_query($conn, "SELECT * FROM epf_formula"); 
            //while epf view table data exists
            while($ef = mysqli_fetch_assoc($epf_formula_sql)){
                $ef_start = $ef["epf_formula_wage_start"]; //get epf starting wages value
                $ef_end = $ef["epf_formula_wage_end"]; //get epf ending wages value
                
                $specific_adhoc_sql = mysqli_query($conn, "SELECT * FROM adhoc_pending WHERE emp_id = '${"check_ca$i"}'");//get amount from pending table
                $get_specific_result = mysqli_fetch_assoc($specific_adhoc_sql);
                //specific data from adhoc pending table
                $adhoc_amt = $get_specific_result["adhoc_amt"]; //adhoc amount is solely based on itself independently
                $adhoc_wages = $get_specific_result["adhoc_wages"];
                $adhoc_bonus = $get_specific_result["adhoc_bonus"];
                $adhoc_allowance = $get_specific_result["adhoc_allowance"];
                $adhoc_commission = $get_specific_result["adhoc_commission"];
                $adhoc_claims = $get_specific_result["adhoc_claims"];
                $adhoc_unpaid_leave = $get_specific_result["adhoc_unpaid_leave"];
                $adhoc_others = $get_specific_result["adhoc_others"];
                $adhoc_type = $get_specific_result["adhoc_type"];
                
                //end specific data from adhoc pending table
                //if adhoc amount is in between start and end epf view table wages
              
                    
                    if(($adhoc_amt >= $ef_start) && ($adhoc_amt <= $ef_end) && $cal_epf == 1){
                        $epf_employee_deduction = $ef["epf_formula_employee_amt"]; //get employee epf value
                        $epf_employer_deduction = $ef["epf_formula_employer_amt"]; //get employer epf value

                        $insert_process_adhoc_sql = mysqli_query($conn, "INSERT INTO process_adhoc (emp_id, process_adhoc_process_date, process_adhoc_from, process_adhoc_to, process_adhoc_desc_1, process_adhoc_desc_2, process_adhoc_ref_1, process_adhoc_ref_2, process_adhoc_type, process_adhoc_wage, process_adhoc_allowance, process_adhoc_commission, process_adhoc_claims, process_adhoc_bonus, process_adhoc_others, process_adhoc_unpaid_leave, epf_employee_deduction, epf_employer_deduction, process_adhoc_process_month, process_adhoc_process_year, adhoc_amt, cal_epf) VALUES ('${"check_ca$i"}', '$process_date', '$process_from', '$process_to', '$process_desc1', '$process_desc2', '$process_ref1', '$process_ref2', '$adhoc_type', '$adhoc_wages', '$adhoc_allowance', '$adhoc_commission', '$adhoc_claims', '$adhoc_bonus', '$adhoc_others', '$adhoc_unpaid_leave', '$epf_employee_deduction', '$epf_employer_deduction', '$process_month', '$process_year', '$adhoc_amt', '$cal_epf')");
                        
                        mysqli_query($conn, "UPDATE adhoc_pending SET adhoc_status = 'DONE' WHERE emp_id = '${"check_ca$i"}'");
                    }    
                
                    if(($adhoc_amt >= $ef_start) && ($adhoc_amt <= $ef_end) && $cal_epf == 0){
                        $epf_employee_deduction = 0;//get employee epf value
                        $epf_employer_deduction = 0; //get employer epf value

                        $insert_process_adhoc_sql = mysqli_query($conn, "INSERT INTO process_adhoc (emp_id, process_adhoc_process_date, process_adhoc_from, process_adhoc_to, process_adhoc_desc_1, process_adhoc_desc_2, process_adhoc_ref_1, process_adhoc_ref_2, process_adhoc_type, process_adhoc_wage, process_adhoc_allowance, process_adhoc_commission, process_adhoc_claims, process_adhoc_bonus, process_adhoc_others, process_adhoc_unpaid_leave, epf_employee_deduction, epf_employer_deduction, process_adhoc_process_month, process_adhoc_process_year, adhoc_amt, cal_epf) VALUES ('${"check_ca$i"}', '$process_date', '$process_from', '$process_to', '$process_desc1', '$process_desc2', '$process_ref1', '$process_ref2', '$adhoc_type', '$adhoc_wages', '$adhoc_allowance', '$adhoc_commission', '$adhoc_claims', '$adhoc_bonus', '$adhoc_others', '$adhoc_unpaid_leave', '$epf_employee_deduction', '$epf_employer_deduction', '$process_month', '$process_year', '$adhoc_amt', '$cal_epf')");
                        
                        mysqli_query($conn, "UPDATE adhoc_pending SET adhoc_status = 'DONE' WHERE emp_id = '${"check_ca$i"}'");
                    }        
            
                                                         
            }                                                   
        }                                                
    }            
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - New AdHoc</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">New AdHoc</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="process_adhoc-tab" data-toggle="tab" href="#process_adhoc" role="tab" aria-controls="process_adhoc" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Process AdHoc</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="pending_adhoc-tab" data-toggle="tab" href="#pending_adhoc" role="tab" aria-controls="pending_adhoc" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Pending AdHoc List</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="process_adhoc" role="tabpanel" aria-labelledby="process_adhoc-tab" class="tab-pane fade px-1 py-3 show active">
                    <form action="newadhoc.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow mb-5"><!-- Start of rounded shadow box -->
                                <p><b>Process Checked AdHoc</b></p>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label for="">Month</label>
                                        <input type="number" name="process_adhoc_process_month" class="form-control" value="<?php echo $process_date_month; ?>">
                                    </div>                
                                    <div class="col-md-6 col-12">
                                        <label for="">Year</label>
                                        <input type="text" name="process_adhoc_process_year" class="form-control" value="<?php echo $process_date_year; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Process Date</label>
                                        <input type="date" class="form-control" name="process_adhoc_process_date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>    
                                </div>    
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label for="">Process From</label>
                                        <input type="date" class="form-control" name="process_adhoc_from" value="<?php echo date('Y-m-01'); ?>">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="">To</label>
                                        <input type="date" class="form-control" name="process_adhoc_to" value="<?php echo date('Y-m-t'); ?>">
                                    </div>
                                </div>
                                <br>
                                <p><b>Contribution</b></p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <label class="form-check-label" for="cal_epf">
                                            <input type="hidden" class="form-check-input" id="cal_epf" name="cal_epf" value="0">
                                            <input type="checkbox" class="form-check-input" id="cal_epf" name="cal_epf" value="1" checked>Calculate EPF
                                        </label>
                                        </div>
                                    </div>
                                </div>    
                                <br>
                                <p><b>Description</b></p>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Description 1</label>
                                        <input type="text" class="form-control" name="process_adhoc_desc_1">                
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Description 2</label>
                                        <input type="text" class="form-control" name="process_adhoc_desc_2">                
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Reference 1</label>
                                        <input type="text" class="form-control" name="process_adhoc_ref_1">                
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Reference 2</label>
                                        <input type="text" class="form-control" name="process_adhoc_ref_2">                
                                    </div>    
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                    <br>
                                    <input type="submit" class="btn btn-success" name="submit">
                                    </div>    
                                </div>                                
                            </div><!-- End of rounded shadow box -->
                        </div><!-- End of 1st Row, 1st Column -->
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
                                                        <th>To process</th>
                                                    </tr>
                                                </thead>                                
                                                <tbody>
                                                <?php
                                                
                                                if(mysqli_num_rows($to_process_sql) >= 0){

                                                    $adhoc_pending_list_sql = mysqli_query($conn, "SELECT adhoc_pending.*, employee_info.* FROM adhoc_pending INNER JOIN employee_info ON adhoc_pending.emp_id = employee_info.emp_id");
                                                    while($result = mysqli_fetch_assoc($adhoc_pending_list_sql)){
                                                        $ccb++;
                                                        echo "<tr>";
                                                        echo "<td>" . $result["emp_display_id"] . "</td>";
                                                        echo "<td>" . $result["emp_full_name"] . "</td>";
                                                        echo "<td>" . '<input value="' . $result["emp_id"] . '" type="checkbox" name="cb' . $ccb . '" checked>' . "</td>";
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
                    <div id="pending_adhoc" role="tabpanel" aria-labelledby="pending_adhoc-tab" class="tab-pane fade px-1 py-3">
                        <p><a href="addpendingadhoc.php" class="btn btn-success">Add Pending AdHoc</a></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>AdHoc Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $adhoc_pending_sql = "SELECT adhoc_pending.*, employee_info.* FROM adhoc_pending INNER JOIN employee_info ON adhoc_pending.emp_id = employee_info.emp_id";
                                        $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $adhoc_pending_sql);
                                        mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
                                        $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 

                                        if($epf_result->num_rows > 0) { 
                                            while ($data = $epf_result->fetch_assoc()) {
                                                $adhoc_id = $data["adhoc_id"];
                                                $delete_adhoc_id = $data["adhoc_id"];
                                                echo '<tr>';
                                                echo '<td>' . $data["emp_display_id"] . '</td>';
                                                echo '<td>' . $data["emp_full_name"] . '</td>';
                                                echo '<td>' . $data["adhoc_type"] . '</td>';
                                                echo '<td>' . number_format($data["adhoc_amt"], 2) . '</td>';
                                                echo '<td>' . $data["adhoc_status"] . '</td>';
                                                echo '<td>' . '<a class="btn btn-primary" href="editadhocpending.php?adhoc_id=' . $adhoc_id . '">Edit Employee AdHoc</a>' . '</td>';
                                                echo '<td>' . '<a class="btn btn-danger" href="deletePendingAdhoc.php?id=' . $delete_adhoc_id . '" onclick="return confirm(\'Confirm Delete?\');">Delete Employee AdHoc</a>' . '</td>';
                                                echo '</tr>';
                                            }
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
    
$(document).ready( function() {
    $('#example1').dataTable( {
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
</script>
</body>
</html>