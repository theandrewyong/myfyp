<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];


if(!empty($_GET["delete_emp_id"])){
    $employee_id = $_GET["delete_emp_id"];
    $delete_sql = "DELETE FROM employee_info WHERE emp_id = '$employee_id'";
    $delete = mysqli_query($conn, $delete_sql);

    if($delete){
        echo '<script>' . 'alert(\'Deleted Successfully\')' . '</script>';
    }else{
        echo '<script>' . 'alert(\'Delete Error! Foreign Key constraints exists\')' . '</script>';
    }        
}

if(!empty($_GET["delete_allowance_id"])){
    $allowance_id = $_GET["delete_allowance_id"];
    $delete_sql = "DELETE FROM allowance WHERE allowance_id = '$allowance_id'";
    $delete = mysqli_query($conn, $delete_sql);

    if($delete){
        echo '<script>' . 'alert(\'Deleted Successfully\')' . '</script>';
    }else{
        echo '<script>' . 'alert(\'Delete Error! Foreign Key constraints exists\')' . '</script>';
    }        
}

if(!empty($_GET["delete_deduction_id"])){
    $deduction_id = $_GET["delete_deduction_id"];
    $delete_sql = "DELETE FROM deduction WHERE deduction_id = '$deduction_id'";
    $delete = mysqli_query($conn, $delete_sql);

    if($delete){
        echo '<script>' . 'alert(\'Deleted Successfully\')' . '</script>';
    }else{
        echo '<script>' . 'alert(\'Delete Error! Foreign Key constraints exists\')' . '</script>';
    }        
}

$message ='';
if(isset($_POST["submit"])){
$count = 0;
$allowance_display_id = $_POST["allowance_display_id"];
$allowance_desc = $_POST["allowance_desc"];
$allowance_rate = $_POST["allowance_rate"];	
$select_sql = mysqli_query($conn, "SELECT * FROM allowance"); 

while($data = mysqli_fetch_assoc($select_sql)){
if ($allowance_display_id == $data["allowance_display_id"])
{
$message = '<label class="text-danger">Error: ID already exist.</label>';
$count = $count+1;
}
}
if ($count==0){
$new_allowance_sql = "INSERT INTO allowance (allowance_display_id, allowance_desc, allowance_rate) VALUES (?,?,?)";
$prepared_stmt_insert = mysqli_prepare($conn, $new_allowance_sql);
mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $allowance_display_id, $allowance_desc, $allowance_rate);
mysqli_stmt_execute($prepared_stmt_insert);
mysqli_stmt_close($prepared_stmt_insert);
}
}

$message2 ='';
if(isset($_POST["submit1"])){
$count2 = 0;
$deduction_display_id = $_POST["deduction_display_id"];
$deduction_desc = $_POST["deduction_desc"];
$deduction_rate = $_POST["deduction_rate"];
$select_sql2 = mysqli_query($conn, "SELECT * FROM deduction"); 

while($data = mysqli_fetch_assoc($select_sql2)){
if ($deduction_display_id == $data["deduction_display_id"])
{
$message2 = '<label class="text-danger">Error: ID already exist.</label>';
$count2 = $count2+1;
}
}

if ($count2==0){
$new_deduction_sql = "INSERT INTO deduction (deduction_display_id, deduction_desc, deduction_rate) VALUES (?,?,?)";
$prepared_stmt_insert = mysqli_prepare($conn, $new_deduction_sql);
mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $deduction_display_id, $deduction_desc, $deduction_rate);
mysqli_stmt_execute($prepared_stmt_insert);
mysqli_stmt_close($prepared_stmt_insert);
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
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Maintain Employee</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="employee-tab" data-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Employee</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="allowance-tab" data-toggle="tab" href="#allowance" role="tab" aria-controls="allowance" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold false">Allowance</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="deduction-tab" data-toggle="tab" href="#deduction" role="tab" aria-controls="deduction" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Deduction</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="employee" role="tabpanel" aria-labelledby="employee-tab" class="tab-pane fade px-1 py-3 show active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <p><a href="addemployee.php" class="btn btn-success" role="button">Add Employee</a></p>
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
                                                echo "<td>" . '<a href="editemployee.php?emp_id=' . $data["emp_id"] . '">Edit</a>' . "</td>";
                                                echo "<td>" . '<a href="maintainemployee.php?delete_emp_id=' . $data["emp_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . "</td>";
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
                                    <label for="allowance_display_id" class="col-sm-3 control-label">
                                        <h6>Item Display ID <?php echo $message ?></h6>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="allowance_display_id" name="allowance_display_id" placeholder="Display ID: P01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="allowance_desc" class="col-sm-3 control-label">
                                        <h6>Item Description</h6>
                                    </label>
                                    <div class="col-md-12">
                                        <input type="text" id="allowance_desc" name="allowance_desc" placeholder="Description Example: Petrol" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="allowance_rate" class="col-sm-5 control-label">
                                        <h6>Rate of Item (RM)</h6>
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
                                                echo "<td>" . '<a href="editallowance.php?id=' . $data["allowance_id"] . '&desc=' . $data["allowance_desc"] . '&rate=' . $data["allowance_rate"] . '">Edit</a>' . "</td>";
                                                echo "<td>" . '<a href="maintainemployee.php?delete_allowance_id=' . $data["allowance_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . "</td>";
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
                                    <label for="deduction_display_id" class="col-sm-3 control-label">
                                        <h6>Item Display ID <?php echo $message2 ?> </h6>
                                    </label>
                                    <div class="col-12">
                                        <input type="text" id="deduction_display_id" name="deduction_display_id" placeholder="Display ID: A01" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deduction_desc" class="col-sm-3 control-label">
                                        <h6>Item Description</h6>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="deduction_desc" name="deduction_desc" placeholder="Description Example: Advance" class="form-control" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deduction_rate" class="col-sm-5 control-label">
                                        <h6>Rate of Item (RM)</h6>
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
                                                echo "<td>" . '<a href="editdeduction.php?id=' . $data["deduction_id"] . '&desc=' . $data["deduction_desc"] . '&rate=' . $data["deduction_rate"] . '">Edit</a>' . "</td>";
                                                echo "<td>" . '<a href="maintainemployee.php?delete_deduction_id=' . $data["deduction_id"] . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . "</td>";
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
</body>
</html>