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
$pdf->Cell (0,10,"EPF Contribution Listing",0,1,"C");
$pdf->Cell (0,10,"As At " . $month_name . " " . $get_year,0,1,"C");

//epf header
$pdf->SetFont("Arial","", 10);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (110,7,'Employee Name',"TB",0);
$pdf->Cell (30,7,'Adhoc Amount',"TB",0,"C");
$pdf->Cell (30,7,'Wages',"TB",0,"R");
$pdf->Cell (30,7,'Employee',"TB",0,"R");
$pdf->Cell (30,7,'Employer',"TB",0,"R");
$pdf->Cell (40,7,'Total Deduction',"RTB",1,"R");

//epf data from payroll sql
$query = mysqli_query($conn,"SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year'");

//epf data from adhoc sql
$query2 = mysqli_query($conn,"SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_process_month = '$get_month' AND process_adhoc_process_year = '$get_year'");

$count = 0;
$total_wages = 0;
$adhoc_total = 0;
$total_deduction = 0;
$total_employee_deduction = 0;
$total_employer_deduction = 0;
$format_total_wages = 0;
$format_total_employee_deduction = 0;
$format_total_employer_deduction = 0;
$total_epf_employee_deduction = 0;
$total_epf_employer_deduction = 0;
$total_deduction_final = 0;

$format_adhoc_total = 0;
$format_total_wages = 0;
$format_total_epf_employee_deduction = 0;
$format_total_epf_employer_deduction = 0;
$format_total_deduction_final = 0;

$final_epf_employee_deduction = 0;
$final_epf_employer_deduction = 0;

//month end + adhoc
if(mysqli_num_rows($query)>0){
	while($select_result = mysqli_fetch_assoc($query)){
	
	$epf_employee_deduction = $select_result["epf_employee_deduction"];
	$epf_employer_deduction = $select_result["epf_employer_deduction"];
	$pp_emp_id = $select_result["emp_id"];
	//get adhoc info
	$select_adhoc_sql = mysqli_query($conn, "SELECT * FROM process_adhoc WHERE process_adhoc_process_month = '$get_month' AND process_adhoc_process_year = '$get_year' AND emp_id = '$pp_emp_id'");
	$get_adhoc_result = mysqli_fetch_assoc($select_adhoc_sql);
	$adhoc_epf_employee_deduction = $get_adhoc_result["epf_employee_deduction"];
	$adhoc_epf_employer_deduction = $get_adhoc_result["epf_employer_deduction"];

	$final_epf_employee_deduction = $epf_employee_deduction + $adhoc_epf_employee_deduction;
	$final_epf_employer_deduction = $epf_employer_deduction + $adhoc_epf_employer_deduction;
	$total_deduction = $final_epf_employee_deduction + $final_epf_employer_deduction;
	
	$pdf->Cell (10,7,$select_result["emp_id"],0,0);
	$pdf->Cell (110,7,$select_result["emp_full_name"],0,0);
	$pdf->Cell (30,7,$get_adhoc_result["adhoc_amt"],0,0,"C");
	$pdf->Cell (30,7,number_format($select_result["emp_wages"],2),0,0,"R");
	$pdf->Cell (30,7,number_format($final_epf_employee_deduction, 2),0,0,"R");
	$pdf->Cell (30,7,number_format($final_epf_employer_deduction, 2),0,0,"R");
	$pdf->Cell (40,7,number_format($total_deduction,2),0,1,"R");
	
	$adhoc_total = $adhoc_total + $get_adhoc_result["adhoc_amt"];
	$format_adhoc_total = number_format($adhoc_total,2);
	
	$total_wages = $total_wages + $select_result["emp_wages"];
	$format_total_wages = number_format($total_wages,2);
	
	$total_epf_employee_deduction = $total_epf_employee_deduction + $final_epf_employee_deduction;
	$format_total_epf_employee_deduction = number_format ("$total_epf_employee_deduction",2);

	$total_epf_employer_deduction = $total_epf_employer_deduction + $final_epf_employer_deduction;
	$format_total_epf_employer_deduction = number_format("$total_epf_employer_deduction",2);

	$total_deduction_final = $total_deduction_final + $total_deduction;
	$format_total_deduction_final = number_format($total_deduction_final,2);

}
}

else {
	while($select_result = mysqli_fetch_assoc($query2)){
	
	$pp_emp_id = $select_result["emp_id"];
	//get adhoc info
	$select_adhoc_sql = mysqli_query($conn, "SELECT * FROM process_adhoc WHERE process_adhoc_process_month = '$get_month' AND process_adhoc_process_year = '$get_year' AND emp_id = '$pp_emp_id'");
	$get_adhoc_result = mysqli_fetch_assoc($select_adhoc_sql);
	$adhoc_epf_employee_deduction = $get_adhoc_result["epf_employee_deduction"];
	$adhoc_epf_employer_deduction = $get_adhoc_result["epf_employer_deduction"];

	$final_epf_employee_deduction = $final_epf_employee_deduction + $adhoc_epf_employee_deduction;
	$final_epf_employer_deduction = $final_epf_employer_deduction + $adhoc_epf_employer_deduction;
	$total_deduction = $final_epf_employee_deduction + $final_epf_employer_deduction;
	
	$pdf->Cell (10,7,$select_result["emp_id"],0,0);
	$pdf->Cell (110,7,$select_result["emp_full_name"],0,0);
	$pdf->Cell (30,7,$get_adhoc_result["adhoc_amt"],0,0,"C");
	$pdf->Cell (30,7,number_format($select_result["emp_wages"],2),0,0,"R");
	$pdf->Cell (30,7,number_format($final_epf_employee_deduction, 2),0,0,"R");
	$pdf->Cell (30,7,number_format($final_epf_employer_deduction, 2),0,0,"R");
	$pdf->Cell (40,7,number_format($total_deduction,2),0,1,"R");
	
	$adhoc_total = $adhoc_total + $get_adhoc_result["adhoc_amt"];
	$format_adhoc_total = number_format($adhoc_total,2);
	
	$total_wages = $total_wages + $select_result["emp_wages"];
	$format_total_wages = number_format($total_wages,2);
	
	$total_epf_employee_deduction = $total_epf_employee_deduction + $final_epf_employee_deduction;
	$format_total_epf_employee_deduction = number_format ("$total_epf_employee_deduction",2);

	$total_epf_employer_deduction = $total_epf_employer_deduction + $final_epf_employer_deduction;
	$format_total_epf_employer_deduction = number_format("$total_epf_employer_deduction",2);

	$total_deduction_final = $total_deduction_final + $total_deduction;
	$format_total_deduction_final = number_format($total_deduction_final,2);

}
}





$all_total = $total_employee_deduction + $total_employer_deduction;
$format_all_total = number_format("$all_total",2);
//epf totals
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (110,7,'',0,0);
$pdf->Cell (30,7,$format_adhoc_total,"TB",0,"C");
$pdf->Cell (30,7,$format_total_wages,"TB",0,"R");
$pdf->Cell (30,7,$format_total_epf_employee_deduction,"TB",0,"R");
$pdf->Cell (30,7,$format_total_epf_employer_deduction,"TB",0,"R");
$pdf->Cell (40,7,$format_total_deduction_final,"TB",1,"R");

//count of records
$pdf->SetFont("Arial","", 11);
$pdf->Cell (35,5,"Total record(s): " . $count,0,1,"L");
	
$pdf->Output();
?>