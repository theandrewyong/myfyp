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
$pdf->Cell (0,10,"Payroll Summary",0,1,"C");

$pdf->SetFont("Arial","B", 11);
$pdf->Cell (0,10,"Smartsoft Co. ",0,1,"L");

$get_info_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id");

$each_emp_wages = 0;

while($select_result = mysqli_fetch_assoc($get_info_sql)){
	$emp_id = $select_result["emp_id"];
	$emp_wages = $select_result["process_payroll_wage"];
	$emp_id_array[] = $emp_id;
	$each_emp_wages = $each_emp_wages + $emp_wages;           
}

$emp_id_unique = array_unique($emp_id_array);

//payroll summary header
$pdf->SetFont("Arial","", 8);

$pdf->Cell (40,7,'Employee Name',"LT",0);
$pdf->Cell (14.5,7,'Wages',"T","R",0);
$pdf->Cell (14.5,7,'Overtime',"T","R",0);
$pdf->Cell (17,7,'Commission',"T","R",0);
$pdf->Cell (14.5,7,'Allowance',"T","R",0);
$pdf->Cell (14.5,7,'Claims',"T","R",0);
$pdf->Cell (14.5,7,'Director',"T","R",0);
$pdf->Cell (14.5,7,'Advance',"T","R",0);
$pdf->Cell (14.5,7,'Bonus',"T","R",0);
$pdf->Cell (14.5,7,'Others',"T","R",0);
$pdf->Cell (14.5,7,'EPF',"T","R",0);
$pdf->Cell (14.5,7,'SOCSO',"T","R",0);
$pdf->Cell (14.5,7,'EIS',"T","R",0);
$pdf->Cell (14.5,7,'Deduction',"T","R",0);
$pdf->Cell (14.5,7,'Loan',"T","R",0);
$pdf->Cell (14.5,7,'Unpaid',"T","R",0);
$pdf->Cell (14.5,7,'Advance',"RT","R",0);
$pdf->Cell (14.5,7,'',"",1);

