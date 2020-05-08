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

<title>Payroll Software - Payroll History</title>

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
<h1 class="mt-4">Payroll History</h1>
<!-- dashboard conten here -->
<hr>
    <!-- show payroll based on month -->
    <?php
    $select_all_processed_payroll = mysqli_query($conn, "SELECT * FROM process_payroll");
    $data_exists = FALSE;
    $unique_month_array = "";
    $unique_year_array = "";
    while($select_result = mysqli_fetch_assoc($select_all_processed_payroll)){
        // find if date exists
        $data_exists = TRUE;
        $specific_month = $select_result["process_payroll_process_month"];
        $specific_year = $select_result["process_payroll_process_year"];
        
        $specific_month_array[] = $specific_month;
        $specific_year_array[] = $specific_year;
        
           $unique_month_array = array_unique($specific_month_array);
   $unique_year_array = array_unique($specific_year_array);
    }
    //get value for each month only once

    

    ?>
    <div class="p-5 bg-white rounded shadow mb-5">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Details</th>
                    </tr>
                </thead>
            <tbody>
            <?php
            if($data_exists){
                foreach($unique_month_array as $uma){
                    foreach($unique_year_array as $uya){
                        echo '<tr>';
                        echo '<td>' . $uma . '</td>';
                        echo '<td>' . $uya . '</td>';
                        echo '<td>' . '<a href="historydetails.php?month=' . $uma . '&year=' . $uya . '">View Details</a>' . '</td>';
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
<!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- footer here -->
<?php include "footer.php"; ?> 
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- Menu Toggle Script -->
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
    "sDom": '<"mot"f><"xot"l>rt<"bottom"pi><"clear">'
  } );
} );    
</script>

</body>

</html>
