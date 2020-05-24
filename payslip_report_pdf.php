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
$pdf->Cell (0,4.5,"Payslip for " . $month_name . " " . $get_year,0,1,"C");

//company name
$pdf->SetFont("Arial","B", 11);
$pdf->Cell (0,4.5,"Smartsoft Co. ",0,1,"L");	

//employee details **
$query=@mysqli_query($conn,"select process_payroll.*, employee_info.* from process_payroll inner join employee_info on process_payroll.emp_id = employee_info.emp_id where process_payroll.emp_id='$dd' and process_payroll.process_payroll_process_month = '$get_month' and process_payroll.process_payroll_process_year = '$get_year'");

$data=@mysqli_fetch_array($query);

$pdf->SetFont("Arial","", 9);
$pdf->Cell (0,4.5,"Employee Name: " . $data["emp_full_name"],0,0,"L");
$pdf->Cell (0,4.5,"Date Joined: " . $data["emp_join_date"],0,1,"R");
$pdf->Cell (0,4.5,"IC Number: " . $data["emp_ic"],0,0,"L");
$pdf->Cell (0,4.5,"Bank A/C: " . $data["emp_account"],0,1,"R");

//payslip header
$pdf->Cell (0,1,"",0,1,"L");
$pdf->SetFont("Arial","", 9);

$pdf->Cell (60,4.5,'	GROSS EARNING',"1",0);
$pdf->Cell (35,4.5,'Amount (RM)',"TB",0,"C");
$pdf->Cell (60,4.5,'	DEDUCTIONS',"1",0);
$pdf->Cell (35,4.5,'Amount (RM)',"1",1,"C");

//payslip data from sql**
$pdf->Cell (60,4.5,'	Basic Salary',"L",0);
$pdf->Cell (35,4.5,$data["process_payroll_wage"],"LR",0,"C"); //**
$pdf->Cell (60,4.5,'	EPF (EMPLOYEE)',"0",0);
$pdf->Cell (35,4.5,$data["epf_employee_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4.5,'',"L",0);
$pdf->Cell (35,4.5,'',"LR",0,"C");
$pdf->Cell (60,4.5,'	SOCSO (EMPLOYEE)',"0",0);
$pdf->Cell (35,4.5,$data["socso_employee_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4.5,'',"L",0);
$pdf->Cell (35,4.5,'',"LR",0,"C");
$pdf->Cell (60,4.5,'	EIS (EMPLOYEE)',"0",0);
$pdf->Cell (35,4.5,$data["eis_employee_deduction"],"LR",1,"C");//**

if($data["process_payroll_allowance"] != 0.00){
	$pdf->Cell (60,4.5,'		Allowance',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_allowance"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_overtime"] != 0.00){
	$pdf->Cell (60,4.5,'		Overtime',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_overtime"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_commission"] != 0.00){
	$pdf->Cell (60,4.5,'		Commission',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_commission"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_claims"] != 0.00){
	$pdf->Cell (60,4.5,'		Claims',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_claims"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

if($data["process_payroll_director_fees"] != 0.00){
	$pdf->Cell (60,4.5,'		Director Fees',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_director_fees"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

if($data["process_payroll_advance_paid"] != 0.00){
	$pdf->Cell (60,4.5,'		Advance Paid',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_advance_paid"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_bonus"] != 0.00){
	$pdf->Cell (60,4.5,'		Bonus',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_bonus"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_others"] != 0.00){
	$pdf->Cell (60,4.5,'		Others',"L",0);
	$pdf->Cell (35,4.5,$data["process_payroll_others"],"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_deduction"] != 0.00){
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'		Deduction',"0",0);
	$pdf->Cell (35,4.5,$data["process_payroll_deduction"],"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_loan"] != 0.00){
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'		Loan',"0",0);
	$pdf->Cell (35,4.5,$data["process_payroll_loan"],"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

if($data["process_payroll_unpaid_leave"] != 0.00){
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'		Unpaid Leave',"0",0);
	$pdf->Cell (35,4.5,$data["process_payroll_unpaid_leave"],"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}
	
if($data["process_payroll_advance_deduct"] != 0.00){
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'		Advance Deduct',"0",0);
	$pdf->Cell (35,4.5,$data["process_payroll_advance_deduct"],"LR",1,"C");
}
	
else {
	$pdf->Cell (60,4.5,'',"L",0);
	$pdf->Cell (35,4.5,'',"LR",0,"C");//**
	$pdf->Cell (60,4.5,'',"0",0);
	$pdf->Cell (35,4.5,'',"LR",1,"C");
}

$total_earnings = $data["process_payroll_wage"]+ $data["process_payroll_overtime"]+ $data["process_payroll_commission"]+ $data["process_payroll_allowance"]+ $data["process_payroll_claims"]+ $data["process_payroll_director_fees"]+ $data["process_payroll_advance_paid"]+ $data["process_payroll_bonus"]+ $data["process_payroll_others"];
$format_total_earnings = number_format("$total_earnings",2);
	
$pdf->Cell (60,4.5,'	TOTAL EARNINGS',"1",0);
$pdf->Cell (35,4.5,$format_total_earnings,"TB",0,"C");

$total_deductions = $data["epf_employee_deduction"]+ $data["socso_employee_deduction"]+ $data["eis_employee_deduction"]+ $data["process_payroll_deduction"]+ $data["process_payroll_loan"]+ $data["process_payroll_unpaid_leave"]+ $data["process_payroll_advance_deduct"];
$format_total_deductions = number_format("$total_deductions",2);
	
$pdf->Cell (60,4.5,'	TOTAL DEDUCTIONS',"1",0);
$pdf->Cell (35,4.5,$format_total_deductions,"1",1,"C");//need to store in sql for 2 deci
	
$pdf->Cell (60,6,'	Adjustments',"L",0);
$pdf->Cell (35,6,$data["process_payroll_adjustment"],"LR",0,"C");
$pdf->Cell (60,6,'	EPF',"",0);
$pdf->Cell (35,6,$data["epf_employer_deduction"],"LR",1,"C");

$nett_pay = $total_earnings - $total_deductions + $data["process_payroll_adjustment"];
$format_nett_pay = number_format("$nett_pay",2);
	
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (60,4.5,'	NETT PAY',"L",0);
$pdf->Cell (35,4.5,$format_nett_pay,"LR",0,"C");//**
$pdf->SetFont("Arial","", 9);
$pdf->Cell (60,4.5,'	SOCSO',"0",0);
$pdf->Cell (35,4.5,$data["socso_employer_deduction"],"LR",1,"C");//**

$pdf->Cell (60,4.5,'',"LB",0);
$pdf->Cell (35,4.5,'',"LRB",0,"C");
$pdf->Cell (60,4.5,'	EIS',"B",0);
$pdf->Cell (35,4.5,$data["eis_employer_deduction"],"LRB",1,"C");//**

$pdf->Cell (0,10,"",0,1,"L");
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (0,5,'____________________________________________',"0",1,"R");
$pdf->Cell (0,4.5,'Employee Signature',"0",1,"R");
$pdf->Cell (0,3,"",0,1,"L");

$loopcount = $loopcount + 1;
if ($loopcount%2){
	$pdf->AddPage();
}
}


$pdf->Output();
?>