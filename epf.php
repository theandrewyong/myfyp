<?php
include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}
?>
<h1>EPF calculations</h1>
<?php
$payroll_sql = "SELECT process_payroll.process_payroll_id, epf_formula.epf_formula_id, employee_info.emp_id, employee_info.emp_full_name, employee_info.emp_wages, epf_formula.epf_formula_employee_amt, epf_formula.epf_formula_employer_amt FROM process_payroll INNER JOIN epf_formula ON process_payroll.epf_formula_id = epf_formula.epf_formula_id INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id";

$prepared_stmt_insert = mysqli_prepare($conn, $payroll_sql);
mysqli_stmt_execute($prepared_stmt_insert);
$result = $prepared_stmt_insert->get_result(); 
$data = $result->fetch_assoc();

$total = $data["epf_formula_employee_amt"] + $data["epf_formula_employer_amt"];

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