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
<h1 class="mt-4">Tools</h1>
<hr>
<!-- dashboard contenT here -->
    
    <!-- EPF table -->
    
    <?php
    //insert an id to process payroll
    //get socso rate from process payroll table
    
            $soc_id = 13;
        $select =  mysqli_query($conn, "SELECT * FROM socso_formula WHERE socso_formula_id = '$soc_id'");
        
        while($data = mysqli_fetch_assoc($select)){
            echo $data["socso_formula_id"];
            $x = $data["socso_formula_id"];
        }
    echo $x;
    if(isset($_POST["submit"])){

        
        //$socso_formula_id = 
        
        
        $process_payroll_desc = mysqli_escape_string($conn, $_POST["pp_desc"]);
        
        $input_sql = "INSERT INTO process_payroll (socso_formula_id, process_payroll_desc) VALUES (?,?)";
        $prepared_stmt_insert = mysqli_prepare($conn, $input_sql);
        mysqli_stmt_bind_param($prepared_stmt_insert, 'ss', $x, $process_payroll_desc);
        mysqli_stmt_execute($prepared_stmt_insert);
        mysqli_stmt_close($prepared_stmt_insert);
    }
    
    
    
    ?>
    <form action="tools.php" method="post">
    <input type="text" name="pp_desc">
        <input type="submit" name="submit">
    </form>
    
    
    
    
    
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
