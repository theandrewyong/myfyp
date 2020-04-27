<?php
    session_start();
	include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Add Employee</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
<div id="page-content-wrapper">
<?php include "navbar.php"; ?>
<div class="container-fluid">
<h1 class="mt-4">Add Allowance Item</h1>
<hr>
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <br>

			<div id="tabsJustifiedContent" class="tab-content">
				
                <div id="profile1" class="tab-pane fade active show">
                    <div class="row pb-2">

					</div>
                </div>
				
            </div>
        </div>
	</div>
</section>
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
