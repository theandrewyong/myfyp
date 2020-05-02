<?php
    session_start();

    include "conn.php";
    $employee_id = $_GET["id"];
    $delete_sql = "DELETE FROM employee_info WHERE emp_id = '$employee_id'";
    $delete = mysqli_query($conn, $delete_sql);
    echo $employee_id;
    header("location:maintainemployee.php");
?>