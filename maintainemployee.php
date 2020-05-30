<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

$message ='';
$error_rate ='';
if(isset($_POST["submit"])){
$count = 0;
$error = FALSE;
$allowance_display_id = $_POST["allowance_display_id"];
$allowance_desc = $_POST["allowance_desc"];
$allowance_rate = $_POST["allowance_rate"];	
$select_sql = mysqli_query($conn, "SELECT * FROM allowance"); 

while($data = mysqli_fetch_assoc($select_sql)){
if ($allowance_display_id == $data["allowance_display_id"])
{
$message = '<label class="text-danger">Error: ID already exist.</label>';
$count = $count+1;
$error = TRUE;
}
}
	
if (empty($allowance_rate) || $allowance_rate == 0 || $allowance_rate == 0.00) {
	$error_rate = '<label class="text-danger">Error: Rate should NOT be 0.00</label>';
	$error = TRUE;
}
	
if ($error == FALSE && $count==0){
$new_allowance_sql = "INSERT INTO allowance (allowance_display_id, allowance_desc, allowance_rate) VALUES (?,?,?)";
$prepared_stmt_insert = mysqli_prepare($conn, $new_allowance_sql);
mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $allowance_display_id, $allowance_desc, $allowance_rate);
mysqli_stmt_execute($prepared_stmt_insert);
mysqli_stmt_close($prepared_stmt_insert);
    echo "<script>alert('Added Successfully!');document.location='maintainemployee.php'</script>";
}
}

$message2 ='';
$error_rate2 ='';
if(isset($_POST["submit1"])){
$count2 = 0;
$error2 = FALSE;
$deduction_display_id = $_POST["deduction_display_id"];
$deduction_desc = $_POST["deduction_desc"];
$deduction_rate = $_POST["deduction_rate"];
$select_sql2 = mysqli_query($conn, "SELECT * FROM deduction"); 

while($data = mysqli_fetch_assoc($select_sql2)){
if ($deduction_display_id == $data["deduction_display_id"])
{
$message2 = '<label class="text-danger">Error: ID already exist.</label>';
$count2 = $count2+1;
$error2 = TRUE;
}
}
	
if (empty($deduction_rate) || $deduction_rate == 0 || $deduction_rate == 0.00) {
	$error_rate2 = '<label class="text-danger">Error: Rate should NOT be 0.00</label>';
	$error2 = TRUE;
}

if ($error2 == FALSE && $count2==0){
$new_deduction_sql = "INSERT INTO deduction (deduction_display_id, deduction_desc, deduction_rate) VALUES (?,?,?)";
$prepared_stmt_insert = mysqli_prepare($conn, $new_deduction_sql);
mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $deduction_display_id, $deduction_desc, $deduction_rate);
mysqli_stmt_execute($prepared_stmt_insert);
mysqli_stmt_close($prepared_stmt_insert);
    echo "<script>alert('Added Successfully!');document.location='maintainemployee.php'</script>";
}
}

$select_emp = mysqli_query($conn, "SELECT * FROM employee_info");
$select_allowance = mysqli_query($conn, "SELECT * FROM allowance"); 
$select_deduction = mysqli_query($conn, "SELECT * FROM deduction"); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Maintain Employee</title>
<?php include "all_css.php"; ?>
</head>
<body>
    
    
    



<div id="tallModal" class="modal modal-wide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Process Payroll?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>To process payroll with guidance, Press Proceed</p>
        <p>To process manually, Press cancel</p>
      </div>
      <div class="modal-footer">
          <a href="" class="btn btn-danger" data-dismiss="modal">Cancel</a>
          <a href="" class="btn btn-primary" id="save" data-dismiss="modal">Proceed</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


   
    
    
