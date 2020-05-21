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

$dateObj   = DateTime::createFromFormat('!m', $get_month);
$month_name = $dateObj->format('F'); // March

date_default_timezone_set("Asia/Kuching");
$currentdate = date('m/d/Y h:i:s a', time());

$pdf = new FPDF("P","mm","A4");
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();
$pdf->SetFont("Arial","", 11);

$select_all_process = mysqli_query($conn,"select * from process_adhoc");

while($select_emp_process = mysqli_fetch_assoc($select_all_process)){
	$emp_id = $select_emp_process["emp_id"];
	$emp_id_array[] = $emp_id;
}

$emp_unique_id = array_unique ($emp_id_array);

$loopcount = 1;
foreach ($emp_unique_id as $dd) {
//title 
$pdf->SetFont("Arial","B", 15);
$pdf->Cell (0,6,"Adhoc Payslip for " . $month_name . " " . $get_year,0,1,"C");

//company name
$pdf->SetFont("Arial","B", 11);
$pdf->Cell (0,6,"Smartsoft Co. ",0,1,"L");	

//employee details **
$query=@mysqli_query($conn,"select process_adhoc.*, employee_info.* from process_adhoc inner join employee_info on process_adhoc.emp_id = employee_info.emp_id where process_adhoc.emp_id='$dd' and process_adhoc.process_adhoc_process_month = '$get_month'");

$data=@mysqli_fetch_array($query);

$pdf->SetFont("Arial","", 9);
$pdf->Cell (0,6,"Employee Name: " . $data["emp_full_name"],0,0,"L");
$pdf->Cell (0,6,"Date Joined: " . $data["emp_join_date"],0,1,"R");
$pdf->Cell (0,6,"IC Number: " . $data["emp_ic"],0,0,"L");
$pdf->Cell (0,6,"Bank A/C: " . $data["emp_account"],0,1,"R");

//payslip header
$pdf->Cell (0,1,"",0,1,"L");
$pdf->SetFont("Arial","", 9);

$pdf->Cell (60,6,'	GROSS EARNING',"1",0);
$pdf->Cell (35,6,'Amount (RM)',"TB",0,"C");
$pdf->Cell (60,6,'	DEDUCTIONS',"1",0);
$pdf->Cell (35,6,'Amount (RM)',"1",1,"C");

//payslip data from sql**
$pdf->Cell (60,10,'	Bonus',"L",0);
$pdf->Cell (35,10,$data["adhoc_amt"],"LR",0,"C"); //**
$pdf->Cell (60,10,'	EPF (EMPLOYEE)',"0",0);
$pdf->Cell (35,10,$data["epf_employee_deduction"],"LR",1,"C");//**

$nett_pay = $data["adhoc_amt"] - $data["epf_employee_deduction"];
$format_nett_pay = number_format("$nett_pay",2);
	
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (60,10,'	NETT PAY',"LB",0);
$pdf->Cell (35,10,$format_nett_pay,"LRB",0,"C");//**
$pdf->SetFont("Arial","", 9);
$pdf->Cell (60,10,'	EPF (EMPLOYER)',"B",0);
$pdf->Cell (35,10,$data["epf_employer_deduction"],"LRB",1,"C");//**

$pdf->Cell (0,10,"",0,1,"L");
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (0,5,'____________________________________________',"0",1,"R");
$pdf->Cell (0,6,'Employee Signature',"0",1,"R");
$pdf->Cell (0,3,"",0,1,"L");

if ($loopcount%3 && $loopcount!=1){
	$pdf->AddPage();
}
$loopcount = $loopcount + 1;
}


$pdf->Output();
?>