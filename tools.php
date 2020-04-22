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

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">

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
<h1 class="mt-4">Tools</h1>
<hr>
    
<!-- EPF table -->
<h2>EPF Rate Table</h2>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
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
                $sql = "SELECT * FROM epf_formula";
                $prepared_stmt_insert = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($prepared_stmt_insert);
                $result = $prepared_stmt_insert->get_result(); 
                if($result->num_rows > 0) { 
                    while ($data = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $data["epf_formula_wage_start"] . '</td>';
                        echo '<td>' . $data["epf_formula_wage_end"] . '</td>';
                        echo '<td>' . $data["epf_formula_employee_epf"] . '</td>';
                        echo '<td>' . $data["epf_formula_employer_epf"] . '</td>';
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
        
<!-- SOCSO table -->
<h2>SOCSO Rate Table</h2>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
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
                        echo '<td>' . $data["socso_total_amt"] . '</td>';
                        echo '<td>' . $data["socso_employer_contribution_amt"] . '</td>';
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
    
<!-- EIS table -->
<h2>EIS Rate Table</h2>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
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
                        echo '<td>' . $data["eis_formula_employer_amt"] . '</td>';
                        echo '<td>' . $data["eis_formula_total_amt"] . '</td>';
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

</body>

</html>
