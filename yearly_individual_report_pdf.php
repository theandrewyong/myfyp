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

//get year
//get month
$year = 2020;
//$month = $_GET["month"];

//count first **
$query=@mysqli_query($conn,"select * from employee_info");
$count = 0;
while($data=@mysqli_fetch_array($query)) {
	$count = $count+1;
}

//get unique employee
$count_employee_by_year_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_year = '$year'");
while($result = mysqli_fetch_assoc($count_employee_by_year_sql)){
//echo $result["emp_id"];
//make it unique
$employee_id_array[] = $result["emp_id"];
$unique_employee = array_unique($employee_id_array);
}
$countJan = 0;
$countFeb = 0;
$countMar = 0;
$countApr = 0;
$countMay = 0;
$countJun = 0;
$countJul = 0;
$countAug = 0;
$countSep = 0;
$countOct = 0;
$countNov = 0;
$countDec = 0;
$count_all = 0;



foreach($unique_employee as $ua){
    
$query = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$ua'");
$data = mysqli_fetch_assoc($query);    

//display employee, date & admin
$pdf->SetFont("Arial","B", 8);
$pdf->Cell (140,5,"Employee: " . $data["emp_full_name"],0,0,"L");
$pdf->SetFont("Arial","", 8);
$pdf->Cell (0,5,$currentdate,0,1,"R");

$pdf->SetFont("Arial","B", 8);
$pdf->Cell (140,5,"EPF No: " . $data["emp_epf"],0,0,"L");
$pdf->SetFont("Arial","", 8);
$pdf->Cell (0,5,"ADMIN",0,1,"R");

$pdf->SetFont("Arial","B", 8);
$pdf->Cell (140,5,"SOCSO No: " . $data["emp_socso"],0,1,"L");
$pdf->Cell (140,5,"SOCSO Type: " . $data["emp_socso_type"],0,1,"L");
$pdf->Cell (140,5,"EIS Eligibility: " . $data["emp_eis_type"],0,1,"L");


//report title
$pdf->SetFont("Arial","B", 14);
$pdf->Cell (0,10,"Yearly Individual Pay for Year " . $year,0,1,"C");

//yearly wages header
$pdf->SetFont("Arial","", 8);

$pdf->Cell (60,5,'Description',"LTB",0);
$pdf->Cell (17,5,'Jan-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Feb-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Mar-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Apr-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'May-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Jun-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Jul-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Aug-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Sep-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Oct-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Nov-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Dec-' . $currentyear,"TB","R",0);
$pdf->Cell (17,5,'Total',"RTB",1,"C");		

	//wage section
	$pdf->Cell (60,5,'Wage',0,0);	
	
    //show all 12 months
    for($i=1;$i<=12;$i++){
		//if individual month echo wage for that specific month
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		
        if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countJanWage = $countJan + $data["process_payroll_wage"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countFebWage = $countFeb + $data["process_payroll_wage"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countMarWage = $countMar + $data["process_payroll_wage"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countAprWage = $countApr + $data["process_payroll_wage"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countMayWage = $countMay + $data["process_payroll_wage"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countJunWage = $countJun + $data["process_payroll_wage"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countJulWage = $countJul + $data["process_payroll_wage"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countAugWage = $countAug + $data["process_payroll_wage"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countSepWage = $countSep + $data["process_payroll_wage"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countOctWage = $countOct + $data["process_payroll_wage"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countNovWage = $countNov + $data["process_payroll_wage"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_wage"],0,"R",0);
            $countDecWage = $countDec + $data["process_payroll_wage"];
        }
		
    }
	$count_allWage = $countJanWage + $countFebWage + $countMarWage + $countAprWage + $countMayWage + $countJunWage + $countJulWage + $countAugWage + $countSepWage + $countOctWage + $countNovWage + $countDecWage;
	$format_count_allWage = number_format("$count_allWage",2);
	
    $pdf->Cell (17,5,$format_count_allWage,0,1,"R");
	
	
	//Overtime section
	$pdf->Cell (60,5,'Overtime',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countJanOvertime = $countJan + $data["process_payroll_overtime"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countFebOvertime = $countFeb + $data["process_payroll_overtime"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countMarOvertime = $countMar + $data["process_payroll_overtime"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countAprOvertime = $countApr + $data["process_payroll_overtime"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countMayOvertime = $countMay + $data["process_payroll_overtime"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countJunOvertime = $countJun + $data["process_payroll_overtime"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countJulOvertime = $countJul + $data["process_payroll_overtime"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countAugOvertime = $countAug + $data["process_payroll_overtime"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countSepOvertime = $countSep + $data["process_payroll_overtime"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countOctOvertime = $countOct + $data["process_payroll_overtime"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countNovOvertime = $countNov + $data["process_payroll_overtime"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_overtime"],0,0,"R");
            $countDecOvertime = $countDec + $data["process_payroll_overtime"];
        }
		
    }
	$count_allOvertime = $countJanOvertime + $countFebOvertime + $countMarOvertime + $countAprOvertime + $countMayOvertime + $countJunOvertime + $countJulOvertime + $countAugOvertime + $countSepOvertime + $countOctOvertime + $countNovOvertime + $countDecOvertime;
	$format_count_allOvertime = number_format("$count_allOvertime",2);
	
    $pdf->Cell (17,5,$format_count_allOvertime,0,1,"R");
	
	//Commission section
	$pdf->Cell (60,5,'Commission',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countJanCommission = $countJan + $data["process_payroll_commission"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countFebCommission = $countFeb + $data["process_payroll_commission"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countMarCommission = $countMar + $data["process_payroll_commission"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countAprCommission = $countApr + $data["process_payroll_commission"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countMayCommission = $countMay + $data["process_payroll_commission"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countJunCommission = $countJun + $data["process_payroll_commission"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countJulCommission = $countJul + $data["process_payroll_commission"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countAugCommission = $countAug + $data["process_payroll_commission"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countSepCommission = $countSep + $data["process_payroll_commission"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countOctCommission = $countOct + $data["process_payroll_commission"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countNovCommission = $countNov + $data["process_payroll_commission"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_commission"],0,0,"R");
            $countDecCommission = $countDec + $data["process_payroll_commission"];
        }
		
    }
	$count_allCommission = $countJanCommission + $countFebCommission + $countMarCommission + $countAprCommission + $countMayCommission + $countJunCommission + $countJulCommission + $countAugCommission + $countSepCommission + $countOctCommission + $countNovCommission + $countDecCommission;
	$format_count_allCommission = number_format("$count_allCommission",2);
	
    $pdf->Cell (17,5,$format_count_allCommission,0,1,"R");
	
	//Allowance section
	$pdf->Cell (60,5,'Allowance',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countJanAllowance = $countJan + $data["process_payroll_allowance"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countFebAllowance = $countFeb + $data["process_payroll_allowance"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countMarAllowance = $countMar + $data["process_payroll_allowance"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countAprAllowance = $countApr + $data["process_payroll_allowance"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countMayAllowance = $countMay + $data["process_payroll_allowance"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countJunAllowance = $countJun + $data["process_payroll_allowance"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countJulAllowance = $countJul + $data["process_payroll_allowance"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countAugAllowance = $countAug + $data["process_payroll_allowance"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countSepAllowance = $countSep + $data["process_payroll_allowance"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countOctAllowance = $countOct + $data["process_payroll_allowance"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countNovAllowance = $countNov + $data["process_payroll_allowance"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_allowance"],0,0,"R");
            $countDecAllowance = $countDec + $data["process_payroll_allowance"];
        }
		
    }
	$count_allAllowance = $countJanAllowance + $countFebAllowance + $countMarAllowance + $countAprAllowance + $countMayAllowance + $countJunAllowance + $countJulAllowance + $countAugAllowance + $countSepAllowance + $countOctAllowance + $countNovAllowance + $countDecAllowance;
	$format_count_allAllowance = number_format("$count_allAllowance",2);
	
    $pdf->Cell (17,5,$format_count_allAllowance,0,1,"R");
	
	//Claims section
	$pdf->Cell (60,5,'Claims',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countJanClaims = $countJan + $data["process_payroll_claims"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countFebClaims = $countFeb + $data["process_payroll_claims"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countMarClaims = $countMar + $data["process_payroll_claims"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countAprClaims = $countApr + $data["process_payroll_claims"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countMayClaims = $countMay + $data["process_payroll_claims"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countJunClaims = $countJun + $data["process_payroll_claims"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countJulClaims = $countJul + $data["process_payroll_claims"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countAugClaims = $countAug + $data["process_payroll_claims"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countSepClaims = $countSep + $data["process_payroll_claims"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countOctClaims = $countOct + $data["process_payroll_claims"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countNovClaims = $countNov + $data["process_payroll_claims"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_claims"],0,0,"R");
            $countDecClaims = $countDec + $data["process_payroll_claims"];
        }
		
    }
	$count_allClaims = $countJanClaims + $countFebClaims + $countMarClaims + $countAprClaims + $countMayClaims + $countJunClaims + $countJulClaims + $countAugClaims + $countSepClaims + $countOctClaims + $countNovClaims + $countDecClaims;
	$format_count_allClaims = number_format("$count_allClaims",2);
	
    $pdf->Cell (17,5,$format_count_allClaims,0,1,"R");
	
	//Director Fees section
	$pdf->Cell (60,5,'Director Fees',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countJanDirectorFees = $countJan + $data["process_payroll_director_fees"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countFebDirectorFees = $countFeb + $data["process_payroll_director_fees"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countMarDirectorFees = $countMar + $data["process_payroll_director_fees"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countAprDirectorFees = $countApr + $data["process_payroll_director_fees"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countMayDirectorFees = $countMay + $data["process_payroll_director_fees"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countJunDirectorFees = $countJun + $data["process_payroll_director_fees"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countJulDirectorFees = $countJul + $data["process_payroll_director_fees"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countAugDirectorFees = $countAug + $data["process_payroll_director_fees"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countSepDirectorFees = $countSep + $data["process_payroll_director_fees"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countOctDirectorFees = $countOct + $data["process_payroll_director_fees"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countNovDirectorFees = $countNov + $data["process_payroll_director_fees"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_director_fees"],0,0,"R");
            $countDecDirectorFees = $countDec + $data["process_payroll_director_fees"];
        }
		
    }
	$count_allDirectorFees = $countJanDirectorFees + $countFebDirectorFees + $countMarDirectorFees + $countAprDirectorFees + $countMayDirectorFees + $countJunDirectorFees + $countJulDirectorFees + $countAugDirectorFees + $countSepDirectorFees + $countOctDirectorFees + $countNovDirectorFees + $countDecDirectorFees;
	$format_count_allDirectorFees = number_format("$count_allDirectorFees",2);
	
    $pdf->Cell (17,5,$format_count_allDirectorFees,0,1,"R");

	//Advance paid section
	$pdf->Cell (60,5,'Advance Paid',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countJanAdvancePaid = $countJan + $data["process_payroll_advance_paid"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countFebAdvancePaid = $countFeb + $data["process_payroll_advance_paid"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countMarAdvancePaid = $countMar + $data["process_payroll_advance_paid"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countAprAdvancePaid = $countApr + $data["process_payroll_advance_paid"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countMayAdvancePaid = $countMay + $data["process_payroll_advance_paid"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countJunAdvancePaid = $countJun + $data["process_payroll_advance_paid"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countJulAdvancePaid = $countJul + $data["process_payroll_advance_paid"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countAugAdvancePaid = $countAug + $data["process_payroll_advance_paid"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countSepAdvancePaid = $countSep + $data["process_payroll_advance_paid"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countOctAdvancePaid = $countOct + $data["process_payroll_advance_paid"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countNovAdvancePaid = $countNov + $data["process_payroll_advance_paid"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_advance_paid"],0,0,"R");
            $countDecAdvancePaid = $countDec + $data["process_payroll_advance_paid"];
        }
		
    }
	$count_allAdvancePaid = $countJanAdvancePaid + $countFebAdvancePaid + $countMarAdvancePaid + $countAprAdvancePaid + $countMayAdvancePaid + $countJunAdvancePaid + $countJulAdvancePaid + $countAugAdvancePaid + $countSepAdvancePaid + $countOctAdvancePaid + $countNovAdvancePaid + $countDecAdvancePaid;
	$format_count_allAdvancePaid = number_format("$count_allAdvancePaid",2);
	
    $pdf->Cell (17,5,$format_count_allAdvancePaid,0,1,"R");
	
	//Bonus section
	$pdf->Cell (60,5,'Bonus',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countJanBonus = $countJan + $data["process_payroll_bonus"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countFebBonus = $countFeb + $data["process_payroll_bonus"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countMarBonus = $countMar + $data["process_payroll_bonus"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countAprBonus = $countApr + $data["process_payroll_bonus"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countMayBonus = $countMay + $data["process_payroll_bonus"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countJunBonus = $countJun + $data["process_payroll_bonus"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countJulBonus = $countJul + $data["process_payroll_bonus"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countAugBonus = $countAug + $data["process_payroll_bonus"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countSepBonus = $countSep + $data["process_payroll_bonus"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countOctBonus = $countOct + $data["process_payroll_bonus"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countNovBonus = $countNov + $data["process_payroll_bonus"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_bonus"],0,0,"R");
            $countDecBonus = $countDec + $data["process_payroll_bonus"];
        }
		
    }
	$count_allBonus = $countJanBonus + $countFebBonus + $countMarBonus + $countAprBonus + $countMayBonus + $countJunBonus + $countJulBonus + $countAugBonus + $countSepBonus + $countOctBonus + $countNovBonus + $countDecBonus;
	$format_count_allBonus = number_format("$count_allBonus",2);
	
    $pdf->Cell (17,5,$format_count_allBonus,0,1,"R");
	
	//Others section
	$pdf->Cell (60,5,'Others',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countJanOthers = $countJan + $data["process_payroll_others"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countFebOthers = $countFeb + $data["process_payroll_others"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countMarOthers = $countMar + $data["process_payroll_others"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countAprOthers = $countApr + $data["process_payroll_others"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countMayOthers = $countMay + $data["process_payroll_others"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countJunOthers = $countJun + $data["process_payroll_others"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countJulOthers = $countJul + $data["process_payroll_others"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countAugOthers = $countAug + $data["process_payroll_others"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countSepOthers = $countSep + $data["process_payroll_others"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countOctOthers = $countOct + $data["process_payroll_others"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countNovOthers = $countNov + $data["process_payroll_others"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_others"],0,0,"R");
            $countDecOthers = $countDec + $data["process_payroll_others"];
        }
		
    }
	$count_allOthers = $countJanOthers + $countFebOthers + $countMarOthers + $countAprOthers + $countMayOthers + $countJunOthers + $countJulOthers + $countAugOthers + $countSepOthers + $countOctOthers + $countNovOthers + $countDecOthers;
	$format_count_allOthers = number_format("$count_allOthers",2);
	
    $pdf->Cell (17,5,$format_count_allOthers,0,1,"R");
	
	//yearly individual total earnings **
	$pdf->SetFont("Arial","B", 8);
	$pdf->Cell (60,5,'Total Earnings',0,0);

	//total earnings by month formatted
	$total_earnings_jan = $countJanWage + $countJanOvertime + $countJanCommission + $countJanAllowance + $countJanClaims + $countJanDirectorFees + $countJanAdvancePaid + $countJanBonus + $countJanOthers;
	$format_total_earnings_jan = number_format("$total_earnings_jan",2);
	
	$total_earnings_feb = $countFebWage + $countFebOvertime + $countFebCommission + $countFebAllowance + $countFebClaims + $countFebDirectorFees + $countFebAdvancePaid + $countFebBonus + $countFebOthers;
	$format_total_earnings_feb = number_format("$total_earnings_feb",2);
	
	$total_earnings_mar = $countMarWage + $countMarOvertime + $countMarCommission + $countMarAllowance + $countMarClaims + $countMarDirectorFees + $countMarAdvancePaid + $countMarBonus + $countMarOthers;
	$format_total_earnings_mar = number_format("$total_earnings_mar",2);
	
	$total_earnings_apr = $countAprWage + $countAprOvertime + $countAprCommission + $countAprAllowance + $countAprClaims + $countAprDirectorFees + $countAprAdvancePaid + $countAprBonus + $countAprOthers;
	$format_total_earnings_apr = number_format("$total_earnings_apr",2);
	
	$total_earnings_may = $countMayWage + $countMayOvertime + $countMayCommission + $countMayAllowance + $countMayClaims + $countMayDirectorFees + $countMayAdvancePaid + $countMayBonus + $countMayOthers;
	$format_total_earnings_may = number_format("$total_earnings_may",2);
	
	$total_earnings_jun = $countJunWage + $countJunOvertime + $countJunCommission + $countJunAllowance + $countJunClaims + $countJunDirectorFees + $countJunAdvancePaid + $countJunBonus + $countJunOthers;
	$format_total_earnings_jun = number_format("$total_earnings_jun",2);
	
	$total_earnings_jul = $countJulWage + $countJulOvertime + $countJulCommission + $countJulAllowance + $countJulClaims + $countJulDirectorFees + $countJulAdvancePaid + $countJulBonus + $countJulOthers;
	$format_total_earnings_jul = number_format("$total_earnings_jul",2);
	
	$total_earnings_aug = $countAugWage + $countAugOvertime + $countAugCommission + $countAugAllowance + $countAugClaims + $countAugDirectorFees + $countAugAdvancePaid + $countAugBonus + $countAugOthers;
	$format_total_earnings_aug = number_format("$total_earnings_aug",2);
	
	$total_earnings_sep = $countSepWage + $countSepOvertime + $countSepCommission + $countSepAllowance + $countSepClaims + $countSepDirectorFees + $countSepAdvancePaid + $countSepBonus + $countSepOthers;
	$format_total_earnings_sep = number_format("$total_earnings_sep",2);
	
	$total_earnings_oct = $countOctWage + $countOctOvertime + $countOctCommission + $countOctAllowance + $countOctClaims + $countOctDirectorFees + $countOctAdvancePaid + $countOctBonus + $countOctOthers;
	$format_total_earnings_oct = number_format("$total_earnings_oct",2);
	
	$total_earnings_nov = $countNovWage + $countNovOvertime + $countNovCommission + $countNovAllowance + $countNovClaims + $countNovDirectorFees + $countNovAdvancePaid + $countNovBonus + $countNovOthers;
	$format_total_earnings_nov = number_format("$total_earnings_nov",2);
	
	$total_earnings_dec = $countDecWage + $countDecOvertime + $countDecCommission + $countDecAllowance + $countDecClaims + $countDecDirectorFees + $countDecAdvancePaid + $countDecBonus + $countDecOthers;
	$format_total_earnings_dec = number_format("$total_earnings_dec",2);
		
	for($x=1;$x<=12;$x++){
		if($x == 1){
			$pdf->Cell (17,5,$format_total_earnings_jan,"TB",0,"R");
		}
		if($x == 2){
			$pdf->Cell (17,5,$format_total_earnings_feb,"TB",0,"R");
		}
		if($x == 3){
			$pdf->Cell (17,5,$format_total_earnings_mar,"TB",0,"R");
		}
		if($x == 4){
			$pdf->Cell (17,5,$format_total_earnings_apr,"TB",0,"R");
		}
		if($x == 5){
			$pdf->Cell (17,5,$format_total_earnings_may,"TB",0,"R");
		}
		if($x == 6){
			$pdf->Cell (17,5,$format_total_earnings_jun,"TB",0,"R");
		}
		if($x == 7){
			$pdf->Cell (17,5,$format_total_earnings_jul,"TB",0,"R");
		}
		if($x == 8){
			$pdf->Cell (17,5,$format_total_earnings_aug,"TB",0,"R");
		}
		if($x == 9){
			$pdf->Cell (17,5,$format_total_earnings_sep,"TB",0,"R");
		}
		if($x == 10){
			$pdf->Cell (17,5,$format_total_earnings_oct,"TB",0,"R");
		}
		if($x == 11){
			$pdf->Cell (17,5,$format_total_earnings_nov,"TB",0,"R");
		}
		if($x == 12){
			$pdf->Cell (17,5,$format_total_earnings_dec,"TB",0,"R");
		}                        

}
	
$total_earnings_total = $count_allWage + $count_allOvertime + $count_allCommission + $count_allAllowance + $count_allClaims + $count_allDirectorFees + $count_allAdvancePaid + $count_allBonus + $count_allOthers;
$format_total_earnings_total = number_format("$total_earnings_total",2);
	
$pdf->Cell (17,5,$format_total_earnings_total,"TB",1,"R");

	$pdf->SetFont("Arial","", 8);
	
	//Employee EPF section
	$pdf->Cell (60,5,'Employee EPF',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countJanEmpEPF = $countJan + $data["epf_employee_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countFebEmpEPF = $countFeb + $data["epf_employee_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countMarEmpEPF = $countMar + $data["epf_employee_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countAprEmpEPF = $countApr + $data["epf_employee_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countMayEmpEPF = $countMay + $data["epf_employee_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countJunEmpEPF = $countJun + $data["epf_employee_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countJulEmpEPF = $countJul + $data["epf_employee_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countAugEmpEPF = $countAug + $data["epf_employee_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countSepEmpEPF = $countSep + $data["epf_employee_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countOctEmpEPF = $countOct + $data["epf_employee_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countNovEmpEPF = $countNov + $data["epf_employee_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["epf_employee_deduction"],0,0,"R");
            $countDecEmpEPF = $countDec + $data["epf_employee_deduction"];
        }
		
    }
	$count_allEmpEPF = $countJanEmpEPF + $countFebEmpEPF + $countMarEmpEPF + $countAprEmpEPF + $countMayEmpEPF + $countJunEmpEPF + $countJulEmpEPF + $countAugEmpEPF + $countSepEmpEPF + $countOctEmpEPF + $countNovEmpEPF + $countDecEmpEPF;
	$format_count_allEmpEPF = number_format("$count_allEmpEPF",2);
	
    $pdf->Cell (17,5,$format_count_allEmpEPF,0,1,"R");	
	
	//Employee SOCSO section
	$pdf->Cell (60,5,'Employee SOCSO',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countJanEmpSOCSO = $countJan + $data["socso_employee_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countFebEmpSOCSO = $countFeb + $data["socso_employee_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countMarEmpSOCSO = $countMar + $data["socso_employee_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countAprEmpSOCSO = $countApr + $data["socso_employee_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countMayEmpSOCSO = $countMay + $data["socso_employee_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countJunEmpSOCSO = $countJun + $data["socso_employee_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countJulEmpSOCSO = $countJul + $data["socso_employee_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countAugEmpSOCSO = $countAug + $data["socso_employee_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countSepEmpSOCSO = $countSep + $data["socso_employee_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countOctEmpSOCSO = $countOct + $data["socso_employee_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countNovEmpSOCSO = $countNov + $data["socso_employee_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["socso_employee_deduction"],0,0,"R");
            $countDecEmpSOCSO = $countDec + $data["socso_employee_deduction"];
        }
		
    }
	$count_allEmpSOCSO = $countJanEmpSOCSO + $countFebEmpSOCSO + $countMarEmpSOCSO + $countAprEmpSOCSO + $countMayEmpSOCSO + $countJunEmpSOCSO + $countJulEmpSOCSO + $countAugEmpSOCSO + $countSepEmpSOCSO + $countOctEmpSOCSO + $countNovEmpSOCSO + $countDecEmpSOCSO;
	$format_count_allEmpSOCSO = number_format("$count_allEmpSOCSO",2);
	
	$pdf->Cell (17,5,$format_count_allEmpSOCSO,0,1,"R");
	
	//Employee EIS section
	$pdf->Cell (60,5,'Employee EIS',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countJanEmpEIS = $countJan + $data["eis_employee_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countFebEmpEIS = $countFeb + $data["eis_employee_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countMarEmpEIS = $countMar + $data["eis_employee_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countAprEmpEIS = $countApr + $data["eis_employee_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countMayEmpEIS = $countMay + $data["eis_employee_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countJunEmpEIS = $countJun + $data["eis_employee_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countJulEmpEIS = $countJul + $data["eis_employee_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countAugEmpEIS = $countAug + $data["eis_employee_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countSepEmpEIS = $countSep + $data["eis_employee_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countOctEmpEIS = $countOct + $data["eis_employee_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countNovEmpEIS = $countNov + $data["eis_employee_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["eis_employee_deduction"],0,0,"R");
            $countDecEmpEIS = $countDec + $data["eis_employee_deduction"];
        }
		
    }
	$count_allEmpEIS = $countJanEmpEIS + $countFebEmpEIS + $countMarEmpEIS + $countAprEmpEIS + $countMayEmpEIS + $countJunEmpEIS + $countJulEmpEIS + $countAugEmpEIS + $countSepEmpEIS + $countOctEmpEIS + $countNovEmpEIS + $countDecEmpEIS;
	$format_count_allEmpEIS = number_format("$count_allEmpEIS",2);
	
    $pdf->Cell (17,5,$format_count_allEmpEIS,0,1,"R");
	
	//Deduction section
	$pdf->Cell (60,5,'Deduction',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countJanDeduction = $countJan + $data["process_payroll_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countFebDeduction = $countFeb + $data["process_payroll_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countMarDeduction = $countMar + $data["process_payroll_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countAprDeduction = $countApr + $data["process_payroll_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countMayDeduction = $countMay + $data["process_payroll_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countJunDeduction = $countJun + $data["process_payroll_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countJulDeduction = $countJul + $data["process_payroll_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countAugDeduction = $countAug + $data["process_payroll_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countSepDeduction = $countSep + $data["process_payroll_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countOctDeduction = $countOct + $data["process_payroll_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countNovDeduction = $countNov + $data["process_payroll_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_deduction"],0,0,"R");
            $countDecDeduction = $countDec + $data["process_payroll_deduction"];
        }
		
    }
	$count_allDeduction = $countJanDeduction + $countFebDeduction + $countMarDeduction + $countAprDeduction + $countMayDeduction + $countJunDeduction + $countJulDeduction + $countAugDeduction + $countSepDeduction + $countOctDeduction + $countNovDeduction + $countDecDeduction;
	$format_count_allDeduction = number_format("$count_allDeduction",2);
	
    $pdf->Cell (17,5,$format_count_allDeduction,0,1,"R");

	//Loan section
	$pdf->Cell (60,5,'Loan',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countJanLoan = $countJan + $data["process_payroll_loan"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countFebLoan = $countFeb + $data["process_payroll_loan"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countMarLoan = $countMar + $data["process_payroll_loan"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countAprLoan = $countApr + $data["process_payroll_loan"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countMayLoan = $countMay + $data["process_payroll_loan"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countJunLoan = $countJun + $data["process_payroll_loan"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countJulLoan = $countJul + $data["process_payroll_loan"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countAugLoan = $countAug + $data["process_payroll_loan"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countSepLoan = $countSep + $data["process_payroll_loan"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countOctLoan = $countOct + $data["process_payroll_loan"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countNovLoan = $countNov + $data["process_payroll_loan"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_loan"],0,0,"R");
            $countDecLoan = $countDec + $data["process_payroll_loan"];
        }
		
    }
	$count_allLoan = $countJanLoan + $countFebLoan + $countMarLoan + $countAprLoan + $countMayLoan + $countJunLoan + $countJulLoan + $countAugLoan + $countSepLoan + $countOctLoan + $countNovLoan + $countDecLoan;
	$format_count_allLoan = number_format("$count_allLoan",2);
	
    $pdf->Cell (17,5,$format_count_allLoan,0,1,"R");
	
	//Unpaid Leave section
	$pdf->Cell (60,5,'Unpaid Leave',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countJanUnpaidLeave = $countJan + $data["process_payroll_unpaid_leave"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countFebUnpaidLeave = $countFeb + $data["process_payroll_unpaid_leave"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countMarUnpaidLeave = $countMar + $data["process_payroll_unpaid_leave"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countAprUnpaidLeave = $countApr + $data["process_payroll_unpaid_leave"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countMayUnpaidLeave = $countMay + $data["process_payroll_unpaid_leave"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countJunUnpaidLeave = $countJun + $data["process_payroll_unpaid_leave"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countJulUnpaidLeave = $countJul + $data["process_payroll_unpaid_leave"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countAugUnpaidLeave = $countAug + $data["process_payroll_unpaid_leave"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countSepUnpaidLeave = $countSep + $data["process_payroll_unpaid_leave"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countOctUnpaidLeave = $countOct + $data["process_payroll_unpaid_leave"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countNovUnpaidLeave = $countNov + $data["process_payroll_unpaid_leave"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_unpaid_leave"],0,0,"R");
            $countDecUnpaidLeave = $countDec + $data["process_payroll_unpaid_leave"];
        }
		
    }
	$count_allUnpaidLeave = $countJanUnpaidLeave + $countFebUnpaidLeave + $countMarUnpaidLeave + $countAprUnpaidLeave + $countMayUnpaidLeave + $countJunUnpaidLeave + $countJulUnpaidLeave + $countAugUnpaidLeave + $countSepUnpaidLeave + $countOctUnpaidLeave + $countNovUnpaidLeave + $countDecUnpaidLeave;
	$format_count_allUnpaidLeave = number_format("$count_allUnpaidLeave",2);
	
    $pdf->Cell (17,5,$format_count_allUnpaidLeave,0,1,"R");
	
	//Advance Deduct section
	$pdf->Cell (60,5,'Advance Deduct',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countJanAdvanceDeduct = $countJan + $data["process_payroll_advance_deduct"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countFebAdvanceDeduct = $countFeb + $data["process_payroll_advance_deduct"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countMarAdvanceDeduct = $countMar + $data["process_payroll_advance_deduct"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countAprAdvanceDeduct = $countApr + $data["process_payroll_advance_deduct"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countMayAdvanceDeduct = $countMay + $data["process_payroll_advance_deduct"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countJunAdvanceDeduct = $countJun + $data["process_payroll_advance_deduct"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countJulAdvanceDeduct = $countJul + $data["process_payroll_advance_deduct"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countAugAdvanceDeduct = $countAug + $data["process_payroll_advance_deduct"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countSepAdvanceDeduct = $countSep + $data["process_payroll_advance_deduct"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countOctAdvanceDeduct = $countOct + $data["process_payroll_advance_deduct"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countNovAdvanceDeduct = $countNov + $data["process_payroll_advance_deduct"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["process_payroll_advance_deduct"],0,0,"R");
            $countDecAdvanceDeduct = $countDec + $data["process_payroll_advance_deduct"];
        }
		
    }
	$count_allAdvanceDeduct = $countJanAdvanceDeduct + $countFebAdvanceDeduct + $countMarAdvanceDeduct + $countAprAdvanceDeduct + $countMayAdvanceDeduct + $countJunAdvanceDeduct + $countJulAdvanceDeduct + $countAugAdvanceDeduct + $countSepAdvanceDeduct + $countOctAdvanceDeduct + $countNovAdvanceDeduct + $countDecAdvanceDeduct;
	$format_count_allAdvanceDeduct = number_format("$count_allAdvanceDeduct",2);
	
    $pdf->Cell (17,5,$format_count_allAdvanceDeduct,0,1,"R");
	
	//yearly individual total deductions 
	$pdf->SetFont("Arial","B", 8);
	$pdf->Cell (60,5,'Total Deductions',0,0);

	//total earnings by month formatted
	$total_deductions_jan = $countJanEmpEPF + $countJanEmpSOCSO + $countJanEmpEIS + $countJanDeduction + $countJanLoan + $countJanUnpaidLeave + $countJanAdvanceDeduct;
	$format_total_deductions_jan = number_format("$total_deductions_jan",2);
	
	$total_deductions_feb = $countFebEmpEPF + $countFebEmpSOCSO + $countFebEmpEIS + $countFebDeduction + $countFebLoan + $countFebUnpaidLeave + $countFebAdvanceDeduct;
	$format_total_deductions_feb = number_format("$total_deductions_feb",2);
	
	$total_deductions_mar = $countMarEmpEPF + $countMarEmpSOCSO + $countMarEmpEIS + $countMarDeduction + $countMarLoan + $countMarUnpaidLeave + $countMarAdvanceDeduct;
	$format_total_deductions_mar = number_format("$total_deductions_mar",2);
	
	$total_deductions_apr = $countAprEmpEPF + $countAprEmpSOCSO + $countAprEmpEIS + $countAprDeduction + $countAprLoan + $countAprUnpaidLeave + $countAprAdvanceDeduct;
	$format_total_deductions_apr = number_format("$total_deductions_apr",2);
	
	$total_deductions_may = $countMayEmpEPF + $countMayEmpSOCSO + $countMayEmpEIS + $countMayDeduction + $countMayLoan + $countMayUnpaidLeave + $countMayAdvanceDeduct;
	$format_total_deductions_may = number_format("$total_deductions_may",2);
	
	$total_deductions_jun = $countJunEmpEPF + $countJunEmpSOCSO + $countJunEmpEIS + $countJunDeduction + $countJunLoan + $countJunUnpaidLeave + $countJunAdvanceDeduct;
	$format_total_deductions_jun = number_format("$total_deductions_jun",2);
	
	$total_deductions_jul = $countJulEmpEPF + $countJulEmpSOCSO + $countJulEmpEIS + $countJulDeduction + $countJulLoan + $countJulUnpaidLeave + $countJulAdvanceDeduct;
	$format_total_deductions_jul = number_format("$total_deductions_jul",2);
	
	$total_deductions_aug = $countAugEmpEPF + $countAugEmpSOCSO + $countAugEmpEIS + $countAugDeduction + $countAugLoan + $countAugUnpaidLeave + $countAugAdvanceDeduct;
	$format_total_deductions_aug = number_format("$total_deductions_aug",2);
	
	$total_deductions_sep = $countSepEmpEPF + $countSepEmpSOCSO + $countSepEmpEIS + $countSepDeduction + $countSepLoan + $countSepUnpaidLeave + $countSepAdvanceDeduct;
	$format_total_deductions_sep = number_format("$total_deductions_sep",2);
	
	$total_deductions_oct = $countOctEmpEPF + $countOctEmpSOCSO + $countOctEmpEIS + $countOctDeduction + $countOctLoan + $countOctUnpaidLeave + $countOctAdvanceDeduct;
	$format_total_deductions_oct = number_format("$total_deductions_oct",2);
	
	$total_deductions_nov = $countNovEmpEPF + $countNovEmpSOCSO + $countNovEmpEIS + $countNovDeduction + $countNovLoan + $countNovUnpaidLeave + $countNovAdvanceDeduct;
	$format_total_deductions_nov = number_format("$total_deductions_nov",2);
	
	$total_deductions_dec = $countDecEmpEPF + $countDecEmpSOCSO + $countDecEmpEIS + $countDecDeduction + $countDecLoan + $countDecUnpaidLeave + $countDecAdvanceDeduct;
	$format_total_deductions_dec = number_format("$total_deductions_dec",2);
	
	
		for($x=1;$x<=12;$x++){
			if($x == 1){
				$pdf->Cell (17,5,$format_total_deductions_jan,"TB",0,"R");
			}
			if($x == 2){
				$pdf->Cell (17,5,$format_total_deductions_feb,"TB",0,"R");
			}
			if($x == 3){
				$pdf->Cell (17,5,$format_total_deductions_mar,"TB",0,"R");
			}
			if($x == 4){
				$pdf->Cell (17,5,$format_total_deductions_apr,"TB",0,"R");
			}
			if($x == 5){
				$pdf->Cell (17,5,$format_total_deductions_may,"TB",0,"R");
			}
			if($x == 6){
				$pdf->Cell (17,5,$format_total_deductions_jun,"TB",0,"R");
			}
			if($x == 7){
				$pdf->Cell (17,5,$format_total_deductions_jul,"TB",0,"R");
			}
			if($x == 8){
				$pdf->Cell (17,5,$format_total_deductions_aug,"TB",0,"R");
			}
			if($x == 9){
				$pdf->Cell (17,5,$format_total_deductions_sep,"TB",0,"R");
			}
			if($x == 10){
				$pdf->Cell (17,5,$format_total_deductions_oct,"TB",0,"R");
			}
			if($x == 11){
				$pdf->Cell (17,5,$format_total_deductions_nov,"TB",0,"R");
			}
			if($x == 12){
				$pdf->Cell (17,5,$format_total_deductions_dec,"TB",0,"R");
			}                        

	}
	
$total_deductions_total = $count_allEmpEPF + $count_allEmpSOCSO + $count_allEmpEIS + $count_allDeduction + $count_allLoan + $count_allUnpaidLeave + $count_allAdvanceDeduct;
$format_total_deductions_total = number_format("$total_deductions_total",2);

$pdf->Cell (17,5,$format_total_deductions_total,"TB",1,"R");

	//Adjustment section
	$pdf->SetFont("Arial","", 8);
	$pdf->Cell (60,10,'Adjustments',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countJanAdjustment = $countJan + $data["process_payroll_adjustment"];
        }
        if($i == 2){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countFebAdjustment = $countFeb + $data["process_payroll_adjustment"];
        }
        if($i == 3){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countMarAdjustment = $countMar + $data["process_payroll_adjustment"];
        }
        if($i == 4){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countAprAdjustment = $countApr + $data["process_payroll_adjustment"];
        }
        if($i == 5){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countMayAdjustment = $countMay + $data["process_payroll_adjustment"];
        }
        if($i == 6){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countJunAdjustment = $countJun + $data["process_payroll_adjustment"];
        }
        if($i == 7){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countJulAdjustment = $countJul + $data["process_payroll_adjustment"];
        }
        if($i == 8){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countAugAdjustment = $countAug + $data["process_payroll_adjustment"];
        }
        if($i == 9){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countSepAdjustment = $countSep + $data["process_payroll_adjustment"];
        }
        if($i == 10){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countOctAdjustment = $countOct + $data["process_payroll_adjustment"];
        } 
        if($i == 11){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countNovAdjustment = $countNov + $data["process_payroll_adjustment"];
        }
        if($i == 12){
            $pdf->Cell (17,10,$data["process_payroll_adjustment"],0,0,"R");
            $countDecAdjustment = $countDec + $data["process_payroll_adjustment"];
        }
		
    }
	$count_allAdjustment = $countJanAdjustment + $countFebAdjustment + $countMarAdjustment + $countAprAdjustment + $countMayAdjustment + $countJunAdjustment + $countJulAdjustment + $countAugAdjustment + $countSepAdjustment + $countOctAdjustment + $countNovAdjustment + $countDecAdjustment;
	$format_count_allAdjustment = number_format("$count_allAdjustment",2);
	
    $pdf->Cell (17,10,$format_count_allAdjustment,0,1,"R");	
	
//yearly individual nett pay
	$pdf->SetFont("Arial","B", 8);
	$pdf->Cell (60,10,'Nett Pay',0,0);
	
	$nett_pay_jan = $total_earnings_jan - $total_deductions_jan + $countJanAdjustment;
	$format_nett_pay_jan = number_format("$nett_pay_jan",2);
	
	$nett_pay_feb = $total_earnings_feb - $total_deductions_feb + $countFebAdjustment;
	$format_nett_pay_feb = number_format("$nett_pay_feb",2);
	
	$nett_pay_mar = $total_earnings_mar - $total_deductions_mar + $countMarAdjustment;
	$format_nett_pay_mar = number_format("$nett_pay_mar",2);
	
	$nett_pay_apr = $total_earnings_apr - $total_deductions_apr + $countAprAdjustment;
	$format_nett_pay_apr = number_format("$nett_pay_apr",2);
	
	$nett_pay_may = $total_earnings_may - $total_deductions_may + $countMayAdjustment;
	$format_nett_pay_may = number_format("$nett_pay_may",2);
	
	$nett_pay_jun = $total_earnings_jun - $total_deductions_jun + $countJunAdjustment;
	$format_nett_pay_jun = number_format("$nett_pay_jun",2);
	
	$nett_pay_jul = $total_earnings_jul - $total_deductions_jul + $countJulAdjustment;
	$format_nett_pay_jul = number_format("$nett_pay_jul",2);
	
	$nett_pay_aug = $total_earnings_aug - $total_deductions_aug + $countAugAdjustment;
	$format_nett_pay_aug = number_format("$nett_pay_aug",2);
	
	$nett_pay_sep = $total_earnings_sep - $total_deductions_sep + $countSepAdjustment;
	$format_nett_pay_sep = number_format("$nett_pay_sep",2);
	
	$nett_pay_oct = $total_earnings_oct - $total_deductions_oct + $countOctAdjustment;
	$format_nett_pay_oct = number_format("$nett_pay_oct",2);
	
	$nett_pay_nov = $total_earnings_nov - $total_deductions_nov + $countNovAdjustment;
	$format_nett_pay_nov = number_format("$nett_pay_nov",2);
	
	$nett_pay_dec = $total_earnings_dec - $total_deductions_dec + $countDecAdjustment;
	$format_nett_pay_dec = number_format("$nett_pay_dec",2);
	
	$nett_pay_total = $total_earnings_total - $total_deductions_total + $count_allAdjustment;
	$format_nett_pay_total = number_format("$nett_pay_total",2);


	for($x=1;$x<=12;$x++){
		if($x == 1){
			$pdf->Cell (17,10,$format_nett_pay_jan,"TB",0,"R");
		}
		if($x == 2){
			$pdf->Cell (17,10,$format_nett_pay_feb,"TB",0,"R");
		}
		if($x == 3){
			$pdf->Cell (17,10,$format_nett_pay_mar,"TB",0,"R");
		}
		if($x == 4){
			$pdf->Cell (17,10,$format_nett_pay_apr,"TB",0,"R");
		}
		if($x == 5){
			$pdf->Cell (17,10,$format_nett_pay_may,"TB",0,"R");
		}
		if($x == 6){
			$pdf->Cell (17,10,$format_nett_pay_jun,"TB",0,"R");
		}
		if($x == 7){
			$pdf->Cell (17,10,$format_nett_pay_jul,"TB",0,"R");
		}
		if($x == 8){
			$pdf->Cell (17,10,$format_nett_pay_aug,"TB",0,"R");
		}
		if($x == 9){
			$pdf->Cell (17,10,$format_nett_pay_sep,"TB",0,"R");
		}
		if($x == 10){
			$pdf->Cell (17,10,$format_nett_pay_oct,"TB",0,"R");
		}
		if($x == 11){
			$pdf->Cell (17,10,$format_nett_pay_nov,"TB",0,"R");
		}
		if($x == 12){
			$pdf->Cell (17,10,$format_nett_pay_dec,"TB",0,"R");
		}                        
	}
	$pdf->Cell (17,10,$format_nett_pay_total,"TB",1,"R");
	
	$pdf->SetFont("Arial","", 8);
	
	//Employer EPF section
	$pdf->Cell (60,5,'Employer EPF',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countJanEmprEPF = $countJan + $data["epf_employer_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countFebEmprEPF = $countFeb + $data["epf_employer_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countMarEmprEPF = $countMar + $data["epf_employer_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countAprEmprEPF = $countApr + $data["epf_employer_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countMayEmprEPF = $countMay + $data["epf_employer_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countJunEmprEPF = $countJun + $data["epf_employer_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countJulEmprEPF = $countJul + $data["epf_employer_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countAugEmprEPF = $countAug + $data["epf_employer_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countSepEmprEPF = $countSep + $data["epf_employer_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countOctEmprEPF = $countOct + $data["epf_employer_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countNovEmprEPF = $countNov + $data["epf_employer_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["epf_employer_deduction"],0,0,"R");
            $countDecEmprEPF = $countDec + $data["epf_employer_deduction"];
        }
		
    }
	$count_allEmprEPF = $countJanEmprEPF + $countFebEmprEPF + $countMarEmprEPF + $countAprEmprEPF + $countMayEmprEPF + $countJunEmprEPF + $countJulEmprEPF + $countAugEmprEPF + $countSepEmprEPF + $countOctEmprEPF + $countNovEmprEPF + $countDecEmprEPF;
	$format_count_allEmprEPF = number_format("$count_allEmprEPF",2);
	
    $pdf->Cell (17,5,$format_count_allEmprEPF,0,1,"R");
	
	//Employer SOCSO section
	$pdf->Cell (60,5,'Employer SOCSO',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countJanEmprSOCSO = $countJan + $data["socso_employer_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countFebEmprSOCSO = $countFeb + $data["socso_employer_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countMarEmprSOCSO = $countMar + $data["socso_employer_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countAprEmprSOCSO = $countApr + $data["socso_employer_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countMayEmprSOCSO = $countMay + $data["socso_employer_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countJunEmprSOCSO = $countJun + $data["socso_employer_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countJulEmprSOCSO = $countJul + $data["socso_employer_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countAugEmprSOCSO = $countAug + $data["socso_employer_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countSepEmprSOCSO = $countSep + $data["socso_employer_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countOctEmprSOCSO = $countOct + $data["socso_employer_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countNovEmprSOCSO = $countNov + $data["socso_employer_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["socso_employer_deduction"],0,0,"R");
            $countDecEmprSOCSO = $countDec + $data["socso_employer_deduction"];
        }
		
    }
	$count_allEmprSOCSO = $countJanEmprSOCSO + $countFebEmprSOCSO + $countMarEmprSOCSO + $countAprEmprSOCSO + $countMayEmprSOCSO + $countJunEmprSOCSO + $countJulEmprSOCSO + $countAugEmprSOCSO + $countSepEmprSOCSO + $countOctEmprSOCSO + $countNovEmprSOCSO + $countDecEmprSOCSO;
	$format_count_allEmprSOCSO = number_format("$count_allEmprSOCSO",2);
	
    $pdf->Cell (17,5,$format_count_allEmprSOCSO,0,1,"R");
	
	//Employer EIS section
	$pdf->Cell (60,5,'Employer EIS',0,0);
	for($i=1;$i<=12;$i++){
		$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
		$data = mysqli_fetch_assoc($query);
		if($i == 1){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countJanEmprEIS = $countJan + $data["eis_employer_deduction"];
        }
        if($i == 2){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countFebEmprEIS = $countFeb + $data["eis_employer_deduction"];
        }
        if($i == 3){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countMarEmprEIS = $countMar + $data["eis_employer_deduction"];
        }
        if($i == 4){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countAprEmprEIS = $countApr + $data["eis_employer_deduction"];
        }
        if($i == 5){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countMayEmprEIS = $countMay + $data["eis_employer_deduction"];
        }
        if($i == 6){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countJunEmprEIS = $countJun + $data["eis_employer_deduction"];
        }
        if($i == 7){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countJulEmprEIS = $countJul + $data["eis_employer_deduction"];
        }
        if($i == 8){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countAugEmprEIS = $countAug + $data["eis_employer_deduction"];
        }
        if($i == 9){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countSepEmprEIS = $countSep + $data["eis_employer_deduction"];
        }
        if($i == 10){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countOctEmprEIS = $countOct + $data["eis_employer_deduction"];
        } 
        if($i == 11){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countNovEmprEIS = $countNov + $data["eis_employer_deduction"];
        }
        if($i == 12){
            $pdf->Cell (17,5,$data["eis_employer_deduction"],0,0,"R");
            $countDecEmprEIS = $countDec + $data["eis_employer_deduction"];
        }
		
    }
	$count_allEmprEIS = $countJanEmprEIS + $countFebEmprEIS + $countMarEmprEIS + $countAprEmprEIS + $countMayEmprEIS + $countJunEmprEIS + $countJulEmprEIS + $countAugEmprEIS + $countSepEmprEIS + $countOctEmprEIS + $countNovEmprEIS + $countDecEmprEIS;
	$format_count_allEmprEIS = number_format("$count_allEmprEIS",2);
	
    $pdf->Cell (17,5,$format_count_allEmprEIS,0,1,"R");
	
//yearly individual total Employer Cost 
	$pdf->SetFont("Arial","B", 8);
	$pdf->Cell (60,5,'Total Employer Cost',0,0);
	
	$employer_cost_jan = $nett_pay_jan + $countJanEmprEPF + $countJanEmprSOCSO + $countJanEmprEIS;
	$format_employer_cost_jan = number_format("$employer_cost_jan",2);
	
	$employer_cost_feb = $nett_pay_feb + $countFebEmprEPF + $countFebEmprSOCSO + $countFebEmprEIS;
	$format_employer_cost_feb = number_format("$employer_cost_feb",2);
	
	$employer_cost_mar = $nett_pay_mar + $countMarEmprEPF + $countMarEmprSOCSO + $countMarEmprEIS;
	$format_employer_cost_mar = number_format("$employer_cost_mar",2);
	
	$employer_cost_apr = $nett_pay_apr + $countAprEmprEPF + $countAprEmprSOCSO + $countAprEmprEIS;
	$format_employer_cost_apr = number_format("$employer_cost_apr",2);
	
	$employer_cost_may = $nett_pay_may + $countMayEmprEPF + $countMayEmprSOCSO + $countMayEmprEIS;
	$format_employer_cost_may = number_format("$employer_cost_may",2);
	
	$employer_cost_jun = $nett_pay_jun + $countJunEmprEPF + $countJunEmprSOCSO + $countJunEmprEIS;
	$format_employer_cost_jun = number_format("$employer_cost_jun",2);
	
	$employer_cost_jul = $nett_pay_jul + $countJulEmprEPF + $countJulEmprSOCSO + $countJulEmprEIS;
	$format_employer_cost_jul = number_format("$employer_cost_jul",2);
	
	$employer_cost_aug = $nett_pay_aug + $countAugEmprEPF + $countAugEmprSOCSO + $countAugEmprEIS;
	$format_employer_cost_aug = number_format("$employer_cost_aug",2);
	
	$employer_cost_sep = $nett_pay_sep + $countSepEmprEPF + $countSepEmprSOCSO + $countSepEmprEIS;
	$format_employer_cost_sep = number_format("$employer_cost_sep",2);
	
	$employer_cost_oct = $nett_pay_oct + $countOctEmprEPF + $countOctEmprSOCSO + $countOctEmprEIS;
	$format_employer_cost_oct = number_format("$employer_cost_oct",2);
	
	$employer_cost_nov = $nett_pay_nov + $countNovEmprEPF + $countNovEmprSOCSO + $countNovEmprEIS;
	$format_employer_cost_nov = number_format("$employer_cost_nov",2);
	
	$employer_cost_dec = $nett_pay_dec + $countDecEmprEPF + $countDecEmprSOCSO + $countDecEmprEIS;
	$format_employer_cost_dec = number_format("$employer_cost_dec",2);
	
	$employer_cost_total = $nett_pay_total + $countDecEmprEPF + $countDecEmprSOCSO + $countDecEmprEIS;
	$format_employer_cost_total = number_format("$employer_cost_total",2);

	for($x=1;$x<=12;$x++){
		if($x == 1){
			$pdf->Cell (17,5,$format_employer_cost_jan,"TB",0,"R");
		}
		if($x == 2){
			$pdf->Cell (17,5,$format_employer_cost_feb,"TB",0,"R");
		}
		if($x == 3){
			$pdf->Cell (17,5,$format_employer_cost_mar,"TB",0,"R");
		}
		if($x == 4){
			$pdf->Cell (17,5,$format_employer_cost_apr,"TB",0,"R");
		}
		if($x == 5){
			$pdf->Cell (17,5,$format_employer_cost_may,"TB",0,"R");
		}
		if($x == 6){
			$pdf->Cell (17,5,$format_employer_cost_jun,"TB",0,"R");
		}
		if($x == 7){
			$pdf->Cell (17,5,$format_employer_cost_jul,"TB",0,"R");
		}
		if($x == 8){
			$pdf->Cell (17,5,$format_employer_cost_aug,"TB",0,"R");
		}
		if($x == 9){
			$pdf->Cell (17,5,$format_employer_cost_sep,"TB",0,"R");
		}
		if($x == 10){
			$pdf->Cell (17,5,$format_employer_cost_oct,"TB",0,"R");
		}
		if($x == 11){
			$pdf->Cell (17,5,$format_employer_cost_nov,"TB",0,"R");
		}
		if($x == 12){
			$pdf->Cell (17,5,$format_employer_cost_dec,"TB",0,"R");
		}                        
	}
	$pdf->Cell (17,5,$format_employer_cost_total,"TB",1,"R");

$pdf->AddPage();
	
}


$pdf->Output();
?>