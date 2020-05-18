<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

if(!empty($_GET["delete_adhoc_id"])){
    $delete_adhoc_id = $_GET["delete_adhoc_id"];
    $delete_sql = "DELETE FROM adhoc_pending WHERE adhoc_id = '$delete_adhoc_id'";
    $delete = mysqli_query($conn, $delete_sql);
    if($delete){
        echo '<script>' . 'alert(\'Deleted Successfully\')' . '</script>';
    }else{
        echo '<script>' . 'alert(\'Delete Error!\')' . '</script>';
    }    
}

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
    
    for($i=1;$i<$counter;$i++){ //count must be dynamic
        //if employee checkbox is checked where cb + number is checkbox name
        if(isset($_POST["cb$i"])){
            ${"check_ca$i"} = $_POST["cb$i"]; //get checkbox value into variable
            echo ${"check_ca$i"}; //successfully get all names in table
            //check if epf contribution is checked
            if(isset($_POST["cal_epf"])){ //if set to calculate epf
                //do epf calculation for adhoc amt
                //echo "check";
                $adhoc_amt = $to_process_result["adhoc_wages"];
            }else{
                //dont do epf calculation for adhoc amt
               // echo "no check";
                $adhoc_amt = $to_process_result["adhoc_wages"];
            }
            
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
                //$adhoc_type = $get_specific_result["adhoc_type"];
                
                //end specific data from adhoc pending table
                //if adhoc amount is in between start and end epf view table wages
                if(($adhoc_amt >= $ef_start) && ($adhoc_amt <= $ef_end)){
                    $epf_employee_deduction = $ef["epf_formula_employee_amt"]; //get employee epf value
                    $epf_employer_deduction = $ef["epf_formula_employer_amt"]; //get employer epf value

                    //select all from socso view table
                    $socso_formula_sql = mysqli_query($conn, "SELECT * FROM socso_formula");
                    //while socso view table exists
                    while($sc = mysqli_fetch_assoc($socso_formula_sql)){
                        $sc_start = $sc["socso_formula_wage_start"]; //get socso starting wages value
                        $sc_end = $sc["socso_formula_wage_end"]; //get socso ending wages value
                        $sc_employee_contribution = $sc["socso_formula_wage_end"]; //get socso fixed contribution value
                        //if adhoc amount is in between start and end socso view table wages
                        if(($adhoc_amt >= $sc_start) && ($adhoc_amt <= $sc_end)){
                        $socso_employee_deduction = $sc["socso_formula_employee_amt"]; //get employee socso value
                        $socso_employer_deduction = $sc["socso_formula_employer_amt"]; //get employer socso value
                            
                        //select all from eis view table 
                        $eis_formula_sql = mysqli_query($conn, "SELECT * FROM eis_formula");
                            //while eis view table exists
                            while($es = mysqli_fetch_assoc($eis_formula_sql)){
                                $es_start = $es["eis_formula_wage_start"]; //get eis starting wages value
                                $es_end = $es["eis_formula_wage_end"]; //get eis ending wages value
                                //if adhoc amount is in between start and end eis view table wages
                                if(($adhoc_amt >= $es_start) && ($adhoc_amt <= $es_end)){
                                    $eis_employee_deduction = $es["eis_formula_employee_amt"]; //get employee eis value
                                    $eis_employer_deduction = $es["eis_formula_employer_amt"]; //get employer eis value
                                    
                                    //query to insert in process adhoc table
                                    $insert_process_adhoc_sql = mysqli_query($conn, "INSERT INTO process_adhoc (emp_id, process_adhoc_wage,  epf_employee_deduction, socso_employee_deduction, eis_employee_deduction, epf_employer_deduction, socso_employer_deduction, eis_employer_deduction, process_adhoc_desc_1, process_adhoc_desc_2, process_adhoc_ref_1, process_adhoc_ref_2, process_adhoc_from, process_adhoc_to, process_adhoc_process_date, process_adhoc_process_month, process_adhoc_process_year) VALUES ('${"check_ca$i"}', '$adhoc_amt', '$epf_employee_deduction', '$socso_employee_deduction', '$eis_employee_deduction', '$epf_employer_deduction', '$socso_employer_deduction', '$eis_employer_deduction', '$process_desc1', '$process_desc2', '$process_ref1', '$process_ref2', '$process_from', '$process_to', '$process_date', '$process_month', '$process_year')");
                                }
                            }                                                            
                        }
                    }                                                   
                }                                                
            }            
        }
    }
}

//get 3 types of checkbox value, epf, socso, eis

//get checkbox employee id value

//$insert_process_adhoc_sql = mysqli_query($conn, "INSERT INTO ad (emp_id) VALUES ('${"check_ca$i"}')");







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
                                            <input type="checkbox" class="form-check-input" id="cal_epf" name="cal_epf" value="yes" checked>Calculate EPF
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

                                                    $adhoc_pending_list_sql = mysqli_query($conn, "SELECT * FROM adhoc_pending");
                                                    while($result = mysqli_fetch_assoc($adhoc_pending_list_sql)){
                                                        $ccb++;
                                                        echo "<tr>";
                                                        echo "<td>" . $result["emp_id"] . "</td>";
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
                                        $adhoc_pending_sql = "SELECT * FROM adhoc_pending";
                                        $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $adhoc_pending_sql);
                                        mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
                                        $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 

                                        if($epf_result->num_rows > 0) { 
                                            while ($data = $epf_result->fetch_assoc()) {
                                                $adhoc_id = $data["adhoc_id"];
                                                $delete_adhoc_id = $data["adhoc_id"];
                                                echo '<tr>';
                                                echo '<td>' . $data["emp_id"] . '</td>';
                                                echo '<td>' . $data["emp_full_name"] . '</td>';
                                                echo '<td>' . "bonus" . '</td>';
                                                echo '<td>' . $data["adhoc_amt"] . '</td>';
                                                echo '<td>' . $data["adhoc_status"] . '</td>';
                                                echo '<td>' . '<a href="editadhocpending.php?adhoc_id=' . $adhoc_id . '">Edit</a>' . '</td>';
                                                echo '<td>' . '<a href="newadhoc.php?delete_adhoc_id=' . $delete_adhoc_id . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . '</td>';
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