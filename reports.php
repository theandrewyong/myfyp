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

    <style>
div.gallery {
    
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 200px;
    height: 250px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
min-height: 200px;
    max-height: 200px;
    object-fit: cover;
    
}

div.desc {
    overflow: hidden;
  padding: 15px;
  text-align: center;
}    
    </style>
    
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
<div class="gallery">
  <a href="payslip.php">
    <img src="img/download.png" alt="Cinque Terre" width="100%;">
  <div class="desc">Payslip</div></a>
</div>

<div class="gallery">
  <a target="_blank" href="img_forest.jpg">
    <img src="img/gg.jpg" alt="Forest" width="100%;">
  <div class="desc">Payroll Summary</div></a>
</div>
    
<div class="gallery">
  <a target="_blank" href="img_5terre.jpg" >
    <img src="img/download.png" alt="Cinque Terre" width="100%;">
  <div class="desc">EPF</div></a>
</div>

<div class="gallery">
  <a target="_blank" href="img_forest.jpg">
    <img src="img/gg.jpg" alt="Forest" width="100%;">
  <div class="desc">SOCSO</div></a>
</div>

    
<div class="gallery">
  <a target="_blank" href="img_5terre.jpg" >
    <img src="img/download.png" alt="Cinque Terre" width="100%;">
  <div class="desc">EIS</div></a>
</div>

<div class="gallery">
  <a target="_blank" href="img_forest.jpg">
    <img src="img/gg.jpg" alt="Forest" width="100%;">
  <div class="desc">Yearly Wages</div></a>
</div>


<div class="gallery">
  <a target="_blank" href="img_5terre.jpg" >
    <img src="img/download.png" alt="Cinque Terre" width="100%;">
  <div class="desc">Yearly Individual Wages</div></a>
</div>



    
</div>
<!-- footer here -->
<?php include "footer.php"; ?> 
</div>
<!-- /#page-content-wrapper -->

</div>    
<!-- /#wrapper -->
 
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
