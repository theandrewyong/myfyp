<?php
require("fpdf/fpdf.php");
$conn = @mysqli_connect("localhost", "root", "") or die("Error connecting to database!");
@mysqli_select_db($conn, "payroll_db") or die("Error selecting database!");

$pdf = new FPDF("L","mm","A4");
$pdf->AliasNbPages("{pages}");
$pdf->AddPage();

$pdf->SetFont("Arial","", 8);

//Hardcoded header to align with data
$query=@mysqli_query($conn,"select * from summaryhead");
while($data=@mysqli_fetch_array($query)) {
	$pdf->Cell (20,5,$data["header1"],"LTB",0);
	$pdf->Cell (15,5,$data["header2"],"TB",0);
	$pdf->Cell (15,5,$data["header3"],"TB",0);
	$pdf->Cell (15,5,$data["header4"],"TB",0);
	$pdf->Cell (15,5,$data["header5"],"TB",0);
	$pdf->Cell (20,5,$data["header6"],"TB",0);
	$pdf->Cell (10,5,$data["header7"],"TB",0);
	$pdf->Cell (15,5,$data["header8"],"TB",0);
	$pdf->Cell (10,5,$data["header9"],"TB",0);
	$pdf->Cell (10,5,$data["header10"],"TB",0);
	$pdf->Cell (25,5,$data["header11"],"TB",0);
	$pdf->Cell (25,5,$data["header12"],"TB",0);
	$pdf->Cell (30,5,$data["header13"],"TB",0);
	$pdf->Cell (25,5,$data["header14"],"TB",0);
	$pdf->Cell (25,5,$data["header15"],"TB",0);
	$pdf->Cell (10,5,$data["header16"],"RTB",1);
	
}

//Data from a created table
$query=@mysqli_query($conn,"select * from summaryzz");
while($data=@mysqli_fetch_array($query)) {
	$pdf->Cell (20,5,$data["employee_name"],0,0);
	$pdf->Cell (15,5,$data["default_wages"],0,0);
	$pdf->Cell (15,5,$data["meal"],0,0);
	$pdf->Cell (15,5,$data["hphone"],0,0);
	$pdf->Cell (15,5,$data["petrol"],0,0);
	$pdf->Cell (20,5,$data["gross_pay"],0,0);
	$pdf->Cell (10,5,$data["epf"],0,0);
	$pdf->Cell (15,5,$data["socso"],0,0);
	$pdf->Cell (10,5,$data["pcb"],0,0);
	$pdf->Cell (10,5,$data["eis"],0,0);
	$pdf->Cell (25,5,$data["gross_deduct"],0,0);
	$pdf->Cell (25,5,$data["epf_employer"],0,0);
	$pdf->Cell (30,5,$data["socso_employer"],0,0);
	$pdf->Cell (25,5,$data["eis_employer"],0,0);
	$pdf->Cell (25,5,$data["gross_net_pay"],0,0);
	$pdf->Cell (10,5,$data["summary_id"],0,1);
	
}

//Hardcoded total since there is no exising working database table to refer
$query=@mysqli_query($conn,"select * from summarytotalz");
while($data=@mysqli_fetch_array($query)) {
	$pdf->Cell (20,5,$data["title"],"TB",0);
	$pdf->Cell (15,5,$data["t_wages"],"TB",0);
	$pdf->Cell (15,5,$data["t_meal"],"TB",0);
	$pdf->Cell (15,5,$data["t_hphone"],"TB",0);
	$pdf->Cell (15,5,$data["t_petrol"],"TB",0);
	$pdf->Cell (20,5,$data["t_gross_pay"],"TB",0);
	$pdf->Cell (10,5,$data["t_epf"],"TB",0);
	$pdf->Cell (15,5,$data["t_socso"],"TB",0);
	$pdf->Cell (10,5,$data["t_pcb"],"TB",0);
	$pdf->Cell (10,5,$data["t_eis"],"TB",0);
	$pdf->Cell (25,5,$data["t_gross_deduct"],"TB",0);
	$pdf->Cell (25,5,$data["t_epf_employer"],"TB",0);
	$pdf->Cell (30,5,$data["t_socso_employer"],"TB",0);
	$pdf->Cell (25,5,$data["t_eis_employer"],"TB",0);
	$pdf->Cell (25,5,$data["t_gross_net_pay"],"TB",0);
	
}
	
$pdf->Output();
?>