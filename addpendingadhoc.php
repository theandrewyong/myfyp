<?php
session_start();
include "conn.php";
    if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

//while loop select option
$select_all_employee_sql = mysqli_query($conn, "SELECT * FROM employee_info");


if(isset($_POST["submit"])){
    $get_adhoc_emp_name = $_POST["adhoc_emp_name"];
    $get_adhoc_type = $_POST["adhoc_type"];
    $get_adhoc_amt = $_POST["adhoc_amt"];
    //get emp id where name is
    $get_id_sql = mysqli_query($conn, "SELECT emp_id FROM employee_info WHERE emp_full_name = '$get_adhoc_emp_name'");
    $id_result = mysqli_fetch_assoc($get_id_sql);
    $get_adhoc_emp_id = $id_result["emp_id"];
    $get_adhoc_status = "PENDING";
    mysqli_query($conn, "INSERT INTO adhoc_pending (emp_id, emp_full_name, adhoc_type, adhoc_amt, adhoc_status) VALUES ('$get_adhoc_emp_id','$get_adhoc_emp_name','$get_adhoc_type','$get_adhoc_amt','$get_adhoc_status')");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Add New AdHoc</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Add New AdHoc</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">    
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                
                <div class="form-group">
                    <label>Employee Name</label>
                    <select id="" class="form-control" name="adhoc_emp_name">
                        <option>Select Employee</option>
                        <?php
                        while($select_all_employee_result = mysqli_fetch_assoc($select_all_employee_sql)){
                            echo '<option>';
                            echo $select_all_employee_result["emp_full_name"];
                            echo '</option>';
                        }
                            
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">AdHoc Type</label>
                    <select class="form-control" name="adhoc_type">
                        <option>Select AdHoc Type</option>
                        <option>Paid Leave</option>
                        <option>Loan</option>
                        <option>Claims</option>
                        <option>Advance Deduct</option>
                        <option>Allowance</option>
                        <option>Wages</option>
                        <option>Commission</option>
                        <option>Advance Paid</option>
                        <option>Unpaid Leave</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Amount</label>
                    <input type="number" class="form-control" name="adhoc_amt">
                </div>                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(document).ready( function() {
    $('#example').dataTable( {
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );
} );    
    
</script>
  
</body>

</html>