<?php
    session_start();
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
<h1 class="mt-4">Reports</h1>
<hr>
<!-- dashboard conten here -->

  <div class="polaroids">
    
    <div class="polaroid">
    <a href="epf_report.php">
      <img src="img/payslip.png" width="220px;">
      <p>Payslip Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="epf_report.php">
      <img src="img/epf.png" width="220px;">
      <p>EPF Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="epf_report.php">    
      <img src="img/socso.png" width="220px;">
      <p>SOCSO Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="eis_report.php">    
      <img src="img/eis.png" width="220px;">
      <p>EIS Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="payroll_summary_report.php">    
      <img src="img/payroll%20summary.png" width="220px;">
      <p>Payroll Summary Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="yearly_wages_report.php">    
      <img src="img/yearly_icon.png" width="220px;">
      <p>Yearly Wages Report</p>
    </a>
    </div>
    <div class="polaroid">
    <a href="yearly_individual_report.php">    
      <img src="img/yearly_icon.png" width="220px;">
      <p>Yearly Individual Report</p>
    </a>
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
