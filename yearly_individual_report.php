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

<title>Payroll Software - Yealry Individual Report</title>

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
<h1 class="mt-4">Yealy Individual Report</h1>
<hr>
    <div class="row">
        <div class="col-9">
            <div class="p-5 bg-white rounded shadow mb-5">
            <form action="yearly_individual_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                <div class="col-12">
                <div class="form-group">
                    <label for="pwd">Year</label>
                    <input type="text" class="form-control" id="year" name="year" value="<?php echo date("Y"); ?>">
                </div>
                </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>            
            </div>        
        </div>
        <div class="col-3">
            <div class="p-5 bg-white rounded shadow mb-5">
            <?php
                $year = "";
                $view_table = FALSE;
                if(isset($_POST["submit"])){
                    $year = $_POST["year"]; 
                
				
				$count_employee_by_year_sql = mysqli_query($conn, "SELECT * FROM process_payroll WHERE process_payroll_process_year = '$year'");
				while($result = mysqli_fetch_assoc($count_employee_by_year_sql)){

				//make it unique
				$employee_id_array[] = $result["emp_id"];
				$unique_employee = array_unique($employee_id_array);
				}
				
				//validation
				$validate = mysqli_query($conn, "SELECT * FROM process_payroll");
					while($validation = mysqli_fetch_assoc($validate)){
						if ($validation["process_payroll_process_year"]==$year){
							$view_table = TRUE;
						}
					}

				}
            ?>
				
            <a target="_blank" href="yearly_individual_report_pdf.php?year=<?php echo $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a>
            </div>
        </div>
    </div>

    <div class="p-5 bg-white rounded shadow mb-5">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Employee Display ID</th>
                        <th>Employee Name</th>
                        <th>Yearly Individual Report</th>
                    </tr>
                </thead>
            <tbody>
            <?php
				//hide errors
				//error_reporting(0);
				//ini_set('display_errors', 0);
				
				$id = "";
                if($view_table){
                    foreach($unique_employee as $ua){
						$select_sql = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_year = '$year' AND process_payroll.emp_id = '$ua'"); 
						$data = mysqli_fetch_assoc($select_sql); 
						
						
						$yid_display = $data["emp_display_id"];
                        $yid_name = $data["emp_full_name"];
                        $id = $data["emp_id"];
                            
                        echo '<tr>';
                        echo '<td>' . $yid_display . '</td>';
                        echo '<td>' . $yid_name . '</td>';
                        ?>
                
                        <td><a target="_blank" href="individual_report_details.php?year=<?php echo $year . '&id=' . $id;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Details</a></td>
                
                    <?php
                        echo '</tr>';                       
                        
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
