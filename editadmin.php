<?php
    session_start();
    include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];
    $admin_id = $_GET["id"];
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
<h1 class="mt-4">Edit Admin</h1>
<hr>
<!-- dashboard conten here -->
    <div class="p-5 bg-white rounded shadow mb-5">
        <?php
        if(isset($_POST["submit"])){
            $edited_admin_username = $_POST["edited_username"];
            $edited_admin_password = $_POST["edited_password"];
            $edited_admin_permission = $_POST["edited_permission"];
            
            mysqli_query($conn, "UPDATE account SET username = '$edited_admin_username', password = '$edited_admin_password', permission = '$edited_admin_permission' WHERE username_id = '$admin_id'");
        }
        
        $show_sql = mysqli_query($conn, "SELECT * FROM account WHERE username_id = '$admin_id'");
          $show_data = mysqli_fetch_assoc($show_sql);
        
        $admin_username = $show_data["username"];
        $admin_password = $show_data["password"];
        $admin_permission = $show_data["permission"];
       // echo $admin_permission;
        ?>
        <form action="editadmin.php?id=<?php echo $admin_id; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
            <label for="email">Username:</label>
                <input type="text" class="form-control" id="email" name="edited_username" value="<?php echo $admin_username; ?>">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="edited_password" value="<?php echo $admin_password; ?>">
            </div>
            <div class="form-group">
                <label for="sel1">Permission level (1 for Admin | 2 for Employee):</label>
                <select class="form-control" id="sel1" name="edited_permission">
                    <option>Select Permission</option>
                    <option value="1" <?php if($admin_permission == 1){echo 'selected="' . "selected" . '"';}?>>1</option>
                    <option value="2" <?php if($admin_permission == 2){echo 'selected="' . "selected" . '"';}?>>2</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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