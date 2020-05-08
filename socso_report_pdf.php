<?php
require("fpdf/fpdf.php");
session_start();
include "conn.php";
  if(empty($_SESSION["username"])){
      header("location:index.php");
  }
  $username = $_SESSION["username"];
    $get_month = $_GET["month"];
    $get_year = $_GET["year"];

date_default_timezone_set("Asia/Kuching");
$currentdate = date('m/d/Y h:i:s a', time());
$currentmonthyeaer = date('M Y');

$pdf = new FPDF("L","mm","A4");
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();
$pdf->SetFont("Arial","", 10);

//date & admin
$pdf->Cell (0,5,$currentdate,0,1,"R");
$pdf->Cell (0,5,"ADMIN",0,1,"R");

//report title
$pdf->SetFont("Arial","", 20);
$pdf->Cell (0,10,"SOCSO Contribution Listing",0,1,"C");
$pdf->Cell (0,10,"As At " . $currentmonthyeaer,0,1,"C");

//socso header
$pdf->SetFont("Arial","", 10);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (150,7,'Employee Name',"TB",0);
$pdf->Cell (30,7,'Remuneration',"TB",0);
$pdf->Cell (30,7,'Employee',"TB",0);
$pdf->Cell (30,7,'Employer',"TB",0);
$pdf->Cell (30,7,'Total',"RTB",1);

//socso data from sql **
$query=@mysqli_query($conn,"SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year'");
$count = 0;
$total_wages = 0;
$total_employee_deduction = 0;
$total_employer_deduction = 0;
while($data=@mysqli_fetch_array($query)) {
    $socso_employee_wages = $data["emp_wages"];
    $socso_employee_deduction = $data["socso_employee_deduction"];
    $socso_employer_deduction = $data["socso_employer_deduction"];
    $socso_employee_deduction_total = $socso_employee_deduction + $socso_employer_deduction;    
	$pdf->Cell (10,7,$data["emp_id"],0,0);
	$pdf->Cell (150,7,$data["emp_full_name"],0,0);
	$pdf->Cell (30,7,$socso_employee_wages,0,0);
	$pdf->Cell (30,7,$socso_employee_deduction,0,0);
	$pdf->Cell (30,7,$socso_employer_deduction,0,0);
	$pdf->Cell (30,7,$socso_employee_deduction_total,0,1);
	$count = $count+1;
    $total_wages = $total_wages + $socso_employee_wages;
    $total_employee_deduction = $total_employee_deduction + $socso_employee_deduction;
    $total_employer_deduction = $total_employer_deduction + $socso_employer_deduction;    
}
$all_total = $total_employee_deduction + $total_employer_deduction;

//socso totals **
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (150,7,'',0,0);
$pdf->Cell (30,7,$total_wages,"TB",0);
$pdf->Cell (30,7,$total_employee_deduction,"TB",0);
$pdf->Cell (30,7,$total_employer_deduction,"TB",0);
$pdf->Cell (30,7,$all_total,"TB",1);

//count of records
$pdf->SetFont("Arial","", 11);
$pdf->Cell (35,5,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>