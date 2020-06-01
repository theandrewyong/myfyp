<?php
require("fpdf/fpdf.php");
session_start();
include "conn.php";
  if(empty($_SESSION["username"])){
      header("location:index.php");
  }
  $username = $_SESSION["username"];
  $get_month = $_GET["month"];
  $dateObj   = DateTime::createFromFormat('!m', $get_month);
  $month_name = $dateObj->format('F'); // March

  $get_year = $_GET["year"];

date_default_timezone_set("Asia/Kuching");
$currentdate = date('m/d/Y h:i:s a', time());
$currentmonthyeaer = date('M Y');

$pdf = new FPDF("L","mm","A4");
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();
$pdf->SetFont("Arial","", 10);

//date & admin
$pdf->Cell (0,5,"Process Date: ",0,1,"L");
$pdf->Cell (0,5,$month_name . " " . $get_year,0,0,"L");
$pdf->Cell (0,5,$currentdate,0,1,"R");
$pdf->Cell (0,5,"ADMIN",0,1,"R");

//report title
$pdf->SetFont("Arial","", 20);
$pdf->Cell (0,10,"Payroll Summary ",0,1,"C");

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
$pdf->Cell (22,7,'Wages',"T",0,"R");
$pdf->Cell (22,7,'Commission',"T",0,"R");
$pdf->Cell (16,7,'Overtime',"T",0,"R");
$pdf->Cell (16,7,'Allowance',"T",0,"R");
$pdf->Cell (14,7,'Others',"T",0,"R");
$pdf->Cell (20,7,'Gross Pay',"T",0,"R");
$pdf->Cell (16,7,'EPF EE',"T",0,"R");
$pdf->Cell (18,7,'SOCSO EE',"T",0,"R");
$pdf->Cell (14,7,'EIS EE',"T",0,"R");
$pdf->Cell (22,7,'Deduction',"T",0,"R");
$pdf->Cell (22,7,'Loan',"T",0,"R");
$pdf->Cell (16,7,'Gross',"T",0,"R");
$pdf->Cell (18,7,'Adjustment',"RT",1,"R");

$pdf->Cell (40,5,'',"LB",0);
$pdf->Cell (22,5,'Director Fees',"B",0,"R");
$pdf->Cell (22,5,'Advance Paid',"B",0,"R");
$pdf->Cell (16,5,'Claims',"B",0,"R");
$pdf->Cell (16,5,'Bonus',"B",0,"R");
$pdf->Cell (14,5,'',"B",0);
$pdf->Cell (20,5,'',"B",0);
$pdf->Cell (16,5,'EPF ER',"B",0,"R");
$pdf->Cell (18,5,'SOCSO ER',"B",0,"R");
$pdf->Cell (14,5,'EIS ER',"B",0,"R");
$pdf->Cell (22,5,'Unpaid Leave',"B",0,"R");
$pdf->Cell (22,5,'Adv Deduct',"B",0,"R");
$pdf->Cell (16,5,'Deduct',"B",0,"R");
$pdf->Cell (18,5,'Net Pay',"RB",1,"R");

//payroll summary data from sql **
$count = 0;
$total_wage = 0;    
$total_overtime = 0;    
$total_commission = 0;    
$total_allowance = 0;    
$total_claims = 0;    
$total_director_fees = 0;    
$total_advance_paid = 0;    
$total_bonus = 0;    
$total_others = 0;    
$total_epf = 0;    
$total_socso = 0;    
$total_eis = 0;    
$total_deduction = 0;    
$total_loan = 0;    
$total_unpaid_leave = 0;    
$total_advance_deduct = 0; 
$total_adjustment = 0;

$sum_gross_pay = 0;    
$total_gross_pay = 0;    

$sum_gross_deduct = 0;    
$total_gross_deduct = 0; 
$total_net_pay = 0;

$total_employer_epf = 0;
$total_employer_socso = 0;
$total_employer_eis = 0;

