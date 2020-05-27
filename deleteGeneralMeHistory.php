<?php
    session_start();
    //get current username
    $username_id = $_SESSION["username_id"];
    include "conn.php";
    $get_month = $_GET["month"];
    $get_year = $_GET["year"];

    $delete_sql = mysqli_query($conn, "DELETE FROM process_payroll WHERE process_payroll_process_month = '$get_month' AND process_payroll_process_year = '$get_year'");

    if($delete_sql){
        echo "<script>alert('Deleted Successfully!');document.location='historypayroll.php'</script>";
    }else{
        echo "<script>alert('Cannot Delete, Constraints Exists');document.location='historypayroll.php'</script>";
    }
?>