<?php
require("fpdf/fpdf.php");
session_start();
include "conn.php";
  if(empty($_SESSION["username"])){
      header("location:index.php");
  }
  $username = $_SESSION["username"];
    $get_month = $_GET["month"];
	$date_obj  = DateTime::createFromFormat('!m', $get_month);
	$month_name = $date_obj->format('F');

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
$pdf->Cell (0,10,"EIS Contribution Listing",0,1,"C");
$pdf->Cell (0,10,"As At " . $month_name . " " . $get_year,0,1,"C");

//eis header
$pdf->SetFont("Arial","", 10);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (150,7,'Employee Name',"TB",0);
$pdf->Cell (30,7,'Remuneration',"TB",0,"R");
$pdf->Cell (30,7,'Employee',"TB",0,"R");
$pdf->Cell (30,7,'Employer',"TB",0,"R");
$pdf->Cell (30,7,'Total',"RTB",1,"R");

//eis data from sql **
$query=@mysqli_query($conn,"SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year'");
$count = 0;
$total_wages = 0;
$total_employee_deduction = 0;
$total_employer_deduction = 0;
$format_total_wages = 0;
$format_total_employee_deduction = 0;
$format_total_employer_deduction = 0;

while($data=@mysqli_fetch_array($query)) {
    $eis_employee_wages = $data["emp_wages"];
    $eis_employee_deduction = $data["eis_employee_deduction"];
    $eis_employer_deduction = $data["eis_employer_deduction"];
    $eis_employee_deduction_total = $eis_employee_deduction + $eis_employer_deduction;
	$format_eis_employee_deduction_total = number_format("$eis_employee_deduction_total",2);
	$pdf->Cell (10,7,$data["emp_id"],0,0);
	$pdf->Cell (150,7,$data["emp_full_name"],0,0);
	$pdf->Cell (30,7,$eis_employee_wages,0,0,"R");
	$pdf->Cell (30,7,$eis_employee_deduction,0,0,"R");
	$pdf->Cell (30,7,$eis_employer_deduction,0,0,"R");
	$pdf->Cell (30,7,$format_eis_employee_deduction_total,0,1,"R");
	$count = $count+1;
    $total_wages = $total_wages + $eis_employee_wages;
	$format_total_wages = number_format("$total_wages",2);
	
    $total_employee_deduction = $total_employee_deduction + $eis_employee_deduction;
	$format_total_employee_deduction = number_format("$total_employee_deduction",2);
	
    $total_employer_deduction = $total_employer_deduction + $eis_employer_deduction;  
	$format_total_employer_deduction = number_format("$total_employer_deduction",2);
	
}
$all_total = $total_employee_deduction + $total_employer_deduction;
$format_all_total = number_format("$all_total",2);
//eis totals **
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (150,7,'',0,0);
$pdf->Cell (30,7,$format_total_wages,"TB",0,"R");
$pdf->Cell (30,7,$format_total_employee_deduction,"TB",0,"R");
$pdf->Cell (30,7,$format_total_employer_deduction,"TB",0,"R");
$pdf->Cell (30,7,$format_all_total,"TB",1,"R");

//count of records
$pdf->SetFont("Arial","", 11);
$pdf->Cell (35,5,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>