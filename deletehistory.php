<?php
    session_start();
    include "conn.php";
    $get_month = $_GET["month"];
    $get_year = $_GET["year"];
    $delete_sql = "DELETE FROM process_payroll WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year'";
    $delete = mysqli_query($conn, $delete_sql);
    echo $admin_id;
    header("location:historypayroll.php");
?>