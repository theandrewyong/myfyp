<?php
    session_start();

    include "conn.php";
    $employee_id = $_GET["emp_id"];
    $delete_sql = "DELETE FROM employee_info WHERE emp_id = '$employee_id'";
    $delete = mysqli_query($conn, $delete_sql);
    if($delete){
        echo '<script>' . 'alert(\'Deleted Successfully\')' . '</script>';
    }else{
        echo '<script>' . 'alert(\'Delete Error! Employee Exists in Payroll History\')' . '</script>';
    }
    //header("location:maintainemployee.php");
?>