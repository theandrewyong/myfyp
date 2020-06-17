<?php
	session_start();
	include "conn.php";
	if(empty($_SESSION["username"])){
		header("location:index.php");
	}
	//Get month and year from previous page
	$username = $_SESSION["username"];
	$get_month = $_GET["month"];
	$get_year = $_GET["year"];
?>
<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - AdHoc History</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4"><a href="historypayroll.php" class="btn btn-primary">Back</a> AdHoc History Details</h1>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
									<tr>
										<th>ID</th>
										<th>Employee Name</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
                                </thead>
								<tbody>
									<?php
									//Select data from employee_info table and process_adhoc table
									$select_all_sql = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_process_month = '$get_month' AND process_adhoc_process_year = '$get_year'");
										while($data = mysqli_fetch_assoc($select_all_sql)){
											$process_id = $data["process_adhoc_id"];
											echo "<tr>";
											echo "<td>" . $data["emp_display_id"] . "</td>";
											echo "<td>" . $data["emp_full_name"] . "</td>";
											echo "<td>" . '<a class="btn btn-primary" href="editadhochistory.php?pid=' . $process_id . '&month=' . $get_month . '&year=' . $get_year . '">Edit History</a>' . "</td>";
											echo "<td>" . '<a class="btn btn-danger" href="deleteEmployeeAhHistory.php?pid=' . $process_id . '&month=' . $get_month . '&year=' . $get_year . '" onclick="return confirm(\'Confirm Delete?\')">Delete History</a>' . "</td>";
											echo "</tr>";
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