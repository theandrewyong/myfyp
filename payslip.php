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
<title>Payroll Software - Payslip Report</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Payslip</h1>
            <hr>
            <?php
            $payroll_sql = "SELECT employee_info.emp_full_name, employee_info.emp_wages, employee_info.emp_total_allowance, employee_info.emp_total_deduction, ";

            $prepared_stmt_insert = mysqli_prepare($conn, $payroll_sql);
            mysqli_stmt_execute($prepared_stmt_insert);
            $result = $prepared_stmt_insert->get_result(); 
            $data = $result->fetch_assoc();

            $total = $data["employee"] + $data["epf_formula_employer_amt"];

            echo '<table border="1">';
            echo '<tr>';
            echo '<td>' . $data["emp_id"] . '</td>';
            echo '<td>' . $data["emp_full_name"] . '</td>';
            echo '<td>' . number_format($data["emp_wages"], 2 ) . '</td>';
            echo '<td>' . number_format($data["epf_formula_employee_amt"], 2 ) . '</td>';
            echo '<td>' . number_format($data["epf_formula_employer_amt"], 2 ) . '</td>';
            echo '<td>' . number_format($total, 2) . '</td>';
            echo '</tr>';
            echo '</table>';
            ?>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
</body>
</html>