$pdf->Cell (40,3,'',"LB",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (17,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'Fees',"B","R",0);
$pdf->Cell (14.5,3,'Paid',"B","R",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'Leave',"B","R",0);
$pdf->Cell (14.5,3,'Deduct',"RB","R",0);
$pdf->Cell (14.5,3,'',"",1);

//variables for grand total
$grand_wage = 0;
$grand_overtime = 0;
$grand_commission = 0;
$grand_allowance = 0;
$grand_claims = 0;
$grand_director_fees = 0;
$grand_advance_paid = 0;
$grand_bonus = 0;
$grand_others = 0;
$grand_epf = 0;
$grand_socso = 0;
$grand_eis = 0;
$grand_deduction = 0;
$grand_loan = 0;
$grand_unpaid_leave = 0;
$grand_advance_deduct = 0;

//payroll summary data from sql 
$count = 0;
foreach($emp_id_unique as $eiu){
	//count the total wages for each employee
	$sql = mysqli_query($conn, "SELECT SUM(process_payroll_wage) AS sum_wage, SUM(process_payroll_allowance) AS sum_allowance, SUM(process_payroll_overtime) AS sum_overtime, SUM(process_payroll_commission) AS sum_commission, SUM(process_payroll_claims) AS sum_claims, SUM(process_payroll_director_fees) AS sum_director_fees, SUM(process_payroll_advance_paid) AS sum_advance_paid, SUM(process_payroll_bonus) AS sum_bonus, SUM(process_payroll_others) AS sum_others, SUM(epf_employee_deduction) AS sum_employee_epf, SUM(epf_employee_deduction) AS sum_epf, SUM(socso_employee_deduction) AS sum_socso, SUM(eis_employee_deduction) AS sum_eis, SUM(process_payroll_deduction) AS sum_deduction, SUM(process_payroll_loan) AS sum_loan, SUM(process_payroll_unpaid_leave) AS sum_unpaid_leave, SUM(process_payroll_advance_deduct) AS sum_advance_deduct FROM process_payroll WHERE emp_id = '$eiu'");

	$get_name_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$eiu'");
	$namesql = mysqli_fetch_assoc($get_name_sql);
	$usql = mysqli_fetch_assoc($sql);
	$emp_name = $namesql["emp_full_name"];
	$sum_wage = $usql["sum_wage"];
	$sum_overtime = $usql["sum_overtime"];
	$sum_commission = $usql["sum_commission"];
	$sum_allowance = $usql["sum_allowance"];
	$sum_claims = $usql["sum_claims"];
	$sum_director_fees = $usql["sum_director_fees"];
	$sum_advance_paid = $usql["sum_advance_paid"];
	$sum_bonus = $usql["sum_bonus"];
	$sum_others = $usql["sum_others"];
	$sum_epf = $usql["sum_epf"];
	$sum_socso = $usql["sum_socso"];
	$sum_eis = $usql["sum_eis"];
	$sum_deduction = $usql["sum_deduction"];
	$sum_loan = $usql["sum_loan"];
	$sum_unpaid_leave = $usql["sum_unpaid_leave"];
	$sum_advance_deduct = $usql["sum_advance_deduct"];
	
	$pdf->Cell (40,7,$emp_name,"",0);
	$pdf->Cell (14.5,7,$sum_wage,"","R",0);
	$pdf->Cell (14.5,7,$sum_overtime,"","R",0);
	$pdf->Cell (17,7,$sum_commission,"","R",0);
	$pdf->Cell (14.5,7,$sum_allowance,"","R",0);
	$pdf->Cell (14.5,7,$sum_claims,"","R",0);
	$pdf->Cell (14.5,7,$sum_director_fees,"","R",0);
	$pdf->Cell (14.5,7,$sum_advance_paid,"","R",0);
	$pdf->Cell (14.5,7,$sum_bonus,"","R",0);
	$pdf->Cell (14.5,7,$sum_others,"","R",0);
	$pdf->Cell (14.5,7,$sum_epf,"","R",0);
	$pdf->Cell (14.5,7,$sum_socso,"","R",0);
	$pdf->Cell (14.5,7,$sum_eis,"","R",0);
	$pdf->Cell (14.5,7,$sum_deduction,"","R",0);
	$pdf->Cell (14.5,7,$sum_loan,"","R",0);
	$pdf->Cell (14.5,7,$sum_unpaid_leave,"","R",0);
	$pdf->Cell (14.5,7,$sum_advance_deduct,"","R",0);
	$pdf->Cell (14.5,7,"","",1);
	
	$count = $count + 1;
	
	$grand_wage = $grand_wage + $sum_wage;
	$grand_overtime = $grand_overtime + $sum_overtime;
	$grand_commission = $grand_commission + $sum_commission;
	$grand_allowance = $grand_allowance + $sum_allowance;
	$grand_claims = $grand_claims + $sum_claims;
	$grand_director_fees = $grand_director_fees + $sum_director_fees;
	$grand_advance_paid = $grand_advance_paid + $sum_advance_paid;
	$grand_bonus = $grand_bonus + $sum_bonus;
	$grand_others = $grand_others + $sum_others;
	$grand_epf = $grand_epf + $sum_epf;
	$grand_socso = $grand_socso + $sum_socso;
	$grand_eis = $grand_eis + $sum_eis;
	$grand_deduction = $grand_deduction + $sum_deduction;
	$grand_loan = $grand_loan + $sum_loan;
	$grand_unpaid_leave = $grand_unpaid_leave + $sum_unpaid_leave;
	$grand_advance_deduct = $grand_advance_deduct + $sum_advance_deduct;
}

//format grand total
$format_grand_wage = number_format("$grand_wage",2);
$format_grand_overtime = number_format("$grand_overtime",2);
$format_grand_commission = number_format("$grand_commission",2);
$format_grand_allowance = number_format("$grand_allowance",2);
$format_grand_claims = number_format("$grand_claims",2);
$format_grand_director_fees = number_format("$grand_director_fees",2);
$format_grand_advance_paid = number_format("$grand_advance_paid",2);
$format_grand_bonus = number_format("$grand_bonus",2);
$format_grand_others = number_format("$grand_others",2);
$format_grand_epf = number_format("$grand_epf",2);
$format_grand_socso = number_format("$grand_socso",2);
$format_grand_eis = number_format("$grand_eis",2);
$format_grand_deduction = number_format("$grand_deduction",2);
$format_grand_loan = number_format("$grand_loan",2);
$format_grand_unpaid_leave = number_format("$grand_unpaid_leave",2);
$format_grand_advance_deduct = number_format("$grand_advance_deduct",2);

$pdf->SetFont("Arial","B", 8);
$pdf->Cell (40,7,'Grand Total',"",0);

$pdf->SetFont("Arial","", 8);
$pdf->Cell (14.5,7,$format_grand_wage,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_overtime,"TB","R",0);
$pdf->Cell (17,7,$format_grand_commission,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_allowance,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_claims,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_director_fees,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_advance_paid,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_bonus,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_others,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_epf,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_socso,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_eis,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_deduction,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_loan,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_unpaid_leave,"TB","R",0);
$pdf->Cell (14.5,7,$format_grand_advance_deduct,"TB","R",0);
$pdf->Cell (14.5,7,'',"",1);

//count of records
$pdf->SetFont("Arial","", 10);
$pdf->Cell (35,10,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>