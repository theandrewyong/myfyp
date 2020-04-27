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

<title>Payroll Software - Maintain Employee</title>

<?php include "all_css.php"; ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
<h1 class="mt-4">Maintain Employee</h1>
<hr>
            <div class="p-5 bg-white rounded shadow mb-5">
            <!-- Rounded tabs -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Employee</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Allowance</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Deduction</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
    <div class="row">
        <div class="col-12">
        <div class="table-responsive">
        <div class="container-fluid">
          <br>

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
                            <th>Edit</th>
                            <th>Employee Position</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                <?php
                  if($datarows = mysqli_num_rows($select_sql) > 0){
                    while($data = mysqli_fetch_assoc($select_sql)){
                      echo "<tr>";
                      echo "<td>" . $data["emp_id"] . "</td>";
                      echo "<td>" . $data["emp_full_name"] . "</td>";
                      echo "<td>" . '<a href="editemployee.php?emp_id=' . $data["emp_id"] . '">Edit</a>' . "</td>";
                       echo "<td>" . $data["emp_title"] . "</td>";
                    
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
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Permission Level</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                                    $select_all_sql = mysqli_query($conn, "SELECT * FROM account");
                                    while($data = mysqli_fetch_assoc($select_all_sql)){
                                    echo "<tr>";
                                    echo "<td>" . "1" . "</td>";
                                    echo "<td>" . $data["username"] . "</td>";
                                    echo "<td>" . $data["permission"] . "</td>";
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

	<div class="p-5 bg-white rounded shadow mb-5">
        <div class="row">
            <div class="col-3">
               
            </div>

            <div class="col-3">
                <a href="addallowance.php" class="btn btn-success" role="button">Add Allowance</a>
            </div>

            <div class="col-3">
                <a href="adddeduction.php" class="btn btn-success" role="button">Add Deduction</a>
            </div>
        </div>

    </div>
        
      
   
</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
    
<!-- footer here -->
<?php include "footer.php"; ?>   
<style>
    .mot {
        margin-top: 10px;
        float:left;
        clear: both;
    }   
    
    .xot {
        float: right;
    }
    
</style>
<!-- Bootstrap core JavaScript -->
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
    
    
</script>

</body>

</html>
