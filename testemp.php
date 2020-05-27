<?php
include "conn.php";
for($i=0;$i<10000;$i++){
    
$sql = mysqli_query($conn, "INSERT INTO employee_info (emp_display_id, emp_full_name, emp_gender, emp_dob, emp_email, emp_address, emp_mobile, emp_telephone, emp_ic, emp_passport, emp_immigration, emp_title, emp_wages, emp_payment_method, emp_bank_name, emp_account, emp_health_status, emp_martial_status, emp_spouse_status, emp_epf, emp_socso, emp_socso_type, emp_eis_type, emp_join_date, emp_confirm_date) VALUES ('E999','Sohai','gg','12-12-2000','a@g.com','a','12','3','4','5','6','dunno','3222','cash','hlb','12','gg','gg','gg','12','34','44','a','12-12-2000','12-12-2000')"); 
    
    
}


?>