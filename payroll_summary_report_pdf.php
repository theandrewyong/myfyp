<?php
require("fpdf/fpdf.php");
session_start();
include "conn.php";
  if(empty($_SESSION["username"])){
      header("location:index.php");
  }
  $username = $_SESSION["username"];
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
$pdf->Cell (0,10,"Payroll Summary " . $get_year,0,1,"C");

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
$pdf->Cell (14.5,7,'Wages',"T",0,"R");
$pdf->Cell (14.5,7,'Overtime',"T",0,"R");
$pdf->Cell (17,7,'Commission',"T",0,"R");
$pdf->Cell (14.5,7,'Allowance',"T",0,"R");
$pdf->Cell (14.5,7,'Claims',"T",0,"R");
$pdf->Cell (14.5,7,'Director',"T",0,"R");
$pdf->Cell (14.5,7,'Advance',"T",0,"R");
$pdf->Cell (14.5,7,'Bonus',"T",0,"R");
$pdf->Cell (14.5,7,'Others',"T",0,"R");
$pdf->Cell (14.5,7,'EPF',"T",0,"R");
$pdf->Cell (14.5,7,'SOCSO',"T",0,"R");
$pdf->Cell (14.5,7,'EIS',"T",0,"R");
$pdf->Cell (14.5,7,'Deduction',"T",0,"R");
$pdf->Cell (14.5,7,'Loan',"T",0,"R");
$pdf->Cell (14.5,7,'Unpaid',"T",0,"R");
$pdf->Cell (14.5,7,'Advance',"RT",1,"R");

$pdf->Cell (40,3,'',"LB",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (17,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'Fees',"B",0,"R");
$pdf->Cell (14.5,3,'Paid',"B",0,"R");
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'',"B",0);
$pdf->Cell (14.5,3,'Leave',"B",0,"R");
$pdf->Cell (14.5,3,'Deduct',"RB",1,"R");

//payroll summary data from sql **
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
	$pdf->Cell (14.5,7,$sum_wage,"",0,"R");
	$pdf->Cell (14.5,7,$sum_overtime,"",0,"R");
	$pdf->Cell (17,7,$sum_commission,"",0,"R");
	$pdf->Cell (14.5,7,$sum_allowance,"",0,"R");
	$pdf->Cell (14.5,7,$sum_claims,"",0,"R");
	$pdf->Cell (14.5,7,$sum_director_fees,"",0,"R");
	$pdf->Cell (14.5,7,$sum_advance_paid,"",0,"R");
	$pdf->Cell (14.5,7,$sum_bonus,"",0,"R");
	$pdf->Cell (14.5,7,$sum_others,"",0,"R");
	$pdf->Cell (14.5,7,$sum_epf,"",0,"R");
	$pdf->Cell (14.5,7,$sum_socso,"",0,"R");
	$pdf->Cell (14.5,7,$sum_eis,"",0,"R");
	$pdf->Cell (14.5,7,$sum_deduction,"",0,"R");
	$pdf->Cell (14.5,7,$sum_loan,"",0,"R");
	$pdf->Cell (14.5,7,$sum_unpaid_leave,"",0,"R");
	$pdf->Cell (14.5,7,$sum_advance_deduct,"",1,"R");
	
	$count = $count + 1;
	}

$pdf->SetFont("Arial","B", 8);
$pdf->Cell (40,7,'Grand Total',"",0);

$pdf->SetFont("Arial","", 8);
$pdf->Cell (14.5,7,$sum_wage,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_overtime,"TB",0,"R");
$pdf->Cell (17,7,$sum_commission,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_allowance,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_claims,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_director_fees,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_advance_paid,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_bonus,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_others,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_epf,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_socso,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_eis,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_deduction,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_loan,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_unpaid_leave,"TB",0,"R");
$pdf->Cell (14.5,7,$sum_advance_deduct,"TB",1,"R");

//count of records
$pdf->SetFont("Arial","", 10);
$pdf->Cell (35,10,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>