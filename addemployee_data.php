<?php

$host = "localhost";
$dbusername = "root";
$dbpass = "";
$dbname = "payroll_db";
									
$conn = new mysqli($host, $dbusername, $dbpass, $dbname);

$emp_full_name = $_POST["emp_full_name"];
$emp_gender = $_POST["emp_gender"];
$emp_dob = $_POST["emp_dob"];
$emp_email = $_POST["emp_email"];
$emp_address = $_POST["emp_address"];
$emp_mobile = $_POST["emp_mobile"];
$emp_telephone = $_POST["emp_telephone"];
$emp_ic = $_POST["emp_ic"];
$emp_passport = $_POST["emp_passport"];
$emp_immigration = $_POST["emp_immigration"];
$emp_title = $_POST["emp_title"];
//---------------------------------------------------
$emp_wages = $_POST["emp_wages"];
$emp_payment_method = $_POST["emp_payment_method"];	
$emp_bank_name = $_POST["emp_bank_name"];
$emp_account = $_POST["emp_account"];
$emp_health_status = $_POST["emp_health_status"];
$emp_martial_status = $_POST["emp_martial_status"];
$emp_spouse_status = $_POST["emp_spouse_status"];
$emp_epf = $_POST["emp_epf"];
$emp_socso = $_POST["emp_socso"];
$emp_socso_type = $_POST["emp_socso_type"];
$emp_eis_type = $_POST["emp_eis_type"];
$emp_join_date = $_POST["emp_join_date"];
$emp_confirm_date = $_POST["emp_confirm_date"];
$emp_resign_date = $_POST["emp_resign_date"];
$data_created_date = date("Y/m/d");

										
$new_employee_sql = "INSERT INTO employee_info (emp_full_name, emp_gender, emp_dob, emp_email, emp_address, emp_mobile, emp_telephone, emp_ic, emp_passport, emp_immigration, emp_title, emp_wages, emp_payment_method, emp_bank_name, emp_account, emp_health_status, emp_martial_status, emp_spouse_status, emp_epf, emp_socso, emp_socso_type, emp_eis_type, emp_join_date, emp_confirm_date, emp_resign_date, data_created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_sql);

mysqli_stmt_bind_param($prepared_stmt_insert, 'ssssssssssssssssssssssssss', $emp_full_name, $emp_gender, $emp_dob, $emp_email, $emp_address, $emp_mobile, $emp_telephone, $emp_ic, $emp_passport, $emp_immigration, $emp_title, $emp_wages, $emp_payment_method, $emp_bank_name, $emp_account, $emp_health_status, $emp_martial_status, $emp_spouse_status, $emp_epf, $emp_socso, $emp_socso_type, $emp_eis_type, $emp_join_date, $emp_confirm_date, $emp_resign_date, $data_created_date);

mysqli_stmt_execute($prepared_stmt_insert);
mysqli_stmt_close($prepared_stmt_insert);

header("Location: addemployee.php"); 
?>