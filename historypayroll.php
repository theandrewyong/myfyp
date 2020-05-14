<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

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
                                    echo '<tr>';
                                    echo '<td>' . date("F", mktime(0, 0, 0, $uma, 10)) . '</td>';
                                    echo '<td>' . $uya . '</td>';
                                    echo '<td>' . '<a href="historydetails.php?month=' . $uma . '&year=' . $uya . '">View Details</a>' . '</td>';
                                    echo '<td>' . '<a href="deletehistory.php?month=' . $uma . '&year=' . $uya . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>' . '</td>';
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
</script>
</body>
</html>