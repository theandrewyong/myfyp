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
<h1 class="mt-4">New Payroll</h1>
<!-- dashboard conten here -->
<hr>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="p-5 bg-white rounded shadow mb-5">
<?php
    if(isset($_POST["submit"])){
    //get input data
    $payroll_monthly_process_date = mysqli_escape_string($conn, $_POST["process_payroll_process_date"]);
    $payroll_monthly_from = mysqli_escape_string($conn, $_POST["process_payroll_from"]);
    $payroll_monthly_to = mysqli_escape_string($conn, $_POST["process_payroll_to"]);
    $payroll_monthly_desc_1 = mysqli_escape_string($conn, $_POST["process_payroll_desc_1"]);
    $payroll_monthly_desc_2 = mysqli_escape_string($conn, $_POST["process_payroll_desc_2"]);
    $payroll_monthly_ref_1 = mysqli_escape_string($conn, $_POST["process_payroll_ref_1"]);
    $payroll_monthly_ref_2 = mysqli_escape_string($conn, $_POST["process_payroll_ref_2"]);

    $new_user_sql = "INSERT INTO process_payroll (process_payroll_process_date, process_payroll_from, process_payroll_to, process_payroll_desc_1, process_payroll_desc_2, process_payroll_ref_1, process_payroll_ref_2) VALUES (?,?,?,?,?,?,?)";

    $prepared_stmt_insert = mysqli_prepare($conn, $new_user_sql);
    mysqli_stmt_bind_param($prepared_stmt_insert, 'sssssss', $payroll_monthly_process_date, $payroll_monthly_from, $payroll_monthly_to, $payroll_monthly_desc_1, $payroll_monthly_desc_2, $payroll_monthly_ref_1, $payroll_monthly_ref_2);
    mysqli_stmt_execute($prepared_stmt_insert);
    mysqli_stmt_close($prepared_stmt_insert);
    }
    ?> 

            <form action="newpayroll.php" method="post" enctype="multipart/form-data">
            <p><b>Transaction Posting</b></p>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Process Date</label>
                    <input type="date" class="form-control" name="process_payroll_process_date" value="<?php echo date('Y-m-d'); ?>">
                </div>    
            </div>    
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Year</label>
                    <input type="text" class="form-control" disabled>
                </div>
                <div class="col-md-6 col-12">
                    <label for="">Month</label>
                    <input type="text" class="form-control" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <label for="">Process From</label>
                    <input type="date" class="form-control" name="process_payroll_from" value="<?php echo date('Y-m-01'); ?>">
                </div>
                <div class="col-md-6 col-12">
                    <label for="">To</label>
                    <input type="date" class="form-control" name="process_payroll_to" value="<?php echo date('Y-m-t'); ?>">
                </div>
            </div>
            <br>
            <p><b>Description</b></p>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 1</label>
                    <input type="text" class="form-control" name="process_payroll_desc_1">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Description 2</label>
                    <input type="text" class="form-control" name="process_payroll_desc_2">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 1</label>
                    <input type="text" class="form-control" name="process_payroll_ref_1">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Reference 2</label>
                    <input type="text" class="form-control" name="process_payroll_ref_2">                
                </div>    
            </div>
            <div class="row">
                <div class="col-12">
                    <br>
                    <input type="submit" class="btn btn-success" name="submit">
                    
                </div>    
            </div>
            </form>
        </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="p-5 bg-white rounded shadow mb-5">
            <p><b>Employee</b></p>
                        <div class="table-responsive">
                            <div class="container-fluid">
                            <?php
                            $select_sql = mysqli_query($conn, "SELECT * FROM employee_info");  
                            ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Show admin table -->
                                        <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Employee Name</th>
                                                <th>Process</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($datarows = mysqli_num_rows($select_sql) > 0){
                                            $dynamic_checkbox_id = 0;
                                            while($data = mysqli_fetch_assoc($select_sql)){
                                            $dynamic_checkbox_id += 1;
                                            echo "<tr>";
                                            echo "<td>" . $data["emp_id"] . "</td>";
                                            echo "<td>" . $data["emp_full_name"] . "</td>";
                                            echo "<td>" . '<div class="custom-control custom-checkbox mb-3">' . '<input type="checkbox" class="custom-control-input" id="' . $dynamic_checkbox_id . '" name="example1" checked><label class="custom-control-label" for="' . $dynamic_checkbox_id . '"></label>' . '</div>' . "</td>";
                                            echo "</tr>";
                                            }
                                        }  
                                        ?>
                                        </tbody>
                                        </table>      
                                    </div>
                                </div>                       
                            </div>        
                        </div>
            </div></div>
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
