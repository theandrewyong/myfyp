<?php
    session_start();

    include "conn.php";
    $deduction_id = $_GET["id"];
    $delete_sql = "DELETE FROM deduction WHERE deduction_id = '$deduction_id'";
    $delete = mysqli_query($conn, $delete_sql);
    echo $deduction_id;
    header("location:maintainemployee.php");
?>