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
<h1 class="mt-4">Views</h1>
<hr>
    <div class="p-5 bg-white rounded shadow mb-5">
    <!-- Rounded tabs -->
        <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
            <li class="nav-item flex-sm-fill">
                <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">EPF table</a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">SOCSO table</a>
            </li>
            <li class="nav-item flex-sm-fill">
                <a id="profile1-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile1" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">EIS table</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
                <!-- EPF table -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2">Wages</th>
                                        <th colspan="2">EPF</th>
                                    </tr>
                                    <tr>
                                        <td>Start With</td>
                                        <td>End With</td>
                                        <td>Employee EPF</td>
                                        <td>Employer EPF</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $epf_formula_sql = "SELECT * FROM epf_formula";
                                $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $epf_formula_sql);
                                mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
                                $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 
                                if($epf_result->num_rows > 0) { 
                                    while ($data = $epf_result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $data["epf_formula_wage_start"] . '</td>';
                                        echo '<td>' . $data["epf_formula_wage_end"] . '</td>';
                                        echo '<td>' . $data["epf_formula_employee_amt"] . '</td>';
                                        echo '<td>' . $data["epf_formula_employer_amt"] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>            
                                </tbody>
                            </table>
                        </div>        
                    </div>
                </div>    
                <!-- EPF table end -->
            </div>
            <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                <!-- SOCSO table -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="example3" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2">Wages</th>
                                        <th colspan="3">First Category</th>
                                        <th>Second Category</th>
                                    </tr>
                                    <tr>
                                        <td>Start With</td>
                                        <td>End With</td>
                                        <td>Employee Share</td>
                                        <td>Employer Share</td>
                                        <td>Total</td>
                                        <td>Employer Contribution</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM socso_formula";
                                $prepared_stmt_insert = mysqli_prepare($conn, $sql);
                                mysqli_stmt_execute($prepared_stmt_insert);
                                $result = $prepared_stmt_insert->get_result(); 
                                if($result->num_rows > 0) { 
                                    while ($data = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $data["socso_formula_wage_start"] . '</td>';
                                        echo '<td>' . $data["socso_formula_wage_end"] . '</td>';
                                        echo '<td>' . $data["socso_formula_employee_amt"] . '</td>';
                                        echo '<td>' . $data["socso_formula_employer_amt"] . '</td>';
                                        echo '<td>' . $data["socso_formula_total"] . '</td>';
                                        echo '<td>' . $data["socso_formula_employer_contribution"] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>            
                                </tbody>
                            </table>
                        </div>        
                    </div>
                </div>    
                <!-- SOCSO table end --> 
            </div>
            <div id="profile1" role="tabpanel" aria-labelledby="profile1-tab" class="tab-pane fade px-4 py-5">
                <!-- EIS table -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="2">Wages</th>
                                        <th colspan="3">EIS</th>
                                    </tr>
                                    <tr>
                                        <td>Start With</td>
                                        <td>End With</td>
                                        <td>Employee EIS</td>
                                        <td>Employer EIS</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM eis_formula";
                                $prepared_stmt_insert = mysqli_prepare($conn, $sql);
                                mysqli_stmt_execute($prepared_stmt_insert);
                                $result = $prepared_stmt_insert->get_result(); 
                                if($result->num_rows > 0) { 
                                    while ($data = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $data["eis_formula_wage_start"] . '</td>';
                                        echo '<td>' . $data["eis_formula_wage_end"] . '</td>';
                                        echo '<td>' . $data["eis_formula_employee_amt"] . '</td>';
                                        echo '<td>' . $data["eis_formula_employee_amt"] . '</td>';
                                        echo '<td>' . $data["eis_formula_employer_amt"] . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>            
                                </tbody>
                            </table>
                        </div>        
                    </div>
                </div>    
                <!-- EIS table end -->   
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
    
$(document).ready( function() {
  $('#example3').dataTable( {
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
