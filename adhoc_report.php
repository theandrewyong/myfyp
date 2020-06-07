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

<title>Payroll Software - Adhoc Report</title>

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
<h1 class="mt-4"><a href="reports.php" class="btn btn-primary">Back</a> Adhoc Report</h1>
<hr>
            <?php
                $month = (int)date("m");
                $year = date("Y");
                $view_table = FALSE;
                if(isset($_POST["submit"])){
 
                    $month = $_POST["month"];
                    $year = $_POST["year"]; 
                    
                    $select_sql = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_process_month = '$month' AND process_adhoc_process_year = '$year'"); 
					
					//validate
					$validate = mysqli_query($conn, "SELECT * FROM process_adhoc");
					while($validation = mysqli_fetch_assoc($validate)){
						if ($validation["process_adhoc_process_month"]==$month && $validation["process_adhoc_process_year"]==$year){
							$view_table = TRUE;
						}
					}
                }
                
            ?>    
    <div class="row">
        <div class="col-md-6">
            <div class="p-3 bg-white rounded shadow mb-5">
            <form action="adhoc_report.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label for="month">Month</label>
                    <input type="number" class="form-control" id="month" name="month" value="<?php echo $month ?>">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" class="form-control" id="year" name="year" value="<?php echo $year ?>">
                </div>
                </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>            
            </div>        
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-white rounded shadow mb-5">

            <p><a target="_blank" href="adhoc_report_pdf.php?month=<?php echo $month . '&year=' . $year;?>" class="btn btn-info <?php if(!$view_table){echo 'disabled';} ?>">Download as PDF</a></p>
            </div>
        </div>
    </div>

    <div class="p-3 bg-white rounded shadow mb-5">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Wages</th>
                        <th>Commission</th>
                        <th>Allowance</th>
                        <th>Claims</th>
                        <th>Bonus</th>
                        <th>Others</th>
                        <th>Unpaid Leave</th>
						<th>EPF</th>
						<th>Adhoc Amount</th>
                    </tr>
                </thead>
            <tbody>
            <?php
				$total_adhoc_wages = 0;
				$total_adhoc_commission = 0;
				$total_adhoc_allowance = 0;
				$total_adhoc_claims = 0;
				$total_adhoc_bonus = 0;
				$total_adhoc_others = 0;
				$total_adhoc_unpaid_leave = 0;
                $total_adhoc_epf = 0;
                $total_adhoc_amount = 0;
				
                $format_total_epf_employee_deduction = 0;
				$format_total_adhoc_epf = 0;
				$format_total_adhoc_amount = 0;
				
                
                if($view_table){
                    while($select_result = mysqli_fetch_assoc($select_sql)){
                        $adhoc_name = $select_result["emp_full_name"];
                        $adhoc_wages = $select_result["process_adhoc_wage"];
                        $adhoc_commission = $select_result["process_adhoc_commission"];
                        $adhoc_allowance = $select_result["process_adhoc_allowance"];
                        $adhoc_claims = $select_result["process_adhoc_claims"];
                        $adhoc_bonus = $select_result["process_adhoc_bonus"];
                        $adhoc_others = $select_result["process_adhoc_others"];
                        $adhoc_epf = $select_result["epf_employee_deduction"];
                        $adhoc_unpaid_leave = $select_result["process_adhoc_unpaid_leave"];
						$adhoc_amount = $select_result["adhoc_amt"];
                        
                            
                        echo '<tr>';
                        echo '<td>' . $adhoc_name . '</td>';
						
						if ($adhoc_wages == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_commission == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_allowance == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_claims == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_bonus == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_others == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
						if ($adhoc_unpaid_leave == 1) {
							echo '<td>' . '&#10004;' . '</td>';
						}
						else {
							echo '<td>' . '&#10006;' . '</td>';
						}
						
                        echo '<td>' . $adhoc_epf . '</td>';
                        echo '<td>' . $adhoc_amount . '</td>';
                        echo '</tr>'; 
                        
                        //count total
                        $total_adhoc_wages = $total_adhoc_wages + $adhoc_wages;
						
                        $total_adhoc_commission = $total_adhoc_commission + $adhoc_commission;
						
                        $total_adhoc_allowance = $total_adhoc_allowance + $adhoc_allowance;
						
                        $total_adhoc_claims = $total_adhoc_claims + $adhoc_claims;
						
                        $total_adhoc_bonus = $total_adhoc_bonus + $adhoc_bonus;
						
                        $total_adhoc_others = $total_adhoc_others + $adhoc_others;
						
                        $total_adhoc_epf = $total_adhoc_epf + $adhoc_epf;
						$format_total_adhoc_epf  = number_format("$total_adhoc_epf",2);
						
                        $total_adhoc_unpaid_leave = $total_adhoc_unpaid_leave + $adhoc_unpaid_leave;                   
						
						$total_adhoc_amount = $total_adhoc_amount + $adhoc_amount;
						$format_total_adhoc_amount  = number_format("$total_adhoc_amount",2);
						
                    }                    
                }
            ?> 
                <tr>
                    <td><b>Total</b></td>
                    <td><b><?php echo number_format($total_adhoc_wages,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_commission,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_allowance,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_claims,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_bonus,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_others,2);?></b></td>
                    <td><b><?php echo number_format($total_adhoc_unpaid_leave,2);?></b></td>
					<td><b><?php echo number_format($format_total_adhoc_epf,2);?></b></td>
					<td><b><?php echo number_format($format_total_adhoc_amount,2);?></b></td>
                </tr>                
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
