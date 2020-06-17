<?php
include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}
?>

<h1>EPF calculations</h1>
<?php
//Select employee data from employee_info table and EIS data from eis_formula table
$payroll_sql = "SELECT employee_info.emp_id, employee_info.emp_full_name, employee_info.emp_wages, eis_formula.eis_formula_employee_amt, eis_formula.eis_formula_employer_amt FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id INNER JOIN eis_formula ON process_payroll.eis_formula_id = eis_formula.eis_formula_id";

//Prepare data for insert
$prepared_stmt_insert = mysqli_prepare($conn, $payroll_sql);
mysqli_stmt_execute($prepared_stmt_insert);
$result = $prepared_stmt_insert->get_result(); 
$data = $result->fetch_assoc();

$total = $data["eis_formula_employee_amt"] + $data["eis_formula_employer_amt"];

//Display data
echo '<table border="1">';
echo '<tr>';
echo '<td>' . $data["emp_id"] . '</td>';
echo '<td>' . $data["emp_full_name"] . '</td>';
echo '<td>' . number_format($data["emp_wages"], 2 ) . '</td>';
echo '<td>' . number_format($data["eis_formula_employee_amt"], 2 ) . '</td>';
echo '<td>' . number_format($data["eis_formula_employer_amt"], 2 ) . '</td>';
echo '<td>' . number_format($total, 2) . '</td>';
echo '</tr>';
echo '</table>';
?>