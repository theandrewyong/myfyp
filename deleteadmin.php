<?php
    session_start();

    include "conn.php";
    $admin_id = $_GET["id"];
    $delete_sql = "DELETE FROM account WHERE username_id = '$admin_id'";
    $delete = mysqli_query($conn, $delete_sql);
    echo $admin_id;
    header("location:adminpanel.php");
?>