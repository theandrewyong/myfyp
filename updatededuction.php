<?php
    session_start();
    include "conn.php";
    $deduction_id = $_GET["id"];
    $deduction_desc = $_GET["desc"];
    $deduction_sql = mysqli_query($conn, "UPDATE deduction SET deduction_desc = '$deduction_desc' WHERE deduction_id = '$deduction_id'");
    //header("location:maintainemployee.php");
    echo $deduction_id;
    echo $deduction_desc;

?>