foreach($emp_id_unique as $eiu){
	$sum_gross_pay=0;
	$sum_gross_deduct = 0; 
	//count the total wages for each employee
	$sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year' AND emp_id = '$eiu'");
	$get_name_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$eiu'");
	$namesql = mysqli_fetch_assoc($get_name_sql);
	$usql = mysqli_fetch_assoc($sql);
	
	$emp_name = $namesql["emp_full_name"];
	$sum_netpay = $usql["process_payroll_net_pay"];
                                    
	$epf_employer_deduction = $usql["epf_employer_deduction"];
	$socso_employer_deduction = $usql["socso_employer_deduction"];
	$eis_employer_deduction = $usql["eis_employer_deduction"];

	$sum_wage = $usql["process_payroll_wage"];
	$sum_overtime = $usql["process_payroll_overtime"];
	$sum_commission = $usql["process_payroll_commission"];
	$sum_allowance = $usql["process_payroll_allowance"];
	$sum_claims = $usql["process_payroll_claims"];
	$sum_director_fees = $usql["process_payroll_director_fees"];
	$sum_advance_paid = $usql["process_payroll_advance_paid"];
	$sum_bonus = $usql["process_payroll_bonus"];
	$sum_others = $usql["process_payroll_others"];

	$sum_gross_pay = $sum_gross_pay + $sum_wage + $sum_overtime + $sum_commission + $sum_allowance + $sum_claims + $sum_director_fees + $sum_advance_paid + $sum_bonus + $sum_others;

	$total_gross_pay = $total_gross_pay + $sum_gross_pay;

	$sum_epf = $usql["epf_employee_deduction"];
	$sum_socso = $usql["socso_employee_deduction"];
	$sum_eis = $usql["eis_employee_deduction"];
	$sum_deduction = $usql["process_payroll_additional_deduction"];
	$sum_loan = $usql["process_payroll_loan"];
	$sum_unpaid_leave = $usql["process_payroll_unpaid_leave"];
	$sum_advance_deduct = $usql["process_payroll_advance_deduct"];

	$sum_adjustment = $usql["process_payroll_adjustment"];

	$sum_gross_deduct = $sum_gross_deduct + $sum_epf + $sum_socso + $sum_eis + $sum_deduction + $sum_loan + $sum_unpaid_leave + $sum_advance_deduct;

	$total_gross_deduct = $total_gross_deduct + $sum_gross_deduct;
	
	//employer
	$total_employer_epf = $total_employer_epf + $epf_employer_deduction;
	$total_employer_socso = $total_employer_socso + $socso_employer_deduction;
	$total_employer_eis = $total_employer_eis + $eis_employer_deduction;
	
	$total_net_pay = $total_net_pay + $sum_netpay;
	
	$pdf->Cell (40,7,$emp_name,"",0);
	$pdf->Cell (22,7,$sum_wage,"",0,"R");
	$pdf->Cell (22,7,$sum_commission,"",0,"R");
	$pdf->Cell (16,7,$sum_overtime,"",0,"R");
	$pdf->Cell (16,7,$sum_allowance,"",0,"R");
	$pdf->Cell (14,7,$sum_others,"",0,"R");
	$pdf->Cell (20,7,$sum_gross_pay,"",0,"R");
	$pdf->Cell (16,7,$sum_epf,"",0,"R");
	$pdf->Cell (18,7,$sum_socso,"",0,"R");
	$pdf->Cell (14,7,$sum_eis,"",0,"R");
	$pdf->Cell (22,7,$sum_deduction,"",0,"R");
	$pdf->Cell (22,7,$sum_loan,"",0,"R");
	$pdf->Cell (16,7,$sum_gross_deduct,"",0,"R");
	$pdf->Cell (18,7,$sum_adjustment,"",1,"R");

	$pdf->Cell (40,5,'',"",0);
	$pdf->Cell (22,5,$sum_director_fees,"",0,"R");
	$pdf->Cell (22,5,$sum_advance_paid,"",0,"R");
	$pdf->Cell (16,5,$sum_claims,"",0,"R");
	$pdf->Cell (16,5,$sum_bonus,"",0,"R");
	$pdf->Cell (14,5,'',"",0);
	$pdf->Cell (20,5,'',"",0);
	$pdf->Cell (16,5,$epf_employer_deduction,"",0,"R");
	$pdf->Cell (18,5,$socso_employer_deduction,"",0,"R");
	$pdf->Cell (14,5,$eis_employer_deduction,"",0,"R");
	$pdf->Cell (22,5,$sum_unpaid_leave,"",0,"R");
	$pdf->Cell (22,5,$sum_advance_deduct,"",0,"R");
	$pdf->Cell (16,5,'',"",0,"R");
	$pdf->Cell (18,5,$sum_netpay,"",1,"R");
	
	$pdf->Cell (40,2,'',"",0);
	$pdf->Cell (22,2,'',"",0,"R");
	$pdf->Cell (22,2,'',"",0,"R");
	$pdf->Cell (16,2,'',"",0,"R");
	$pdf->Cell (16,2,'',"",0,"R");
	$pdf->Cell (14,2,'',"",0,"R");
	$pdf->Cell (20,2,'',"",0,"R");
	$pdf->Cell (16,2,'',"",0,"R");
	$pdf->Cell (18,2,'',"",0,"R");
	$pdf->Cell (14,2,'',"",0,"R");
	$pdf->Cell (22,2,'',"",0,"R");
	$pdf->Cell (22,2,'',"",0,"R");
	$pdf->Cell (16,2,'',"",0,"R");
	$pdf->Cell (18,2,'',"",1,"R");
	
	$total_wage = $total_wage + $sum_wage;
	$format_total_wage = number_format($total_wage,2);
	
	$total_overtime = $total_overtime + $sum_overtime;
	$format_total_overtime = number_format($total_overtime,2);
	
	$total_commission = $total_commission + $sum_commission;
	$format_total_commission = number_format($total_commission,2);
	
	$total_allowance = $total_allowance + $sum_allowance;
	$format_total_allowance = number_format($total_allowance,2);
	
	$total_claims = $total_claims + $sum_claims;
	$format_total_claims = number_format($total_claims,2);
	
	$total_director_fees = $total_director_fees + $sum_director_fees;
	$format_total_director_fees = number_format($total_director_fees,2);
	
	$total_advance_paid = $total_advance_paid + $sum_advance_paid;
	$format_total_advance_paid = number_format($total_advance_paid,2);
	
	$total_bonus = $total_bonus + $sum_bonus;
	$format_total_bonus = number_format($total_bonus,2);
	
	$total_others = $total_others + $sum_others;
	$format_total_others = number_format($total_others,2);
	
	$total_epf = $total_epf + $sum_epf;
	$format_total_epf = number_format($total_epf,2);
	
	$total_socso = $total_socso + $sum_socso;
	$format_total_socso = number_format($total_socso,2);
	
	$total_eis = $total_eis + $sum_eis;
	$format_total_eis = number_format($total_eis,2);
	
	$total_deduction = $total_deduction + $sum_deduction;
	$format_total_deduction = number_format($total_deduction,2);
	
	$total_loan = $total_loan + $sum_loan;
	$format_total_loan = number_format($total_loan,2);
	
	$total_unpaid_leave = $total_unpaid_leave + $sum_unpaid_leave;
	$format_total_unpaid_leave = number_format($total_unpaid_leave,2);
	
	$total_advance_deduct = $total_advance_deduct + $sum_advance_deduct;
	$format_total_advance_deduct = number_format($total_advance_deduct,2);
	
	$total_adjustment = $total_adjustment + $sum_adjustment;
	$format_total_adjustment = number_format($total_adjustment,2);
	
	$format_total_gross_pay = number_format($total_gross_pay,2);
	$format_total_employer_epf = number_format($total_employer_epf,2);
	$format_total_employer_socso = number_format($total_employer_socso,2);
	$format_total_employer_eis = number_format($total_employer_eis,2);
	$format_total_gross_deduct = number_format($total_gross_deduct,2);
	$format_total_net_pay = number_format($total_net_pay,2);
	$count = $count + 1;
	}

