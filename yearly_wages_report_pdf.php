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
$currentyear = date('Y');

$pdf = new FPDF("L","mm","A4");
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();
$pdf->SetFont("Arial","", 10);

//count first **
$query=@mysqli_query($conn,"select * from employee_info");
$count = 0;
while($data=@mysqli_fetch_array($query)) {
	$count = $count+1;
}

//count employee
$pdf->Cell (0,5,"Employee: " . $count . " selected",0,1,"L");

//date & admin
$pdf->Cell (0,5,$currentdate,0,1,"R");
$pdf->Cell (0,5,"ADMIN",0,1,"R");

//report title
$pdf->SetFont("Arial","", 20);
$pdf->Cell (0,20,"Yearly Wages",0,1,"C");

//yearly wages header
$pdf->SetFont("Arial","", 9);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (50,7,'Employee Name',"TB",0);
$pdf->Cell (17,7,'Jan-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Feb-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Mar-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Apr-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'May-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Jun-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Jul-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Aug-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Sep-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Oct-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Nov-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Dec-' . $currentyear,"TB",0);
$pdf->Cell (17,7,'Total',"RTB",1);

//yearly wages data from sql**
$query=@mysqli_query($conn,"select * from employee_info");
while($data=@mysqli_fetch_array($query)) {
	$pdf->Cell (10,7,$data["emp_id"],0,0);
	$pdf->Cell (50,7,$data["emp_full_name"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,$data["emp_wages"],0,0);
	$pdf->Cell (17,7,'Total',0,1);
}

//yearly wages totals **
$pdf->SetFont("Arial","B", 9);

$pdf->Cell (10,7,'',0,0);
$pdf->Cell (50,7,'Grand Total',0,0);
$pdf->Cell (17,7,'vpn',"TB",0);
$pdf->Cell (17,7,'poonhub',"TB",0);
$pdf->Cell (17,7,'xvideos',"TB",0);
$pdf->Cell (17,7,'spankbank',"TB",0);
$pdf->Cell (17,7,'sisluvsme',"TB",0);
$pdf->Cell (17,7,'gg',"TB",0);
$pdf->Cell (17,7,'japanese',"TB",0);
$pdf->Cell (17,7,'italy',"TB",0);
$pdf->Cell (17,7,'premium',"TB",0);
$pdf->Cell (17,7,'sien',"TB",0);
$pdf->Cell (17,7,'hendai',"TB",0);
$pdf->Cell (17,7,'hamsap',"TB",0);
$pdf->Cell (17,7,'Total',"TB",1);
	
$pdf->Output();
?>