<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
error_reporting(0);

//for process payroll history
$select_all_processed_payroll = mysqli_query($conn, "SELECT * FROM process_payroll");
$data_exists = FALSE;
$unique_month_array = "";
$unique_year_array = "";

while($select_result = mysqli_fetch_assoc($select_all_processed_payroll)){
    $data_exists = TRUE;
    $specific_month = $select_result["process_payroll_process_month"];
    $specific_year = $select_result["process_payroll_process_year"];
    $specific_month_array[] = $specific_month;
    $specific_year_array[] = $specific_year;
    $unique_month_array = array_unique($specific_month_array);
    $unique_year_array = array_unique($specific_year_array);
}

//for process adhoc history
$select_all_processed_adhoc = mysqli_query($conn, "SELECT * FROM process_adhoc");
$adhoc_data_exists = FALSE;
$adhoc_unique_month_array = "";
$adhoc_unique_year_array = "";


while($select_adhoc_result = mysqli_fetch_assoc($select_all_processed_adhoc)){
    $adhoc_data_exists = TRUE;
    $specific_adhoc_month = $select_adhoc_result["process_adhoc_process_month"];
    $specific_adhoc_year = $select_adhoc_result["process_adhoc_process_year"];
    $specific_adhoc_month_array[] = $specific_adhoc_month;
    $specific_adhoc_year_array[] = $specific_adhoc_year;
    $adhoc_unique_month_array = array_unique($specific_adhoc_month_array);
    $adhoc_unique_year_array = array_unique($specific_adhoc_year_array);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Payroll History</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Payroll History</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Month-End History</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">AdHoc History</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-1 py-3 show active">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Details</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($data_exists){
                                    foreach($unique_month_array as $uma){
                                        foreach($unique_year_array as $uya){
                                            $double_check_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_month = '$uma' AND process_payroll_process_year = '$uya'");
                                            if(mysqli_num_rows($double_check_sql) != 0){
                                                echo '<tr>';
                                                echo '<td>' . date("F", mktime(0, 0, 0, $uma, 10)) . '</td>';
                                                echo '<td>' . $uya . '</td>';
                                                echo '<td>' . '<a class="btn btn-primary" href="historydetails.php?month=' . $uma . '&year=' . $uya . '">View History Details</a>' . '</td>';
                                                echo '<td>' . '<a class="btn btn-danger" href="deleteGeneralMeHistory.php?month=' . $uma . '&year=' . $uya . '" onclick="return confirm(\'Confirm Delete?\');">Delete History</a>' . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Details</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                
                                
                                    foreach($adhoc_unique_month_array as $auma){
                                        foreach($adhoc_unique_year_array as $auya){
                                            $double_check_sql = mysqli_query($conn, "SELECT * FROM process_adhoc WHERE process_adhoc_process_month = '$auma' AND process_adhoc_process_year = '$auya'");
                                            if(mysqli_num_rows($double_check_sql) != 0){
                                                echo '<tr>';
                                                echo '<td>' . date("F", mktime(0, 0, 0, $auma, 10)) . '</td>';
                                                echo '<td>' . $auya . '</td>';
                                                echo '<td>' . '<a class="btn btn-primary" href="historyadhoc.php?month=' . $auma . '&year=' . $auya . '">View History Details</a>' . '</td>';
                                                echo '<td>' . '<a class="btn btn-danger" href="deleteGeneralAhHistory.php?month=' . $auma . '&year=' . $auya . '" onclick="return confirm(\'Confirm Delete?\');">Delete History</a>' . '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                
                                ?>
                                </tbody>
                            </table>
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

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-range-pre": function ( a ) {
    var monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    return monthArr.indexOf(a);	
    },
    "date-range-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
    "date-range-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );

$(document).ready( function() {
    $('#example').dataTable( {
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records",
        },
        columnDefs: [
        { type: 'date-range', targets: 0 }
        ],
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );
} );   
    
$(document).ready( function() {
    $('#example1').dataTable( {
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records",
        },
        columnDefs: [
        { type: 'date-range', targets: 0 }
        ],
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );
} );     
</script>
</body>
</html>