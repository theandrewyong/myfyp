<?php
session_start();
include "conn.php";
    if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

$get_adhoc_id = $_GET["adhoc_id"];




if(isset($_POST["submit"])){
    //$get_edited_adhoc_emp_name = $_POST["adhoc_emp_name"];
    $get_edited_adhoc_type = $_POST["edited_adhoc_type"];
    $get_edited_adhoc_amt = $_POST["edited_adhoc_amt"];
    
    mysqli_query($conn, "UPDATE adhoc_pending SET adhoc_type = '$get_edited_adhoc_type', adhoc_amt = '$get_edited_adhoc_amt'");
}

$select_all_employee_sql = mysqli_query($conn, "SELECT * FROM adhoc_pending WHERE adhoc_id = '$get_adhoc_id'");
$specific_result = mysqli_fetch_assoc($select_all_employee_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Edit Pending AdHoc</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Pending AdHoc</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">    
            <form action="editadhocpending.php?adhoc_id=<?php echo $get_adhoc_id; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                
                
                <div class="form-group">
                    <label>Employee Name</label>
                    <select id="" class="form-control" name="adhoc_emp_name" disabled>

                        <?php
                            echo '<option>';
                            echo $specific_result["emp_full_name"];
                            echo '</option>';
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">AdHoc Type</label>
                    <select class="form-control" name="edited_adhoc_type">
                        <option <?php if($specific_result["adhoc_type"] == "Select AdHoc Type"){echo "selected";} ?>>Select AdHoc Type</option>
                        <option <?php if($specific_result["adhoc_type"] == "Paid Leave"){echo "selected";} ?>>Paid Leave</option>
                        <option <?php if($specific_result["adhoc_type"] == "Loan"){echo "selected";} ?>>Loan</option>
                        <option <?php if($specific_result["adhoc_type"] == "Claims"){echo "selected";} ?>>Claims</option>
                        <option <?php if($specific_result["adhoc_type"] == "Advance Deduct"){echo "selected";} ?>>Advance Deduct</option>
                        <option <?php if($specific_result["adhoc_type"] == "Allowance"){echo "selected";} ?>>Allowance</option>
                        <option <?php if($specific_result["adhoc_type"] == "Wages"){echo "selected";} ?>>Wages</option>
                        <option <?php if($specific_result["adhoc_type"] == "Commission"){echo "selected";} ?>>Commission</option>
                        <option <?php if($specific_result["adhoc_type"] == "Advance Paid"){echo "selected";} ?>>Advance Paid</option>
                        <option <?php if($specific_result["adhoc_type"] == "Unpaid Leave"){echo "selected";} ?>>Unpaid Leave</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Amount</label>
                    <input type="number" class="form-control" name="edited_adhoc_amt" value="<?php echo $specific_result["adhoc_amt"]; ?>">
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