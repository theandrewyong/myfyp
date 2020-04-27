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
<meta name="description" content="">
<meta name="author" content="">

<title>Payroll Software - Payroll History</title>

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
<h1 class="mt-4">Payroll History</h1>
<!-- dashboard conten here -->
<hr>
    <div class="row">
        <div class="col-md-6 col-12">
        <ul class="list-group">
            <li class="list-group-item active">Month End</li>
            <?php
                $select_all_sql = mysqli_query($conn, "SELECT * FROM process_payroll");
                while($data = mysqli_fetch_assoc($select_all_sql)){
                
                echo '<a href="historydetails.php">';
                echo '<li class="list-group-item">';
                echo 'Process date: ' . $data["payroll_monthly_process_date"] . '<br>' . 'From ' . $data["payroll_monthly_from"] . ' to ' . $data["payroll_monthly_to"];
                echo '</li>';
                echo '</a>';
                }        
            ?>
            
            </ul>
        </div>
        <div class="col-md-6 col-12">
        <ul class="list-group">
            <li class="list-group-item active">Ad Hoc</li>
            <li class="list-group-item">Jan 2020</li>
            <li class="list-group-item">Feb 2020</li>
            <li class="list-group-item">Mar 2020</li>
            <li class="list-group-item">Apr 2020</li>
        </ul>
        </div>
    </div>
    <br>
    <h2>Past Payroll from 2018 - 2019</h2>
    <!-- dashboard conten here -->
    <hr>
    <div class="row">
        <div class="col-md-6 col-12">
            
        </div>
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
