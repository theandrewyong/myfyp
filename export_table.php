<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
$output = '';

//export epf
if(isset($_POST["export_epf"])){
	$select_epf = "SELECT * FROM epf_formula";
	$result_epf = mysqli_query($conn, $select_epf);
	
	if(mysqli_num_rows($result_epf)>0){
		$output .= '
		<table class="table" border="1">
			<tr>
				<th>EPF Row ID</th>
				<th>EPF Table Year</th>
				<th>EPF Table Month</th>
				<th>Employee Wage Start</th>
				<th>Employee Wage End</th>
				<th>Employee Contribution</th>
				<th>Employer Contribution</th>
			</tr>
		';
	}
	
	while ($row = mysqli_fetch_array($result_epf)){
		$format_epf_start = number_format($row["epf_formula_wage_start"],2);
		$format_epf_end = number_format($row["epf_formula_wage_end"],2);
		$format_epf_employee = number_format($row["epf_formula_employee_amt"],2);
		$format_epf_employer = number_format($row["epf_formula_employer_amt"],2);
		
		$output .= '
			<tr>
				<td>' .$row["epf_formula_id"]. '</td>
				<td>' .$row["epf_formula_year"]. '</td>
				<td>' .$row["epf_formula_month"]. '</td>
				<td>' .$format_epf_start. '</td>
				<td>' .$format_epf_end. '</td>
				<td>' .$format_epf_employee. '</td>
				<td>' .$format_epf_employer. '</td>
			</tr>
		';
	}
	$output .= '</table>';
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=epf_table.xls");
	echo $output;
}

//export socso
if(isset($_POST["export_socso"])){
	
	$select_socso = "SELECT * FROM socso_formula";
	$result_socso = mysqli_query($conn, $select_socso);
	
	if(mysqli_num_rows($result_socso)>0){
		$output .= '
		<table class="table" border="1">
			<tr>
				<td>SOCSO Row ID</td>
				<td>Start With</td>
				<td>End With</td>
				<td>Employee Share 1st Category</td>
				<td>Employer Share 1st Category</td>
				<td>Total 1st Category</td>
				<td>Employer Contribution 2nd Category</td>
			</tr>
		';
	}
	
	while ($row = mysqli_fetch_array($result_socso)){
		$format_socso_start = number_format($row["socso_formula_wage_start"],2);
		$format_socso_end = number_format($row["socso_formula_wage_end"],2);
		$format_socso_employee = number_format($row["socso_formula_employee_amt"],2);
		$format_socso_employer = number_format($row["socso_formula_employer_amt"],2);
		$format_socso_total = number_format($row["socso_formula_total"],2);
		$format_socso_contribution = number_format($row["socso_formula_employer_contribution"],2);
		
		$output .= '
			<tr>
				<td>' .$row["socso_formula_id"]. '</td>
				<td>' .$format_socso_start. '</td>
				<td>' .$format_socso_end. '</td>
				<td>' .$format_socso_employee. '</td>
				<td>' .$format_socso_employer. '</td>
				<td>' .$format_socso_total. '</td>
				<td>' .$format_socso_contribution. '</td>
			</tr>
		';
	}
	
	$output .= '</table>';
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=socso_table.xls");
	echo $output;
}

//export eis
if(isset($_POST["export_eis"])){
	
	$select_eis = "SELECT * FROM eis_formula";
	$result_eis = mysqli_query($conn, $select_eis);
	
	if(mysqli_num_rows($result_eis)>0){
		
		$output .= '
		<table class="table" border="1">
			<tr>
				<td>EIS Row ID</td>
				<td>Start With</td>
				<td>End With</td>
				<td>Employee EIS</td>
				<td>Employer EIS</td>
				<td>Total</td>
			</tr>
		';
	}
	
	while ($row = mysqli_fetch_array($result_eis)){
		$format_eis_start = number_format ($row["eis_formula_wage_start"],2);
		$format_eis_end = number_format ($row["eis_formula_wage_end"],2);
		$format_eis_employee = number_format ($row["eis_formula_employee_amt"],2);
		$format_eis_employer = number_format ($row["eis_formula_employer_amt"],2);
		$format_eis_total = number_format ($row["eis_formula_total"],2);
		
		$output .= '
			<tr>
				<td>' .$row["eis_formula_id"]. '</td>
				<td>' .$format_eis_start. '</td>
				<td>' .$format_eis_end. '</td>
				<td>' .$format_eis_employee. '</td>
				<td>' .$format_eis_employer. '</td>
				<td>' .$format_eis_total. '</td>
			</tr>
		';
	}
	$output .= '</table>';
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=eis_table.xls");
	echo $output;
}
?>