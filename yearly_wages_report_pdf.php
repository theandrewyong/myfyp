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
$pdf->Cell (0,20,"Yearly Wages " . $get_year,0,1,"C");

//yearly wages header
$pdf->SetFont("Arial","", 9);

$pdf->Cell (10,7,'ID',"LTB",0);
$pdf->Cell (50,7,'Employee Name',"TB",0);
$pdf->Cell (17,7,'Jan-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Feb-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Mar-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Apr-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'May-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Jun-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Jul-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Aug-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Sep-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Oct-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Nov-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Dec-' . $get_year,"TB",0,"R");
$pdf->Cell (17,7,'Total',"RTB",1,"C");

//get year
//get month
$year = $_GET["year"];
$month = $_GET["month"];

//get unique employee
$count_employee_by_year_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_year = '$year'");
$unique_employee[]='';
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

$format_countJan = 0;
$format_countFeb = 0;
$format_countMar = 0;
$format_countApr = 0;
$format_countMay = 0;
$format_countJun = 0;
$format_countJul = 0;
$format_countAug = 0;
$format_countSep = 0;
$format_countOct = 0;
$format_countNov = 0;
$format_countDec = 0;

$wageJan = 0;
$wageFeb = 0;
$wageMar = 0;
$wageApr = 0;
$wageMay = 0;
$wageJun = 0;
$wageJul = 0;
$wageAug = 0;
$wageSep = 0;
$wageOct = 0;
$wageNov = 0;
$wageDec = 0;
$count_all = 0;
$yearly_total = 0;   


foreach($unique_employee as $ua){
$query = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$ua'");
$data = mysqli_fetch_assoc($query);    
   $pdf->Cell (10,7,$ua,0,0);
   $pdf->Cell (50,7,$data["emp_full_name"],0,0);
    //show all 12 months
    for($i=1;$i<=12;$i++){
        //if individual month echo wage for that specific month
        $query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
        $data = mysqli_fetch_assoc($query);
      //echo $esresult["emp_id"];
        if($i == 1){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageJan = $data["process_payroll_wage"];
            $countJan = $countJan + $data["process_payroll_wage"];
			$format_countJan = number_format("$countJan",2);
        }
        if($i == 2){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageFeb = $data["process_payroll_wage"];
            $countFeb = $countFeb + $data["process_payroll_wage"];
			$format_countFeb = number_format("$countFeb",2);
        }
        if($i == 3){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageMar = $data["process_payroll_wage"];
            $countMar = $countMar + $data["process_payroll_wage"];
			$format_countMar = number_format("$countMar",2);
        }
        if($i == 4){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageApr = $data["process_payroll_wage"];
            $countApr = $countApr + $data["process_payroll_wage"];
			$format_countApr = number_format("$countApr",2);
        }
        if($i == 5){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageMay = $data["process_payroll_wage"];
            $countMay = $countMay + $data["process_payroll_wage"];
			$format_countMay = number_format("$countMay",2);
        }
        if($i == 6){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageJun = $data["process_payroll_wage"];
            $countJun = $countJun + $data["process_payroll_wage"];
			$format_countJun = number_format("$countJun",2);
        }
        if($i == 7){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageJul = $data["process_payroll_wage"];
            $countJul = $countJul + $data["process_payroll_wage"];
			$format_countJul = number_format("$countJul",2);
        }
        if($i == 8){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageAug = $data["process_payroll_wage"];
            $countAug = $countAug + $data["process_payroll_wage"];
			$format_countAug = number_format("$countAug",2);
        }
        if($i == 9){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageSep = $data["process_payroll_wage"];
            $countSep = $countSep + $data["process_payroll_wage"];
			$format_countSep = number_format("$countSep",2);
        }
        if($i == 10){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageOct = $data["process_payroll_wage"];
            $countOct = $countOct + $data["process_payroll_wage"];
			$format_countOct = number_format("$countOct",2);
        } 
        if($i == 11){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageNov = $data["process_payroll_wage"];
            $countNov = $countNov + $data["process_payroll_wage"];
			$format_countNov = number_format("$countNov",2);
        }
        if($i == 12){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0,"R");
			$wageDec = $data["process_payroll_wage"];
            $countDec = $countDec + $data["process_payroll_wage"];
			$format_countDec = number_format("$countDec",2);
        }  
		$yearly_total = $wageJan + $wageFeb + $wageMar + $wageApr + $wageMay + $wageJun + $wageJul + $wageAug + $wageSep + $wageOct + $wageNov + $wageDec;
	
			
    }
	
	$format_yearly_total = number_format("$yearly_total",2);
    $pdf->Cell (17,7,$format_yearly_total,0,1,"R");
}


//yearly wages totals **
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (50,7,'Grand Total',0,0);

for($x=1;$x<=12;$x++){
    if($x == 1){
        $pdf->Cell (17,7,$format_countJan,"TB",0,"R");
    }
    if($x == 2){
        $pdf->Cell (17,7,$format_countFeb,"TB",0,"R");
    }
    if($x == 3){
        $pdf->Cell (17,7,$format_countMar,"TB",0,"R");
    }
    if($x == 4){
        $pdf->Cell (17,7,$format_countApr,"TB",0,"R");
    }
    if($x == 5){
        $pdf->Cell (17,7,$format_countMay,"TB",0,"R");
    }
    if($x == 6){
        $pdf->Cell (17,7,$format_countJun,"TB",0,"R");
    }
    if($x == 7){
        $pdf->Cell (17,7,$format_countJul,"TB",0,"R");
    }
    if($x == 8){
        $pdf->Cell (17,7,$format_countAug,"TB",0,"R");
    }
    if($x == 9){
        $pdf->Cell (17,7,$format_countSep,"TB",0,"R");
    }
    if($x == 10){
        $pdf->Cell (17,7,$format_countOct,"TB",0,"R");
    }
    if($x == 11){
        $pdf->Cell (17,7,$format_countNov,"TB",0,"R");
    }
    if($x == 12){
        $pdf->Cell (17,7,$format_countDec,"TB",0,"R");
    }                       

}
$grand_yearly_total = $countJan + $countFeb + $countMar + $countApr + $countMay + $countJun + $countJul + $countAug + $countSep + $countOct + $countNov + $countDec;
$format_grand_yearly_total = number_format("$grand_yearly_total",2);
$pdf->Cell (17,7,$format_grand_yearly_total,"TB",1,"R");

$pdf->Output();
?>