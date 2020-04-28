<?php
    session_start();
    include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];
    $allowance_id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Payroll Software - Dashboard</title>

<?php include "all_css.php"; ?>

</head>

<body>

<div class="d-flex" id="wrapper">

<!-- Sidebar -->
<?php include "sidebar.php"; ?>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">

<?php include "navbar.php"; ?>
    
<div class="container-fluid">
<h1 class="mt-4">Edit Allowance</h1>
<hr>
<!-- dashboard conten here -->
    <div class="p-5 bg-white rounded shadow mb-5">
        <?php
        if(isset($_POST["submit"])){
            $edited_allowance_desc = $_POST["edited_desc"];
            $edited_allowance_rate = $_POST["edited_rate"];
            
            mysqli_query($conn, "UPDATE allowance SET allowance_desc = '$edited_allowance_desc', allowance_rate = '$edited_allowance_rate' WHERE allowance_id = '$allowance_id'");
        }
        
        $show_sql = mysqli_query($conn, "SELECT * FROM allowance WHERE allowance_id = '$allowance_id'");
          $show_data = mysqli_fetch_assoc($show_sql);
        
        $allowance_desc = $show_data["allowance_desc"];
        $allowance_rate = $show_data["allowance_rate"];
        
        ?>
        <form action="editallowance.php?id=<?php echo $allowance_id; ?>" method="post">
            <p>Allowance ID
            <input type="text" name="edited_id" value="<?php echo $allowance_id; ?>" class="form-control" disabled>
            </p>
            <p>Allowance Desc
            <input type="text" name="edited_desc" value="<?php echo $allowance_desc; ?>" class="form-control">
            </p>
            <p>Allowance Rate
            <input type="text" name="edited_rate" value="<?php echo $allowance_rate; ?>" class="form-control">
            </p>
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>
</div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<!-- footer here -->
<?php include "footer.php"; ?>    
    
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});
</script>

</body>

</html>
