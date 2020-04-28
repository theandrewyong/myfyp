<?php
    session_start();

    include "conn.php";
    $allowance_id = $_GET["id"];
    $delete_sql = "DELETE FROM allowance WHERE allowance_id = '$allowance_id'";
    $delete = mysqli_query($conn, $delete_sql);
    echo $allowance_id;
    header("location:maintainemployee.php");
?>