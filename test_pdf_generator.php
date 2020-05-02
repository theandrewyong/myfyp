<?php
require("fpdf/fpdf.php");
session_start();
include "conn.php";
  if(empty($_SESSION["username"])){
      header("location:index.php");
  }
  $username = $_SESSION["username"];

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
$pdf->Cell (0,10,"EPF Contribution Listing",0,1,"C");
$pdf->Cell (0,10,"As At " . $currentmonthyeaer,0,1,"C");

//epf header
$pdf->SetFont("Arial","", 10);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (150,7,'Employee Name',"TB",0);
$pdf->Cell (30,7,'Wages',"TB",0);
$pdf->Cell (30,7,'Employee',"TB",0);
$pdf->Cell (30,7,'Employer',"TB",0);
$pdf->Cell (30,7,'Total',"RTB",1);

//epf data from sql
$query=@mysqli_query($conn,"select * from employee_info");
$count = 0;
while($data=@mysqli_fetch_array($query)) {
	$pdf->Cell (10,7,$data["emp_id"],0,0);
	$pdf->Cell (150,7,$data["emp_full_name"],0,0);
	$pdf->Cell (30,7,$data["emp_wages"],0,0);
	$pdf->Cell (30,7,$data["emp_total_allowance"],0,0);
	$pdf->Cell (30,7,$data["emp_total_deduction"],0,0);
	$pdf->Cell (30,7,$data["emp_mobile"],0,1);
	$count = $count+1;
}

//epf totals
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (150,7,'',0,0);
$pdf->Cell (30,7,'Total W',"TB",0);
$pdf->Cell (30,7,'Total Em',"TB",0);
$pdf->Cell (30,7,'Total Er',"TB",0);
$pdf->Cell (30,7,'Total',"TB",1);

//count of records
$pdf->SetFont("Arial","", 11);
$pdf->Cell (35,5,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>