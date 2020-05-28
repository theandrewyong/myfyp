<?php
    session_start();
    //get current username
    $username_id = $_SESSION["username_id"];
    include "conn.php";
if(empty($_SESSION["username"])){
header("location:index.php");
}

    $get_id = $_GET["id"];
    //select all admins
    //echo $get_id;

    //count all accounts that have permission 1
    $cp = mysqli_query($conn, "SELECT * FROM account WHERE permission = '1'");
    $cp_result = mysqli_num_rows($cp);
        echo $cp_result;
    

    $select_all = mysqli_query($conn, "SELECT * FROM account WHERE username_id = '$get_id'");
    $all_result = mysqli_fetch_assoc($select_all);
    //get permission from id
    $permission = $all_result["permission"];
        
    //perform delete case
    if($permission != 1){
       //$delete_sql = mysqli_query($conn, "DELETE * FROM account WHERE username_id = '$get_id'");
        mysqli_query($conn, "DELETE FROM account WHERE username_id = '$get_id'");
        echo "<script>alert('Deleted Successfully!');document.location='adminpanel.php'</script>";
    }


    if($permission == 1){
        //check if only 1 admin left
        if($cp_result == 1){
            echo "<script>alert('Cannot Delete, Must have at least 1 Admin');document.location='adminpanel.php'</script>";
        }else{
            //check if person deleting is own account or others
            if($get_id == $username_id){
                //if it is own account, logged out after change
                echo "<script>alert('Deleted Successfully! You will be logged out');document.location='index.php'</script>";
            }else{
                mysqli_query($conn, "DELETE FROM account WHERE username_id = '$get_id'");
                //if not, dont log out
                echo "<script>alert('Deleted Successfully!');document.location='adminpanel.php'</script>";
            }
            
        }
    }
    
?>

