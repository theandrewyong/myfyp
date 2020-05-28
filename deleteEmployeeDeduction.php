<?php
    session_start();
    //get current username
    $username_id = $_SESSION["username_id"];
    include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}

    $get_id = $_GET["id"];

    $delete_sql = mysqli_query($conn, "DELETE FROM employee_deduction WHERE emp_deduction_id = '$get_id'");

    if($delete_sql){
        echo "<script>alert('Deleted Successfully!');document.location='maintainemployee.php'</script>";
    }else{
        echo "<script>alert('Cannot Delete, Constraints Exists');document.location='maintainemployee.php'</script>";
    }
?>