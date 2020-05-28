<?php
    session_start();
    //get current username
    $username_id = $_SESSION["username_id"];
    include "conn.php";

if(empty($_SESSION["username"])){
header("location:index.php");
}
    $get_id = $_GET["pid"];

    $delete_sql = mysqli_query($conn, "DELETE FROM process_adhoc WHERE process_adhoc_id = '$get_id'");

    if($delete_sql){
        echo "<script>alert('Deleted Successfully!');document.location='historypayroll.php'</script>";
    }else{
        echo "<script>alert('Cannot Delete, Constraints Exists');document.location='historypayroll.php'</script>";
    }
?>