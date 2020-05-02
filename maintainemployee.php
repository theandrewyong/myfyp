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
            <div class="p-5 bg-white rounded shadow mb-5">
            <!-- Rounded tabs -->
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
                    <div id="employee" role="tabpanel" aria-labelledby="employee-tab" class="tab-pane fade px-4 py-5 show active">
                        <div class="table-responsive">
                            <div class="container-fluid">
                            <?php
                            $select_sql = mysqli_query($conn, "SELECT * FROM employee_info");  
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="addemployee.php" class="btn btn-success" role="button">Add Employee</a>
                                        <!-- Show admin table -->
                                        <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Employee Position</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($datarows = mysqli_num_rows($select_sql) > 0){
                                            while($data = mysqli_fetch_assoc($select_sql)){
                                            echo "<tr>";
                                            echo "<td>" . $data["emp_id"] . "</td>";
                                            echo "<td>" . $data["emp_full_name"] . "</td>";
                                            echo "<td>" . $data["emp_title"] . "</td>";
                                            echo "<td>" . '<a href="editemployee.php?emp_id=' . $data["emp_id"] . '">Edit</a>' . "</td>";
                                            echo "<td>" . '<a href="deleteemployee.php?id=' . $data["emp_id"] . '">Delete</a>' . "</td>";
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
                    <div id="allowance" role="tabpanel" aria-labelledby="allowance-tab" class="tab-pane fade px-4 py-5">
                        <?php
                        if(isset($_POST["submit"])){
                            $allowance_desc = $_POST["allowance_desc"];
                            $allowance_rate = $_POST["allowance_rate"];
                            $new_allowance_sql = "INSERT INTO allowance (allowance_desc, allowance_rate) VALUES (?,?)";
                            $prepared_stmt_insert = mysqli_prepare($conn, $new_allowance_sql);
                            mysqli_stmt_bind_param($prepared_stmt_insert, 'ss', $allowance_desc, $allowance_rate);
                            mysqli_stmt_execute($prepared_stmt_insert);
                            mysqli_stmt_close($prepared_stmt_insert);
                        }
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <form class="form-horizontal" role="form" method="post">
                                    <div class="form-group">
                                    <label for="allowance_desc" class="col-sm-3 control-label"><h6>Item Description</h6></label>
                                        <div class="col-12">
                                            <input type="text" id="allowance_desc" name="allowance_desc" placeholder="Description Example: Petrol" class="form-control">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="allowance_rate" class="col-sm-5 control-label"><h6>Rate of Item (RM)</h6></label>
                                    <div class="col-12">
                                        <input type="number" id="allowance_rate" name="allowance_rate" step=".01" placeholder="Rate Example: 100" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block" name="submit">Add Item</button>
                                </div>
                                </form> 
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <div class="container-fluid">
                                    <?php
                                    $select_sql = mysqli_query($conn, "SELECT * FROM allowance");  
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Show admin table -->
                                                <table id="example1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Allowance ID</th>
                                                            <th>Allowance Desc</th>
                                                            <th>Allowance Rate</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if($datarows = mysqli_num_rows($select_sql) > 0){
                                                        while($data = mysqli_fetch_assoc($select_sql)){
                                                            echo "<tr>";
                                                            echo "<td>" . $data["allowance_id"] . "</td>";
                                                            echo "<td>" . $data["allowance_desc"] . "</td>";
                                                            echo "<td>" . $data["allowance_rate"] . "</td>";
                                                            echo "<td>" . '<a href="editallowance.php?id=' . $data["allowance_id"] . '&desc=' . $data["allowance_desc"] . '&rate=' . $data["allowance_rate"] . '">Edit</a>' . "</td>";
                                                            echo "<td>" . '<a href="deleteallowance.php?id=' . $data["allowance_id"] . '">Delete</a>' . "</td>";
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
                    <div id="deduction" role="tabpanel" aria-labelledby="deduction-tab" class="tab-pane fade px-4 py-5">
                        <?php
                        if(isset($_POST["submit1"])){
                            $deduction_desc = $_POST["deduction_desc"];
                            $deduction_rate = $_POST["deduction_rate"];
                            $new_deduction_sql = "INSERT INTO deduction (deduction_desc, deduction_rate) VALUES (?,?)";
                            $prepared_stmt_insert = mysqli_prepare($conn, $new_deduction_sql);
                            mysqli_stmt_bind_param($prepared_stmt_insert, 'ss', $deduction_desc, $deduction_rate);
                            mysqli_stmt_execute($prepared_stmt_insert);
                            mysqli_stmt_close($prepared_stmt_insert);
                        }
                        ?>
                        <div class="row">
                            <div class="col-6">
								<form class="form-horizontal" role="form" method="post">
									<div class="form-group">
										<label for="deduction_desc" class="col-sm-3 control-label"><h6>Item Description</h6></label>
										<div class="col-sm-12">
											<input type="text" id="deduction_desc" name="deduction_desc" placeholder="Description Example: Advance" class="form-control" autofocus>
										</div>
									</div>
									<div class="form-group">
										<label for="deduction_rate" class="col-sm-5 control-label"><h6>Rate of Item (RM)</h6></label>
										<div class="col-sm-12">
											<input type="number" id="deduction_rate" name="deduction_rate" step=".01" placeholder="Rate Example: 100" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-block" name="submit1">Add Item</button>
									</div>
								</form>
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <div class="container-fluid">

                                    <?php
                                    $select_sql = mysqli_query($conn, "SELECT * FROM deduction");  
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Show admin table --><form action="maintainemployee.php" method="post">
                                                <table id="example2" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Deduction ID</th>
                                                            <th>Deduction Desc</th>
                                                            <th>Deduction Rate</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <?php
                                                    if($datarows = mysqli_num_rows($select_sql) > 0){
                                                        while($data = mysqli_fetch_assoc($select_sql)){
                                                            echo "<tr>";
                                                            echo "<td>" . $data["deduction_id"] . "</td>";
                                                            echo "<td>" . $data["deduction_desc"] . "</td>";
                                                            echo "<td>" . $data["deduction_rate"] . "</td>";
                                                            echo "<td>" . '<a href="editdeduction.php?id=' . $data["deduction_id"] . '&desc=' . $data["deduction_desc"] . '&rate=' . $data["deduction_rate"] . '">Edit</a>' . "</td>";
                                                            echo "<td>" . '<a href="deletededuction.php?id=' . $data["deduction_id"] . '">Delete</a>' . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    }  
                                                    ?>                          
                                                    </tbody>
                                                </table> 
                                                </form>
                                                    
                                                
                                            </div>
                                        </div>                       
                                    </div>        
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

<!-- Menu Toggle Script -->
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
    "sDom": '<"mot"f><"xot"l>rt<"bottom"pi><"clear">'
  } );
} );
    
$(document).ready( function() {
  $('#example1').dataTable( {
     language: {
        search: "",
         "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
     },
    "sDom": '<"mot"f><"xot"l>rt<"bottom"pi><"clear">'
  } );
} );
    
$(document).ready( function() {
  $('#example2').dataTable( {
     language: {
        search: "",
         "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
     },
    "sDom": '<"mot"f><"xot"l>rt<"bottom"pi><"clear">'
  } );
} );
    
    
</script>

</body>

</html>