<div id="guide1" class="modal modal-wide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Step 1: Maintain Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>If No changes to be made in Maintain Employee, Press Proceed</p>
        <p>To Check or Edit Employee, Press Check. After finish editing employee, go to New Payroll on the left side of sidebar</p>
      </div>
      <div class="modal-footer">
          <a href="" class="btn btn-danger" onClick="history.go(0);">Check / Edit Employee</a>
          <a href="" class="btn btn-primary" id="g1" data-dismiss="modal">Proceed</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
    
    
    
    
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Maintain Employee</h1>
            <p id="guide_maintain_employee"></p>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="employee-tab" data-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">All Employee Info</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="allowance-tab" data-toggle="tab" href="#allowance" role="tab" aria-controls="allowance" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold false">All Allowance Info</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="deduction-tab" data-toggle="tab" href="#deduction" role="tab" aria-controls="deduction" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">All Deduction Info</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="employee" role="tabpanel" aria-labelledby="employee-tab" class="tab-pane fade px-1 py-3 show active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <p><a href="addemployee.php" class="btn btn-success" role="button">Add New Employee</a></p>
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee Display ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Position</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($datarows = mysqli_num_rows($select_emp) > 0){
                                            while($data = mysqli_fetch_assoc($select_emp)){
                                                echo "<tr>";
                                                echo "<td>" . $data["emp_display_id"] . "</td>";
                                                echo "<td>" . $data["emp_full_name"] . "</td>";
                                                echo "<td>" . $data["emp_title"] . "</td>";
                                                echo "<td>" . '<a class="btn btn-primary" href="editemployee.php?emp_id=' . $data["emp_id"] . '">Edit Employee Info</a>' . "</td>";
                                                echo "<td>" . '<a class="btn btn-danger" href="deleteEmployee.php?id=' . $data["emp_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete Employee</a>' . "</td>";
                                                echo "</tr>";
                                            }
                                        }  
                                        ?>
                                        </tbody>
                                    </table>               
                                </div>
                            </div>                          
                        </div>
                    </div>
                    <div id="allowance" role="tabpanel" aria-labelledby="allowance-tab" class="tab-pane fade px-1 py-3">
                        <div class="row">
                            <div class="col-md-6 col-12">
                            <form  role="form" method="post">
                                <div class="form-group">
                                    <label for="allowance_display_id" class="col-sm-12 control-label">
                                        <h6>Item Display ID <?php echo $message ?></h6>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="allowance_display_id" name="allowance_display_id" placeholder="Display ID: P01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="allowance_desc" class="col-sm-12 control-label">
                                        <h6>Item Description</h6>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="allowance_desc" name="allowance_desc" placeholder="Description Example: Petrol" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="allowance_rate" class="col-sm-12 control-label">
                                        <h6>Rate of Item (RM) <?php echo $error_rate ?></h6>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="allowance_rate" name="allowance_rate" placeholder="Rate Example: 100" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit">Add Item</button>
                                </div>
                            </form> 
                            </div>
                            <div class="col-md-6 col-12">
                                <br>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Allowance Display ID</th>
                                                <th>Allowance Desc</th>
                                                <th>Allowance Rate (RM)</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($datarows = mysqli_num_rows($select_allowance) > 0){
                                            while($data = mysqli_fetch_assoc($select_allowance)){
                                                echo "<tr>";
                                                echo "<td>" . $data["allowance_display_id"] . "</td>";
                                                echo "<td>" . $data["allowance_desc"] . "</td>";
                                                echo "<td>" . $data["allowance_rate"] . "</td>";
                                                echo "<td>" . '<a class="btn btn-primary" href="editallowance.php?id=' . $data["allowance_id"] . '&desc=' . $data["allowance_desc"] . '&rate=' . $data["allowance_rate"] . '">Edit Allowance</a>' . "</td>";
                                                echo "<td>" . '<a class="btn btn-danger" href="deleteGeneralAllowance.php?id=' . $data["allowance_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete Allowance</a>' . "</td>";
                                                echo "</tr>";
                                            }
                                        }  
                                        ?>
                                        </tbody>
                                    </table>  
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <div id="deduction" role="tabpanel" aria-labelledby="deduction-tab" class="tab-pane fade px-1 py-3">
                        <div class="row">
                            <div class="col-md-6 col-12">
                            <form class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                    <label for="deduction_display_id" class="col-sm-12 control-label">
                                        <h6>Item Display ID <?php echo $message2 ?> </h6>
                                    </label>
                                    <div class="col-12">
                                        <input type="text" id="deduction_display_id" name="deduction_display_id" placeholder="Display ID: A01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deduction_desc" class="col-sm-12 control-label">
                                        <h6>Item Description</h6>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="deduction_desc" name="deduction_desc" placeholder="Description Example: Advance" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deduction_rate" class="col-sm-12 control-label">
                                        <h6>Rate of Item (RM) <?php echo $error_rate2 ?></h6>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="deduction_rate" name="deduction_rate" placeholder="Rate Example: 100" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit1">Add Item</button>
                                </div>
                            </form>
                            </div>
                            <div class="col-md-6 col-12">
                                <br>
                                <div class="table-responsive">
                                    <table id="example2" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Deduction Display ID</th>
                                                <th>Deduction Desc</th>
                                                <th>Deduction Rate (RM)</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($datarows = mysqli_num_rows($select_deduction) > 0){
                                            while($data = mysqli_fetch_assoc($select_deduction)){
                                                echo "<tr>";
                                                echo "<td>" . $data["deduction_display_id"] . "</td>";
                                                echo "<td>" . $data["deduction_desc"] . "</td>";
                                                echo "<td>" . $data["deduction_rate"] . "</td>";
                                                echo "<td>" . '<a class="btn btn-primary" href="editdeduction.php?id=' . $data["deduction_id"] . '&desc=' . $data["deduction_desc"] . '&rate=' . $data["deduction_rate"] . '">Edit Deduction</a>' . "</td>";
                                                echo "<td>" . '<a class="btn btn-danger" href="deleteGeneralDeduction.php?id=' . $data["deduction_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete Deduction</a>' . "</td>";
                                                echo "</tr>";
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
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );
} );

$(document).ready( function() {
    $('#example2').dataTable( {
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
    
 
$(window).on('load',function(){
  if (!sessionStorage.getItem('shown-modal')){
    $('#tallModal').modal('show');
    sessionStorage.setItem('shown-modal', 'true');
  }
});
    
if (localStorage.getItem("guidelines") !== null) {
    
 document.getElementById("guide_maintain_employee").innerHTML = '<div class="p-3 bg-white rounded shadow mb-1"><a class="btn btn-primary" href="maintainemployee.php">Step 1: Maintain Employee</a></div>';
}    

</script>

</body>
</html>