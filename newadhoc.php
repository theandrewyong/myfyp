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
<title>Payroll Software - New AdHoc</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">New AdHoc</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="process_adhoc-tab" data-toggle="tab" href="#process_adhoc" role="tab" aria-controls="process_adhoc" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Process AdHoc</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="pending_adhoc-tab" data-toggle="tab" href="#pending_adhoc" role="tab" aria-controls="pending_adhoc" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Pending AdHoc List</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="process_adhoc" role="tabpanel" aria-labelledby="process_adhoc-tab" class="tab-pane fade px-1 py-3 show active">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow mb-5"><!-- Start of rounded shadow box -->
                                <p><b>Process Checked AdHoc</b></p>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <label for="">Month</label>
                                        <input type="number" name="process_payroll_process_month" class="form-control">
                                    </div>                
                                    <div class="col-md-6 col-12">
                                        <label for="">Year</label>
                                        <input type="text" name="process_payroll_process_year" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" class="btn btn-success" name="check">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Process Date</label>
                                        <input type="date" class="form-control" name="process_payroll_process_date">
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
                            </div><!-- End of rounded shadow box -->
                        </div><!-- End of 1st Row, 1st Column -->
                        <div class="col-md-6 col-12">
                            <div class="p-3 bg-white rounded shadow mb-5">
                                <p><b>Employee</b></p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Employee Name</th>
                                                        <th>To process</th>
                                                    </tr>
                                                </thead>                                
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                        </div>                        
                    </div>
                        
                        
                    </div>
                    <div id="pending_adhoc" role="tabpanel" aria-labelledby="pending_adhoc-tab" class="tab-pane fade px-1 py-3">
                        <p><a href="addpendingadhoc.php" class="btn btn-success">Add Pending AdHoc</a></p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>AdHoc Type</th>
                                                <th>Description</th>
                                                <th>Reference</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
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
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );   
} );   
    
$(document).ready( function() {
    $('#example1').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );   
} );      
</script>
<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>