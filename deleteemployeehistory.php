<?php
    session_start();

    include "conn.php";
    $get_pid = $_GET["pid"];
    $get_month = $_GET["month"];
    $get_year = $_GET["year"];
    $delete_sql = "DELETE FROM process_payroll WHERE process_payroll_id = '$get_pid'";
    $delete = mysqli_query($conn, $delete_sql);
    //echo $admin_id;
    header("location:historydetails.php?month=$get_month&year=$get_year");
?>