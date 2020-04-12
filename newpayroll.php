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

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">

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
<h1 class="mt-4">New Payroll</h1>
<!-- dashboard conten here -->
<hr>
    <p><b>Payroll Transaction</b></p>
    
    <div class="row">
        <div class="col-md-6 col-12">
            <form action="#">
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Year  </label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 col-12">
                    <label for="">Month</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Process From</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-md-6 col-12">
                    <label for="">To</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <br>
            <p><b>Description</b></p>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 1</label>
                    <input type="text" class="form-control">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 2</label>
                    <input type="text" class="form-control">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 1</label>
                    <input type="text" class="form-control">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 2</label>
                    <input type="text" class="form-control">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <br>
                    <input type="submit" class="btn btn-success">
                    
                </div>    
            </div>
            </form>
        </div>
        <div class="col-md-6 col-12">
            <br>
            <p><b>Employee</b></p>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
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
