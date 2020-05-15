<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
$allowance_id = $_GET["id"];

$error = FALSE;
$error_allowance_id = "";
$error_allowance_desc = "";
$error_allowance_rate = "";

if(isset($_POST["submit"])){
    
    $edited_allowance_display_id = $_POST["edited_id"];
    $edited_allowance_desc = $_POST["edited_desc"];
    $edited_allowance_rate = $_POST["edited_rate"];
    
    if(empty($edited_allowance_display_id)){
        $error_allowance_id = '<span class="text-danger"> *Invalid Allowance ID</span>';
        $error = TRUE;
    }
    
    if(empty($edited_allowance_desc)){
       $error_allowance_desc = '<span class="text-danger"> *Invalid Allowance Description</span>';
       $error = TRUE; 
    }
    
    if(empty($edited_allowance_rate)){
        $error_allowance_rate = '<span class="text-danger"> *Invalid Allowance Rate</span>';
        $error = TRUE;
    }

    if($error == FALSE){
        mysqli_query($conn, "UPDATE allowance SET allowance_display_id = '$edited_allowance_display_id', allowance_desc = '$edited_allowance_desc', allowance_rate = '$edited_allowance_rate' WHERE allowance_id = '$allowance_id'");
        echo '<script>alert("Updated Successfully");</script>';
    }    
}

$show_sql = mysqli_query($conn, "SELECT * FROM allowance WHERE allowance_id = '$allowance_id'");
$show_data = mysqli_fetch_assoc($show_sql);

$allowance_display_id = $show_data["allowance_display_id"];
$allowance_desc = $show_data["allowance_desc"];
$allowance_rate = $show_data["allowance_rate"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Dashboard</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Allowance</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
            <form action="editallowance.php?id=<?php echo $allowance_id; ?>" method="post">
                <p>Allowance ID <?php echo $error_allowance_id; ?>
                    <input type="text" name="edited_id" value="<?php echo $allowance_display_id; ?>" class="form-control">
                </p>
                <p>Allowance Desc <?php echo $error_allowance_desc; ?>
                    <input type="text" name="edited_desc" value="<?php echo $allowance_desc; ?>" class="form-control">
                </p>
                <p>Allowance Rate <?php echo $error_allowance_rate; ?>
                    <input type="text" name="edited_rate" value="<?php echo $allowance_rate; ?>" class="form-control">
                </p>
                <input type="submit" name="submit" class="btn btn-primary">
            </form>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
</body>
</html>