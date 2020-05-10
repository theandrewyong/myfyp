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
$pdf->SetFont("Arial","", 10);

$select_all_process = mysqli_query($conn,"select * from process_payroll");

while($select_emp_process = mysqli_fetch_assoc($select_all_process)){
	$emp_id = $select_emp_process["emp_id"];
	$emp_id_array[] = $emp_id;
}

$emp_unique_id = array_unique ($emp_id_array);

$loopcount = 1;
foreach ($emp_unique_id as $dd) {
//title 
$pdf->SetFont("Arial","B", 15);
$pdf->Cell (0,4,"Payslip for " . $month_name . " " . $get_year,0,1,"C");

//company name
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (0,4,"Smartsoft Co. ",0,1,"L");	

//employee details **
$query=@mysqli_query($conn,"select process_payroll.*, employee_info.* from process_payroll inner join employee_info on process_payroll.emp_id = employee_info.emp_id where process_payroll.emp_id='$dd' and process_payroll.process_payroll_process_month = '$get_month'");

$data=@mysqli_fetch_array($query);

$pdf->SetFont("Arial","", 7);
$pdf->Cell (0,4,"Employee Name: " . $data["emp_full_name"],0,0,"L");
$pdf->Cell (0,4,"Date Joined: " . $data["emp_join_date"],0,1,"R");
$pdf->Cell (0,4,"IC Number: " . $data["emp_ic"],0,0,"L");
$pdf->Cell (0,4,"Bank A/C: " . $data["emp_account"],0,1,"R");

//payslip header
$pdf->Cell (0,4,"",0,1,"L");
$pdf->SetFont("Arial","", 7);

$pdf->Cell (60,4,'	GROSS EARNING',"1",0);
$pdf->Cell (35,4,'Amount (RM)',"TB",0,"C");
$pdf->Cell (60,4,'	DEDUCTIONS',"1",0);
$pdf->Cell (35,4,'Amount (RM)',"1",1,"C");

//payslip data from sql**
$pdf->Cell (60,4,'	Basic Salary',"L",0);
$pdf->Cell (35,4,$data["process_payroll_wage"],"LR",0,"C"); //**
$pdf->Cell (60,4,'	EPF (EMPLOYEE)',"0",0);
$pdf->Cell (35,4,$data["epf_employee_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4,'',"L",0);
$pdf->Cell (35,4,'',"LR",0,"C");
$pdf->Cell (60,4,'	SOCSO (EMPLOYEE)',"0",0);
$pdf->Cell (35,4,$data["socso_employee_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4,'',"L",0);
$pdf->Cell (35,4,'',"LR",0,"C");
$pdf->Cell (60,4,'	EIS (EMPLOYEE)',"0",0);
$pdf->Cell (35,4,$data["eis_employee_deduction"],"LR",1,"C");//**

if(!empty($data["process_payroll_allowance"])){
	$pdf->Cell (60,4,'	Allowance',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_allowance"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}	
	
if(!empty($data["process_payroll_overtime"])){
	$pdf->Cell (60,4,'	Overtime',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_overtime"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}
	
if(!empty($data["process_payroll_commission"])){
	$pdf->Cell (60,4,'	Commission',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_commission"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}
	
if(!empty($data["process_payroll_claims"])){
	$pdf->Cell (60,4,'	Claims',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_claims"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}
	
if(!empty($data["process_payroll_director_fees"])){
	$pdf->Cell (60,4,'	Director Fees',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_director_fees"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}

if(!empty($data["process_payroll_advance_paid"])){
	$pdf->Cell (60,4,'	Advance Paid',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_advance_paid"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}
	
if(!empty($data["process_payroll_bonus"])){
	$pdf->Cell (60,4,'	Bonus',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_bonus"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}
	
if(!empty($data["process_payroll_others"])){
	$pdf->Cell (60,4,'	Others',"L",0);
	$pdf->Cell (35,4,$data["process_payroll_others"],"LR",0,"C");//**
	$pdf->Cell (60,4,'',"0",0);
	$pdf->Cell (35,4,'',"LR",1,"C");
}

$pdf->Cell (60,4,'	TOTAL EARNINGS',"1",0);
$pdf->Cell (35,4,$data["process_payroll_wage"]+ $data["process_payroll_overtime"]+ $data["process_payroll_commission"]+ $data["process_payroll_allowance"]+ $data["process_payroll_claims"]+ $data["process_payroll_director_fees"]+ $data["process_payroll_advance_paid"]+ $data["process_payroll_bonus"]+ $data["process_payroll_others"],"TB",0,"C");//**
	
$pdf->Cell (60,4,'	TOTAL DEDUCTIONS',"1",0);
$pdf->Cell (35,4,$data["epf_employee_deduction"]+ $data["socso_employee_deduction"]+ $data["eis_employee_deduction"],"1",1,"C");//**

$pdf->Cell (60,4,'',"L",0);
$pdf->Cell (35,4,'',"LR",0,"C");
$pdf->Cell (60,4,'	EMPLOYER TOTAL CONTRIBUTIONS',"B",0);
$pdf->Cell (35,4,'',"LR",1,"C");

$pdf->SetFont("Arial","B", 10);
$pdf->Cell (60,4,'	NETT PAY',"L",0);
$pdf->Cell (35,4,$data["process_payroll_net_pay"],"LR",0,"C");//**
$pdf->SetFont("Arial","", 7);
$pdf->Cell (60,4,'	EPF',"0",0);
$pdf->Cell (35,4,$data["epf_employer_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4,'',"L",0);
$pdf->Cell (35,4,'',"LR",0,"C");
$pdf->SetFont("Arial","", 7);
$pdf->Cell (60,4,'	SOCSO',"0",0);
$pdf->Cell (35,4,$data["socso_employer_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4,'',"LB",0);
$pdf->Cell (35,4,'',"LRB",0,"C");
$pdf->SetFont("Arial","", 7);
$pdf->Cell (60,4,'	EIS',"B",0);
$pdf->Cell (35,4,$data["eis_employer_deduction"],"LRB",1,"C");//**

//yearly wages totals **
$pdf->Cell (0,10,"",0,1,"L");
$pdf->SetFont("Arial","B", 7);
$pdf->Cell (0,4,'___________________________________________',"0",1,"R");
$pdf->Cell (0,4,'Employee Signature',"0",1,"R");
$pdf->Cell (0,4,"",0,1,"L");

$loopcount = $loopcount + 1;
if ($loopcount%2){
	$pdf->AddPage();
}
}


$pdf->Output();
?>