$pdf->SetFont("Arial","B", 8);
$pdf->Cell (40,7,'Grand Total',"T",0);
$pdf->SetFont("Arial","", 8);
	$pdf->Cell (22,7,$format_total_wage,"T",0,"R");
	$pdf->Cell (22,7,$format_total_commission,"T",0,"R");
	$pdf->Cell (16,7,$format_total_overtime,"T",0,"R");
	$pdf->Cell (16,7,$format_total_allowance,"T",0,"R");
	$pdf->Cell (14,7,$format_total_others,"T",0,"R");
	$pdf->Cell (20,7,$format_total_gross_pay,"T",0,"R");
	$pdf->Cell (16,7,$format_total_epf,"T",0,"R");
	$pdf->Cell (18,7,$format_total_socso,"T",0,"R");
	$pdf->Cell (14,7,$format_total_eis,"T",0,"R");
	$pdf->Cell (22,7,$format_total_deduction,"T",0,"R");
	$pdf->Cell (22,7,$format_total_loan,"T",0,"R");
	$pdf->Cell (16,7,$format_total_gross_deduct,"T",0,"R");
	$pdf->Cell (18,7,$format_total_adjustment,"T",1,"R");
	
	$pdf->SetLineWidth (0.5);
	$pdf->Cell (40,5,'',"B",0);
	$pdf->Cell (22,5,$format_total_director_fees,"B",0,"R");
	$pdf->Cell (22,5,$format_total_advance_paid,"B",0,"R");
	$pdf->Cell (16,5,$format_total_claims,"B",0,"R");
	$pdf->Cell (16,5,$format_total_bonus,"B",0,"R");
	$pdf->Cell (14,5,'',"B",0);
	$pdf->Cell (20,5,'',"B",0);
	$pdf->Cell (16,5,$format_total_employer_epf,"B",0,"R");
	$pdf->Cell (18,5,$format_total_employer_socso,"B",0,"R");
	$pdf->Cell (14,5,$format_total_employer_eis,"B",0,"R");
	$pdf->Cell (22,5,$format_total_unpaid_leave,"B",0,"R");
	$pdf->Cell (22,5,$format_total_advance_deduct,"B",0,"R");
	$pdf->Cell (16,5,'',"B",0,"R");
	$pdf->Cell (18,5,$format_total_net_pay,"B",1,"R");

	
//count of records
$pdf->SetFont("Arial","", 10);
$pdf->Cell (35,10,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>