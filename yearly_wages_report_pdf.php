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

//get year
//get month
$year = $_GET["year"];
$month = $_GET["month"];

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

   $pdf->Cell (10,7,$ua,0,0);
   $pdf->Cell (50,7,$data["emp_full_name"],0,0);
  
    //show all 12 months
    for($i=1;$i<=12;$i++){
        //if individual month echo wage for that specific month
        $query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$ua'");
        $data = mysqli_fetch_assoc($query);
      //echo $esresult["emp_id"];
        if($i == 1){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countJan = $countJan + $data["process_payroll_wage"];
            $count_all = $count_all + $countJan;
        }
        if($i == 2){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countFeb = $countFeb + $data["process_payroll_wage"];
        }
        if($i == 3){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countMar = $countMar + $data["process_payroll_wage"];
        }
        if($i == 4){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countApr = $countApr + $data["process_payroll_wage"];
        }
        if($i == 5){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countMay = $countMay + $data["process_payroll_wage"];
        }
        if($i == 6){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countJun = $countJun + $data["process_payroll_wage"];
        }
        if($i == 7){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countJul = $countJul + $data["process_payroll_wage"];
        }
        if($i == 8){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countAug = $countAug + $data["process_payroll_wage"];
        }
        if($i == 9){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countSep = $countSep + $data["process_payroll_wage"];
        }
        if($i == 10){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countOct = $countOct + $data["process_payroll_wage"];
        } 
        if($i == 11){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countNov = $countNov + $data["process_payroll_wage"];
        }
        if($i == 12){
            $pdf->Cell (17,7,$data["process_payroll_wage"],0,0);
            $countDec = $countDec + $data["process_payroll_wage"];
        }          
    }
     $pdf->Cell (17,7,"total",0,1);
}


//yearly wages totals **
$pdf->SetFont("Arial","B", 9);
$pdf->Cell (10,7,'',0,0);
$pdf->Cell (50,7,'Grand Total',0,0);

for($x=1;$x<=12;$x++){
    if($x == 1){
        $pdf->Cell (17,7,$countJan,"TB",0);
    }
    if($x == 2){
        $pdf->Cell (17,7,$countFeb,"TB",0);
    }
    if($x == 3){
        $pdf->Cell (17,7,$countMar,"TB",0);
    }
    if($x == 4){
        $pdf->Cell (17,7,$countApr,"TB",0);
    }
    if($x == 5){
        $pdf->Cell (17,7,$countMay,"TB",0);
    }
    if($x == 6){
        $pdf->Cell (17,7,$countJun,"TB",0);
    }
    if($x == 7){
        $pdf->Cell (17,7,$countJul,"TB",0);
    }
    if($x == 8){
        $pdf->Cell (17,7,$countAug,"TB",0);
    }
    if($x == 9){
        $pdf->Cell (17,7,$countSep,"TB",0);
    }
    if($x == 10){
        $pdf->Cell (17,7,$countOct,"TB",0);
    }
    if($x == 11){
        $pdf->Cell (17,7,$countNov,"TB",0);
    }
    if($x == 12){
        $pdf->Cell (17,7,$countDec,"TB",0);
    }                        

}
$pdf->Cell (17,7,'Total',"TB",1);

$pdf->Output();
?>