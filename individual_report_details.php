<?php
    session_start();
    include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];
	$get_year = $_GET["year"];
	$get_emp_id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Yealy Individual Report Details</title>
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
		<h1 class="mt-4">Yealy Individual Report Details</h1>
		<hr>
		<?php 
			//Select data from employee_info table and process_payroll table
			$get_sql_1 = mysqli_query($conn, "SELECT process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info ON process_payroll.emp_id = employee_info.emp_id WHERE process_payroll_process_year = '$get_year' AND process_payroll.emp_id = '$get_emp_id'");  

			//Select data from employee_info table and process_adhoc table
			$get_sql_2 = mysqli_query($conn, "SELECT process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info ON process_adhoc.emp_id = employee_info.emp_id WHERE process_adhoc_process_year = '$get_year' AND process_adhoc.emp_id = '$get_emp_id'"); 

			if(mysqli_num_rows($get_sql_1)>0) {
				$data = mysqli_fetch_assoc($get_sql_1); 
			}

			else {
				$data = mysqli_fetch_assoc($get_sql_2); 
			}
		?>
			
		<div class="row">
			<div class="col-12">
				<div class="p-5 bg-white rounded shadow mb-5">
					<div class="row">
						<div class="col-6">
						<div class="form-group">
						<label for="emp_name">Employee Name</label>
							<input type="text" class="form-control" id="emp_name" name="emp_name" value="<?php echo $data["emp_full_name"]; ?>" disabled>
						</div>
						</div>

						<div class="col-6">
						<div class="form-group">
						<label for="display_year">Display Year</label>
							<input type="text" class="form-control" id="display_year" name="display_year" value="<?php echo $get_year;?>" disabled>
						</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
						<div class="form-group">
						<label for="epf_number">EPF Number</label>
							<input type="text" class="form-control" id="epf_number" name="epf_number" value="<?php echo $data["emp_epf"]; ?>" disabled>
						</div>
						</div>

						<div class="col-6">
						<div class="form-group">
						<label for="socso_number">SOCSO Number</label>
							<input type="text" class="form-control" id="socso_number" name="socso_number" value="<?php echo $data["emp_socso"]; ?>" disabled>
						</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
						<div class="form-group">
						<label for="eis_eligible">EIS Eligible</label>
							<input type="text" class="form-control" id="eis_eligible" name="eis_eligible" value="<?php echo $data["emp_eis_type"]; ?>" disabled>
						</div>
						</div>

						<div class="col-6">
						<div class="form-group">
						<label for="socso_type">SOCSO Category</label>
							<input type="text" class="form-control" id="socso_type" name="socso_type" value="<?php echo $data["emp_socso_type"]; ?>" disabled>
						</div>
						</div>
					</div>

				</div>        
			</div>
		</div>

		<div class="p-5 bg-white rounded shadow mb-5">
			<div class="table-responsive">
				<table id="example" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>January</th>
							<th>February</th>
							<th>March</th>
							<th>April</th>
							<th>May</th>
							<th>June</th>
							<th>July</th>
							<th>August</th>
							<th>September</th>
							<th>October</th>
							<th>November</th>
							<th>December</th>
							<th>Total</th>
						</tr>
					</thead>
				<tbody>
				<?php
					$countJan = 0;
					$countFeb = 0;
					$countMar = 0;
					$countApr = 0;
					$countMay = 0;
					$countJun = 0;
					$countJul = 0;
					$countAug = 0;
					$countSep = 0;
					$countOct = 0;
					$countNov = 0;
					$countDec = 0;

					//wage
					echo '<tr>';
					echo '<td>' . 'Wages' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countJanWage = $countJan + $data["process_payroll_wage"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countFebWage = $countFeb + $data["process_payroll_wage"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_wage"] . '</td>'; 
							$countMarWage = $countMar + $data["process_payroll_wage"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countAprWage = $countApr + $data["process_payroll_wage"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countMayWage = $countMay + $data["process_payroll_wage"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countJunWage = $countJun + $data["process_payroll_wage"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countJulWage = $countJul + $data["process_payroll_wage"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countAugWage = $countAug + $data["process_payroll_wage"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countSepWage = $countSep + $data["process_payroll_wage"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countOctWage = $countOct + $data["process_payroll_wage"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countNovWage = $countNov + $data["process_payroll_wage"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_wage"] . '</td>';
							$countDecWage = $countDec + $data["process_payroll_wage"];
						}

					}


					$count_allWage = $countJanWage + $countFebWage + $countMarWage + $countAprWage + $countMayWage + $countJunWage + $countJulWage + $countAugWage + $countSepWage + $countOctWage + $countNovWage + $countDecWage;
					$format_count_allWage = number_format("$count_allWage",2);

					echo '<td>' . $format_count_allWage . '</td>';
					echo '</tr>';

					//overtime
					echo '<tr>';
					echo '<td>' . 'Overtime' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countJanOvertime = $countJan + $data["process_payroll_overtime"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countFebOvertime = $countFeb + $data["process_payroll_overtime"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>'; 
							$countMarOvertime = $countMar + $data["process_payroll_overtime"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countAprOvertime = $countApr + $data["process_payroll_overtime"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countMayOvertime = $countMay + $data["process_payroll_overtime"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countJunOvertime = $countJun + $data["process_payroll_overtime"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countJulOvertime = $countJul + $data["process_payroll_overtime"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countAugOvertime = $countAug + $data["process_payroll_overtime"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countSepOvertime = $countSep + $data["process_payroll_overtime"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countOctOvertime = $countOct + $data["process_payroll_overtime"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countNovOvertime = $countNov + $data["process_payroll_overtime"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_overtime"] . '</td>';
							$countDecOvertime = $countDec + $data["process_payroll_overtime"];
						}

					}


					$count_allOvertime = $countJanOvertime + $countFebOvertime + $countMarOvertime + $countAprOvertime + $countMayOvertime + $countJunOvertime + $countJulOvertime + $countAugOvertime + $countSepOvertime + $countOctOvertime + $countNovOvertime + $countDecOvertime;
					$format_count_allOvertime = number_format("$count_allOvertime",2);

					echo '<td>' . $format_count_allOvertime . '</td>';
					echo '</tr>';

					//commission
					echo '<tr>';
					echo '<td>' . 'Commission' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countJanCommission= $countJan + $data["process_payroll_commission"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countFebCommission= $countFeb + $data["process_payroll_commission"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_commission"] . '</td>'; 
							$countMarCommission= $countMar + $data["process_payroll_commission"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countAprCommission= $countApr + $data["process_payroll_commission"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countMayCommission= $countMay + $data["process_payroll_commission"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countJunCommission= $countJun + $data["process_payroll_commission"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countJulCommission= $countJul + $data["process_payroll_commission"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countAugCommission= $countAug + $data["process_payroll_commission"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countSepCommission= $countSep + $data["process_payroll_commission"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countOctCommission= $countOct + $data["process_payroll_commission"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countNovCommission= $countNov + $data["process_payroll_commission"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_commission"] . '</td>';
							$countDecCommission= $countDec + $data["process_payroll_commission"];
						}

					}


					$count_allCommission= $countJanCommission+ $countFebCommission+ $countMarCommission+ $countAprCommission+ $countMayCommission+ $countJunCommission+ $countJulCommission+ $countAugCommission+ $countSepCommission+ $countOctCommission+ $countNovCommission+ $countDecCommission;
					$format_count_allCommission= number_format("$count_allCommission",2);

					echo '<td>' . $format_count_allCommission. '</td>';
					echo '</tr>';

					//Allowance
					echo '<tr>';
					echo '<td>' . 'Allowance' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countJanAllowance = $countJan + $data["process_payroll_allowance"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countFebAllowance = $countFeb + $data["process_payroll_allowance"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>'; 
							$countMarAllowance = $countMar + $data["process_payroll_allowance"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countAprAllowance = $countApr + $data["process_payroll_allowance"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countMayAllowance = $countMay + $data["process_payroll_allowance"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countJunAllowance = $countJun + $data["process_payroll_allowance"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countJulAllowance = $countJul + $data["process_payroll_allowance"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countAugAllowance = $countAug + $data["process_payroll_allowance"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countSepAllowance = $countSep + $data["process_payroll_allowance"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countOctAllowance = $countOct + $data["process_payroll_allowance"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countNovAllowance = $countNov + $data["process_payroll_allowance"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_allowance"] . '</td>';
							$countDecAllowance = $countDec + $data["process_payroll_allowance"];
						}

					}


					$count_allAllowance = $countJanAllowance + $countFebAllowance + $countMarAllowance + $countAprAllowance + $countMayAllowance + $countJunAllowance + $countJulAllowance + $countAugAllowance + $countSepAllowance + $countOctAllowance + $countNovAllowance + $countDecAllowance;
					$format_count_allAllowance = number_format("$count_allAllowance",2);

					echo '<td>' . $format_count_allAllowance . '</td>';
					echo '</tr>';

					//Claims
					echo '<tr>';
					echo '<td>' . 'Claims' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countJanClaims = $countJan + $data["process_payroll_claims"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countFebClaims = $countFeb + $data["process_payroll_claims"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_claims"] . '</td>'; 
							$countMarClaims = $countMar + $data["process_payroll_claims"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countAprClaims = $countApr + $data["process_payroll_claims"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countMayClaims = $countMay + $data["process_payroll_claims"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countJunClaims = $countJun + $data["process_payroll_claims"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countJulClaims = $countJul + $data["process_payroll_claims"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countAugClaims = $countAug + $data["process_payroll_claims"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countSepClaims = $countSep + $data["process_payroll_claims"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countOctClaims = $countOct + $data["process_payroll_claims"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countNovClaims = $countNov + $data["process_payroll_claims"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_claims"] . '</td>';
							$countDecClaims = $countDec + $data["process_payroll_claims"];
						}

					}


					$count_allClaims = $countJanClaims + $countFebClaims + $countMarClaims + $countAprClaims + $countMayClaims + $countJunClaims + $countJulClaims + $countAugClaims + $countSepClaims + $countOctClaims + $countNovClaims + $countDecClaims;
					$format_count_allClaims = number_format("$count_allClaims",2);

					echo '<td>' . $format_count_allClaims . '</td>';
					echo '</tr>';

					//Director Fees
					echo '<tr>';
					echo '<td>' . 'Director Fees' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countJanDirectorFees = $countJan + $data["process_payroll_director_fees"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countFebDirectorFees = $countFeb + $data["process_payroll_director_fees"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>'; 
							$countMarDirectorFees = $countMar + $data["process_payroll_director_fees"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countAprDirectorFees = $countApr + $data["process_payroll_director_fees"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countMayDirectorFees = $countMay + $data["process_payroll_director_fees"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countJunDirectorFees = $countJun + $data["process_payroll_director_fees"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countJulDirectorFees = $countJul + $data["process_payroll_director_fees"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countAugDirectorFees = $countAug + $data["process_payroll_director_fees"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countSepDirectorFees = $countSep + $data["process_payroll_director_fees"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countOctDirectorFees = $countOct + $data["process_payroll_director_fees"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countNovDirectorFees = $countNov + $data["process_payroll_director_fees"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_director_fees"] . '</td>';
							$countDecDirectorFees = $countDec + $data["process_payroll_director_fees"];
						}

					}


					$count_allDirectorFees = $countJanDirectorFees + $countFebDirectorFees + $countMarDirectorFees + $countAprDirectorFees + $countMayDirectorFees + $countJunDirectorFees + $countJulDirectorFees + $countAugDirectorFees + $countSepDirectorFees + $countOctDirectorFees + $countNovDirectorFees + $countDecDirectorFees;
					$format_count_allDirectorFees = number_format("$count_allDirectorFees",2);

					echo '<td>' . $format_count_allDirectorFees . '</td>';
					echo '</tr>';

					//Advance Paid
					echo '<tr>';
					echo '<td>' . 'Advance Paid' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countJanAdvancePaid = $countJan + $data["process_payroll_advance_paid"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countFebAdvancePaid = $countFeb + $data["process_payroll_advance_paid"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>'; 
							$countMarAdvancePaid = $countMar + $data["process_payroll_advance_paid"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countAprAdvancePaid = $countApr + $data["process_payroll_advance_paid"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countMayAdvancePaid = $countMay + $data["process_payroll_advance_paid"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countJunAdvancePaid = $countJun + $data["process_payroll_advance_paid"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countJulAdvancePaid = $countJul + $data["process_payroll_advance_paid"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countAugAdvancePaid = $countAug + $data["process_payroll_advance_paid"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countSepAdvancePaid = $countSep + $data["process_payroll_advance_paid"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countOctAdvancePaid = $countOct + $data["process_payroll_advance_paid"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countNovAdvancePaid = $countNov + $data["process_payroll_advance_paid"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_advance_paid"] . '</td>';
							$countDecAdvancePaid = $countDec + $data["process_payroll_advance_paid"];
						}

					}


					$count_allAdvancePaid = $countJanAdvancePaid + $countFebAdvancePaid + $countMarAdvancePaid + $countAprAdvancePaid + $countMayAdvancePaid + $countJunAdvancePaid + $countJulAdvancePaid + $countAugAdvancePaid + $countSepAdvancePaid + $countOctAdvancePaid + $countNovAdvancePaid + $countDecAdvancePaid;
					$format_count_allAdvancePaid = number_format("$count_allAdvancePaid",2);

					echo '<td>' . $format_count_allAdvancePaid . '</td>';
					echo '</tr>';

					//Bonus
					echo '<tr>';
					echo '<td>' . 'Bonus' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countJanBonus = $countJan + $data["process_payroll_bonus"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countFebBonus = $countFeb + $data["process_payroll_bonus"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>'; 
							$countMarBonus = $countMar + $data["process_payroll_bonus"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countAprBonus = $countApr + $data["process_payroll_bonus"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countMayBonus = $countMay + $data["process_payroll_bonus"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countJunBonus = $countJun + $data["process_payroll_bonus"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countJulBonus = $countJul + $data["process_payroll_bonus"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countAugBonus = $countAug + $data["process_payroll_bonus"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countSepBonus = $countSep + $data["process_payroll_bonus"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countOctBonus = $countOct + $data["process_payroll_bonus"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countNovBonus = $countNov + $data["process_payroll_bonus"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_bonus"] . '</td>';
							$countDecBonus = $countDec + $data["process_payroll_bonus"];
						}

					}


					$count_allBonus = $countJanBonus + $countFebBonus + $countMarBonus + $countAprBonus + $countMayBonus + $countJunBonus + $countJulBonus + $countAugBonus + $countSepBonus + $countOctBonus + $countNovBonus + $countDecBonus;
					$format_count_allBonus = number_format("$count_allBonus",2);

					echo '<td>' . $format_count_allBonus . '</td>';
					echo '</tr>';

					//Others
					echo '<tr>';
					echo '<td>' . 'Others' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countJanOthers = $countJan + $data["process_payroll_others"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countFebOthers = $countFeb + $data["process_payroll_others"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_others"] . '</td>'; 
							$countMarOthers = $countMar + $data["process_payroll_others"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countAprOthers = $countApr + $data["process_payroll_others"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countMayOthers = $countMay + $data["process_payroll_others"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countJunOthers = $countJun + $data["process_payroll_others"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countJulOthers = $countJul + $data["process_payroll_others"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countAugOthers = $countAug + $data["process_payroll_others"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countSepOthers = $countSep + $data["process_payroll_others"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countOctOthers = $countOct + $data["process_payroll_others"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countNovOthers = $countNov + $data["process_payroll_others"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_others"] . '</td>';
							$countDecOthers = $countDec + $data["process_payroll_others"];
						}

					}


					$count_allOthers = $countJanOthers + $countFebOthers + $countMarOthers + $countAprOthers + $countMayOthers + $countJunOthers + $countJulOthers + $countAugOthers + $countSepOthers + $countOctOthers + $countNovOthers + $countDecOthers;
					$format_count_allOthers = number_format("$count_allOthers",2);

					echo '<td>' . $format_count_allOthers . '</td>';
					echo '</tr>';

					//Adhoc
					echo '<tr>';
					echo '<td>' . 'Adhoc Amount' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query2 = mysqli_query($conn, "select process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info WHERE process_adhoc_process_month = '$i' AND process_adhoc.emp_id = '$get_emp_id' AND process_adhoc_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query2);

						if($i == 1){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countJanAdhoc = $countJan + $data["adhoc_amt"];
						}
						if($i == 2){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countFebAdhoc = $countFeb + $data["adhoc_amt"];
						}
						if($i == 3){
							echo '<td>' . $data["adhoc_amt"] . '</td>'; 
							$countMarAdhoc = $countMar + $data["adhoc_amt"];
						}
						if($i == 4){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countAprAdhoc = $countApr + $data["adhoc_amt"];
						}
						if($i == 5){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countMayAdhoc = $countMay + $data["adhoc_amt"];
						}
						if($i == 6){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countJunAdhoc = $countJun + $data["adhoc_amt"];
						}
						if($i == 7){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countJulAdhoc = $countJul + $data["adhoc_amt"];
						}
						if($i == 8){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countAugAdhoc = $countAug + $data["adhoc_amt"];
						}
						if($i == 9){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countSepAdhoc = $countSep + $data["adhoc_amt"];
						}
						if($i == 10){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countOctAdhoc = $countOct + $data["adhoc_amt"];
						} 
						if($i == 11){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countNovAdhoc = $countNov + $data["adhoc_amt"];
						}
						if($i == 12){
							echo '<td>' . $data["adhoc_amt"] . '</td>';
							$countDecAdhoc = $countDec + $data["adhoc_amt"];
						}

					}


					$count_allAdhoc = $countJanAdhoc + $countFebAdhoc + $countMarAdhoc + $countAprAdhoc + $countMayAdhoc + $countJunAdhoc + $countJulAdhoc + $countAugAdhoc + $countSepAdhoc + $countOctAdhoc + $countNovAdhoc + $countDecAdhoc;
					$format_count_allAdhoc = number_format("$count_allAdhoc",2);

					echo '<td>' . $format_count_allAdhoc . '</td>';
					echo '</tr>';

					//total earnings by month formatted
						$total_earnings_jan = $countJanWage + $countJanOvertime + $countJanCommission + $countJanAllowance + $countJanClaims + $countJanDirectorFees + $countJanAdvancePaid + $countJanBonus + $countJanOthers + $countJanAdhoc;
						$format_total_earnings_jan = number_format("$total_earnings_jan",2);

						$total_earnings_feb = $countFebWage + $countFebOvertime + $countFebCommission + $countFebAllowance + $countFebClaims + $countFebDirectorFees + $countFebAdvancePaid + $countFebBonus + $countFebOthers + $countFebAdhoc;
						$format_total_earnings_feb = number_format("$total_earnings_feb",2);

						$total_earnings_mar = $countMarWage + $countMarOvertime + $countMarCommission + $countMarAllowance + $countMarClaims + $countMarDirectorFees + $countMarAdvancePaid + $countMarBonus + $countMarOthers + $countMarAdhoc;
						$format_total_earnings_mar = number_format("$total_earnings_mar",2);

						$total_earnings_apr = $countAprWage + $countAprOvertime + $countAprCommission + $countAprAllowance + $countAprClaims + $countAprDirectorFees + $countAprAdvancePaid + $countAprBonus + $countAprOthers + $countAprAdhoc;
						$format_total_earnings_apr = number_format("$total_earnings_apr",2);

						$total_earnings_may = $countMayWage + $countMayOvertime + $countMayCommission + $countMayAllowance + $countMayClaims + $countMayDirectorFees + $countMayAdvancePaid + $countMayBonus + $countMayOthers + $countMayAdhoc;
						$format_total_earnings_may = number_format("$total_earnings_may",2);

						$total_earnings_jun = $countJunWage + $countJunOvertime + $countJunCommission + $countJunAllowance + $countJunClaims + $countJunDirectorFees + $countJunAdvancePaid + $countJunBonus + $countJunOthers + $countJunAdhoc;
						$format_total_earnings_jun = number_format("$total_earnings_jun",2);

						$total_earnings_jul = $countJulWage + $countJulOvertime + $countJulCommission + $countJulAllowance + $countJulClaims + $countJulDirectorFees + $countJulAdvancePaid + $countJulBonus + $countJulOthers + $countJulAdhoc;
						$format_total_earnings_jul = number_format("$total_earnings_jul",2);

						$total_earnings_aug = $countAugWage + $countAugOvertime + $countAugCommission + $countAugAllowance + $countAugClaims + $countAugDirectorFees + $countAugAdvancePaid + $countAugBonus + $countAugOthers + $countAugAdhoc;
						$format_total_earnings_aug = number_format("$total_earnings_aug",2);

						$total_earnings_sep = $countSepWage + $countSepOvertime + $countSepCommission + $countSepAllowance + $countSepClaims + $countSepDirectorFees + $countSepAdvancePaid + $countSepBonus + $countSepOthers + $countSepAdhoc;
						$format_total_earnings_sep = number_format("$total_earnings_sep",2);

						$total_earnings_oct = $countOctWage + $countOctOvertime + $countOctCommission + $countOctAllowance + $countOctClaims + $countOctDirectorFees + $countOctAdvancePaid + $countOctBonus + $countOctOthers + $countOctAdhoc;
						$format_total_earnings_oct = number_format("$total_earnings_oct",2);

						$total_earnings_nov = $countNovWage + $countNovOvertime + $countNovCommission + $countNovAllowance + $countNovClaims + $countNovDirectorFees + $countNovAdvancePaid + $countNovBonus + $countNovOthers + $countNovAdhoc;
						$format_total_earnings_nov = number_format("$total_earnings_nov",2);

						$total_earnings_dec = $countDecWage + $countDecOvertime + $countDecCommission + $countDecAllowance + $countDecClaims + $countDecDirectorFees + $countDecAdvancePaid + $countDecBonus + $countDecOthers + $countDecAdhoc;
						$format_total_earnings_dec = number_format("$total_earnings_dec",2);

						echo '<th>' . 'Total Earnings' . '</th>';
						for($x=1;$x<=12;$x++){
							if($x == 1){
								echo '<th>' . $format_total_earnings_jan . '</th>';
							}
							if($x == 2){
								echo '<th>' . $format_total_earnings_feb . '</th>';
							}
							if($x == 3){
								echo '<th>' . $format_total_earnings_mar . '</th>';
							}
							if($x == 4){
								echo '<th>' . $format_total_earnings_apr . '</th>';
							}
							if($x == 5){
								echo '<th>' . $format_total_earnings_may . '</th>';
							}
							if($x == 6){
								echo '<th>' . $format_total_earnings_jun . '</th>';
							}
							if($x == 7){
								echo '<th>' . $format_total_earnings_jul . '</th>';
							}
							if($x == 8){
								echo '<th>' . $format_total_earnings_aug . '</th>';
							}
							if($x == 9){
								echo '<th>' . $format_total_earnings_sep . '</th>';
							}
							if($x == 10){
								echo '<th>' . $format_total_earnings_oct . '</th>';
							}
							if($x == 11){
								echo '<th>' . $format_total_earnings_nov . '</th>';
							}
							if($x == 12){
								echo '<th>' . $format_total_earnings_dec . '</th>';
							}                        

						}
						$total_earnings_total = $count_allWage + $count_allOvertime + $count_allCommission + $count_allAllowance + $count_allClaims + $count_allDirectorFees + $count_allAdvancePaid + $count_allBonus + $count_allOthers + $count_allAdhoc;
						$format_total_earnings_total = number_format("$total_earnings_total",2);
						echo '<th>' . $format_total_earnings_total . '</th>';

					//EPF
					echo '<tr>';
					echo '<td>' . 'Employee EPF' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJanEmpEPF = $countJan + $data["epf_employee_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countFebEmpEPF = $countFeb + $data["epf_employee_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>'; 
							$countMarEmpEPF = $countMar + $data["epf_employee_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countAprEmpEPF = $countApr + $data["epf_employee_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countMayEmpEPF = $countMay + $data["epf_employee_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJunEmpEPF = $countJun + $data["epf_employee_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJulEmpEPF = $countJul + $data["epf_employee_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countAugEmpEPF = $countAug + $data["epf_employee_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countSepEmpEPF = $countSep + $data["epf_employee_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countOctEmpEPF = $countOct + $data["epf_employee_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countNovEmpEPF = $countNov + $data["epf_employee_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countDecEmpEPF = $countDec + $data["epf_employee_deduction"];
						}

					}


					$count_allEmpEPF = $countJanEmpEPF + $countFebEmpEPF + $countMarEmpEPF + $countAprEmpEPF + $countMayEmpEPF + $countJunEmpEPF + $countJulEmpEPF + $countAugEmpEPF + $countSepEmpEPF + $countOctEmpEPF + $countNovEmpEPF + $countDecEmpEPF;
					$format_count_allEmpEPF = number_format("$count_allEmpEPF",2);

					echo '<td>' . $format_count_allEmpEPF . '</td>';
					echo '</tr>';

					//EPF Adhoc
					echo '<tr>';
					echo '<td>' . 'Employee EPF (Adhoc)' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query2 = mysqli_query($conn, "select process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info WHERE process_adhoc_process_month = '$i' AND process_adhoc.emp_id = '$get_emp_id' AND process_adhoc_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query2);

						if($i == 1){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJanEmpEPFAdhoc = $countJan + $data["epf_employee_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countFebEmpEPFAdhoc = $countFeb + $data["epf_employee_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>'; 
							$countMarEmpEPFAdhoc = $countMar + $data["epf_employee_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countAprEmpEPFAdhoc = $countApr + $data["epf_employee_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countMayEmpEPFAdhoc = $countMay + $data["epf_employee_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJunEmpEPFAdhoc = $countJun + $data["epf_employee_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countJulEmpEPFAdhoc = $countJul + $data["epf_employee_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countAugEmpEPFAdhoc = $countAug + $data["epf_employee_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countSepEmpEPFAdhoc = $countSep + $data["epf_employee_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countOctEmpEPFAdhoc = $countOct + $data["epf_employee_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countNovEmpEPFAdhoc = $countNov + $data["epf_employee_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["epf_employee_deduction"] . '</td>';
							$countDecEmpEPFAdhoc = $countDec + $data["epf_employee_deduction"];
						}

					}


					$count_allEmpEPFAdhoc = $countJanEmpEPFAdhoc + $countFebEmpEPFAdhoc + $countMarEmpEPFAdhoc + $countAprEmpEPFAdhoc + $countMayEmpEPFAdhoc + $countJunEmpEPFAdhoc + $countJulEmpEPFAdhoc + $countAugEmpEPFAdhoc + $countSepEmpEPFAdhoc + $countOctEmpEPFAdhoc + $countNovEmpEPFAdhoc + $countDecEmpEPFAdhoc;
					$format_count_allEmpEPFAdhoc = number_format("$count_allEmpEPFAdhoc",2);

					echo '<td>' . $format_count_allEmpEPFAdhoc . '</td>';
					echo '</tr>';

					//SOCSO
					echo '<tr>';
					echo '<td>' . 'Employee SOCSO' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countJanEmpSOCSO = $countJan + $data["socso_employee_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countFebEmpSOCSO = $countFeb + $data["socso_employee_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>'; 
							$countMarEmpSOCSO = $countMar + $data["socso_employee_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countAprEmpSOCSO = $countApr + $data["socso_employee_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countMayEmpSOCSO = $countMay + $data["socso_employee_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countJunEmpSOCSO = $countJun + $data["socso_employee_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countJulEmpSOCSO = $countJul + $data["socso_employee_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countAugEmpSOCSO = $countAug + $data["socso_employee_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countSepEmpSOCSO = $countSep + $data["socso_employee_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countOctEmpSOCSO = $countOct + $data["socso_employee_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countNovEmpSOCSO = $countNov + $data["socso_employee_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["socso_employee_deduction"] . '</td>';
							$countDecEmpSOCSO = $countDec + $data["socso_employee_deduction"];
						}

					}


					$count_allEmpSOCSO = $countJanEmpSOCSO + $countFebEmpSOCSO + $countMarEmpSOCSO + $countAprEmpSOCSO + $countMayEmpSOCSO + $countJunEmpSOCSO + $countJulEmpSOCSO + $countAugEmpSOCSO + $countSepEmpSOCSO + $countOctEmpSOCSO + $countNovEmpSOCSO + $countDecEmpSOCSO;
					$format_count_allEmpSOCSO = number_format("$count_allEmpSOCSO",2);

					echo '<td>' . $format_count_allEmpSOCSO . '</td>';
					echo '</tr>';

					//EIS
					echo '<tr>';
					echo '<td>' . 'Employee EIS' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countJanEmpEIS = $countJan + $data["eis_employee_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countFebEmpEIS = $countFeb + $data["eis_employee_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>'; 
							$countMarEmpEIS = $countMar + $data["eis_employee_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countAprEmpEIS = $countApr + $data["eis_employee_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countMayEmpEIS = $countMay + $data["eis_employee_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countJunEmpEIS = $countJun + $data["eis_employee_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countJulEmpEIS = $countJul + $data["eis_employee_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countAugEmpEIS = $countAug + $data["eis_employee_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countSepEmpEIS = $countSep + $data["eis_employee_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countOctEmpEIS = $countOct + $data["eis_employee_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countNovEmpEIS = $countNov + $data["eis_employee_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["eis_employee_deduction"] . '</td>';
							$countDecEmpEIS = $countDec + $data["eis_employee_deduction"];
						}

					}


					$count_allEmpEIS = $countJanEmpEIS + $countFebEmpEIS + $countMarEmpEIS + $countAprEmpEIS + $countMayEmpEIS + $countJunEmpEIS + $countJulEmpEIS + $countAugEmpEIS + $countSepEmpEIS + $countOctEmpEIS + $countNovEmpEIS + $countDecEmpEIS;
					$format_count_allEmpEIS = number_format("$count_allEmpEIS",2);

					echo '<td>' . $format_count_allEmpEIS . '</td>';
					echo '</tr>';

					//Deduction
					echo '<tr>';
					echo '<td>' . 'Deduction' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countJanDeduction = $countJan + $data["process_payroll_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countFebDeduction = $countFeb + $data["process_payroll_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>'; 
							$countMarDeduction = $countMar + $data["process_payroll_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countAprDeduction = $countApr + $data["process_payroll_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countMayDeduction = $countMay + $data["process_payroll_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countJunDeduction = $countJun + $data["process_payroll_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countJulDeduction = $countJul + $data["process_payroll_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countAugDeduction = $countAug + $data["process_payroll_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countSepDeduction = $countSep + $data["process_payroll_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countOctDeduction = $countOct + $data["process_payroll_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countNovDeduction = $countNov + $data["process_payroll_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_deduction"] . '</td>';
							$countDecDeduction = $countDec + $data["process_payroll_deduction"];
						}

					}


					$count_allDeduction = $countJanDeduction + $countFebDeduction + $countMarDeduction + $countAprDeduction + $countMayDeduction + $countJunDeduction + $countJulDeduction + $countAugDeduction + $countSepDeduction + $countOctDeduction + $countNovDeduction + $countDecDeduction;
					$format_count_allDeduction = number_format("$count_allDeduction",2);

					echo '<td>' . $format_count_allDeduction . '</td>';
					echo '</tr>';

					//Loan
					echo '<tr>';
					echo '<td>' . 'Loan' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countJanLoan = $countJan + $data["process_payroll_loan"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countFebLoan = $countFeb + $data["process_payroll_loan"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_loan"] . '</td>'; 
							$countMarLoan = $countMar + $data["process_payroll_loan"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countAprLoan = $countApr + $data["process_payroll_loan"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countMayLoan = $countMay + $data["process_payroll_loan"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countJunLoan = $countJun + $data["process_payroll_loan"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countJulLoan = $countJul + $data["process_payroll_loan"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countAugLoan = $countAug + $data["process_payroll_loan"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countSepLoan = $countSep + $data["process_payroll_loan"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countOctLoan = $countOct + $data["process_payroll_loan"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countNovLoan = $countNov + $data["process_payroll_loan"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_loan"] . '</td>';
							$countDecLoan = $countDec + $data["process_payroll_loan"];
						}

					}


					$count_allLoan = $countJanLoan + $countFebLoan + $countMarLoan + $countAprLoan + $countMayLoan + $countJunLoan + $countJulLoan + $countAugLoan + $countSepLoan + $countOctLoan + $countNovLoan + $countDecLoan;
					$format_count_allLoan = number_format("$count_allLoan",2);

					echo '<td>' . $format_count_allLoan . '</td>';
					echo '</tr>';

					//Unpiad Leave
					echo '<tr>';
					echo '<td>' . 'Unpaid Leave' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countJanUnpaidLeave = $countJan + $data["process_payroll_unpaid_leave"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countFebUnpaidLeave = $countFeb + $data["process_payroll_unpaid_leave"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>'; 
							$countMarUnpaidLeave = $countMar + $data["process_payroll_unpaid_leave"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countAprUnpaidLeave = $countApr + $data["process_payroll_unpaid_leave"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countMayUnpaidLeave = $countMay + $data["process_payroll_unpaid_leave"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countJunUnpaidLeave = $countJun + $data["process_payroll_unpaid_leave"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countJulUnpaidLeave = $countJul + $data["process_payroll_unpaid_leave"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countAugUnpaidLeave = $countAug + $data["process_payroll_unpaid_leave"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countSepUnpaidLeave = $countSep + $data["process_payroll_unpaid_leave"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countOctUnpaidLeave = $countOct + $data["process_payroll_unpaid_leave"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countNovUnpaidLeave = $countNov + $data["process_payroll_unpaid_leave"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_unpaid_leave"] . '</td>';
							$countDecUnpaidLeave = $countDec + $data["process_payroll_unpaid_leave"];
						}

					}


					$count_allUnpaidLeave = $countJanUnpaidLeave + $countFebUnpaidLeave + $countMarUnpaidLeave + $countAprUnpaidLeave + $countMayUnpaidLeave + $countJunUnpaidLeave + $countJulUnpaidLeave + $countAugUnpaidLeave + $countSepUnpaidLeave + $countOctUnpaidLeave + $countNovUnpaidLeave + $countDecUnpaidLeave;
					$format_count_allUnpaidLeave = number_format("$count_allUnpaidLeave",2);

					echo '<td>' . $format_count_allUnpaidLeave . '</td>';
					echo '</tr>';

					//Advance Dedcut
					echo '<tr>';
					echo '<td>' . 'Advance Deduct' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countJanAdvanceDeduct = $countJan + $data["process_payroll_advance_deduct"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countFebAdvanceDeduct = $countFeb + $data["process_payroll_advance_deduct"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>'; 
							$countMarAdvanceDeduct = $countMar + $data["process_payroll_advance_deduct"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countAprAdvanceDeduct = $countApr + $data["process_payroll_advance_deduct"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countMayAdvanceDeduct = $countMay + $data["process_payroll_advance_deduct"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countJunAdvanceDeduct = $countJun + $data["process_payroll_advance_deduct"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countJulAdvanceDeduct = $countJul + $data["process_payroll_advance_deduct"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countAugAdvanceDeduct = $countAug + $data["process_payroll_advance_deduct"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countSepAdvanceDeduct = $countSep + $data["process_payroll_advance_deduct"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countOctAdvanceDeduct = $countOct + $data["process_payroll_advance_deduct"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countNovAdvanceDeduct = $countNov + $data["process_payroll_advance_deduct"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_advance_deduct"] . '</td>';
							$countDecAdvanceDeduct = $countDec + $data["process_payroll_advance_deduct"];
						}

					}


					$count_allAdvanceDeduct = $countJanAdvanceDeduct + $countFebAdvanceDeduct + $countMarAdvanceDeduct + $countAprAdvanceDeduct + $countMayAdvanceDeduct + $countJunAdvanceDeduct + $countJulAdvanceDeduct + $countAugAdvanceDeduct + $countSepAdvanceDeduct + $countOctAdvanceDeduct + $countNovAdvanceDeduct + $countDecAdvanceDeduct;
					$format_count_allAdvanceDeduct = number_format("$count_allAdvanceDeduct",2);

					echo '<td>' . $format_count_allAdvanceDeduct . '</td>';
					echo '</tr>';

						//total deductions by month formatted
						$total_deductions_jan = $countJanEmpEPF + $countJanEmpSOCSO + $countJanEmpEIS + $countJanDeduction + $countJanLoan + $countJanUnpaidLeave + $countJanAdvanceDeduct + $countJanEmpEPFAdhoc;
						$format_total_deductions_jan = number_format("$total_deductions_jan",2);

						$total_deductions_feb = $countFebEmpEPF + $countFebEmpSOCSO + $countFebEmpEIS + $countFebDeduction + $countFebLoan + $countFebUnpaidLeave + $countFebAdvanceDeduct + $countFebEmpEPFAdhoc;
						$format_total_deductions_feb = number_format("$total_deductions_feb",2);

						$total_deductions_mar = $countMarEmpEPF + $countMarEmpSOCSO + $countMarEmpEIS + $countMarDeduction + $countMarLoan + $countMarUnpaidLeave + $countMarAdvanceDeduct + $countMarEmpEPFAdhoc;
						$format_total_deductions_mar = number_format("$total_deductions_mar",2);

						$total_deductions_apr = $countAprEmpEPF + $countAprEmpSOCSO + $countAprEmpEIS + $countAprDeduction + $countAprLoan + $countAprUnpaidLeave + $countAprAdvanceDeduct  + $countAprEmpEPFAdhoc;
						$format_total_deductions_apr = number_format("$total_deductions_apr",2);

						$total_deductions_may = $countMayEmpEPF + $countMayEmpSOCSO + $countMayEmpEIS + $countMayDeduction + $countMayLoan + $countMayUnpaidLeave + $countMayAdvanceDeduct + $countMayEmpEPFAdhoc;
						$format_total_deductions_may = number_format("$total_deductions_may",2);

						$total_deductions_jun = $countJunEmpEPF + $countJunEmpSOCSO + $countJunEmpEIS + $countJunDeduction + $countJunLoan + $countJunUnpaidLeave + $countJunAdvanceDeduct + $countJunEmpEPFAdhoc;
						$format_total_deductions_jun = number_format("$total_deductions_jun",2);

						$total_deductions_jul = $countJulEmpEPF + $countJulEmpSOCSO + $countJulEmpEIS + $countJulDeduction + $countJulLoan + $countJulUnpaidLeave + $countJulAdvanceDeduct + $countJulEmpEPFAdhoc;
						$format_total_deductions_jul = number_format("$total_deductions_jul",2);

						$total_deductions_aug = $countAugEmpEPF + $countAugEmpSOCSO + $countAugEmpEIS + $countAugDeduction + $countAugLoan + $countAugUnpaidLeave + $countAugAdvanceDeduct + $countAugEmpEPFAdhoc;
						$format_total_deductions_aug = number_format("$total_deductions_aug",2);

						$total_deductions_sep = $countSepEmpEPF + $countSepEmpSOCSO + $countSepEmpEIS + $countSepDeduction + $countSepLoan + $countSepUnpaidLeave + $countSepAdvanceDeduct + $countSepEmpEPFAdhoc;
						$format_total_deductions_sep = number_format("$total_deductions_sep",2);

						$total_deductions_oct = $countOctEmpEPF + $countOctEmpSOCSO + $countOctEmpEIS + $countOctDeduction + $countOctLoan + $countOctUnpaidLeave + $countOctAdvanceDeduct + $countOctEmpEPFAdhoc;
						$format_total_deductions_oct = number_format("$total_deductions_oct",2);

						$total_deductions_nov = $countNovEmpEPF + $countNovEmpSOCSO + $countNovEmpEIS + $countNovDeduction + $countNovLoan + $countNovUnpaidLeave + $countNovAdvanceDeduct + $countNovEmpEPFAdhoc;
						$format_total_deductions_nov = number_format("$total_deductions_nov",2);

						$total_deductions_dec = $countDecEmpEPF + $countDecEmpSOCSO + $countDecEmpEIS + $countDecDeduction + $countDecLoan + $countDecUnpaidLeave + $countDecAdvanceDeduct + $countDecEmpEPFAdhoc;
						$format_total_deductions_dec = number_format("$total_deductions_dec",2);

					echo '<th>' . 'Total Deductions' . '</th>';
					for($x=1;$x<=12;$x++){
						if($x == 1){
							echo '<th>' . $format_total_deductions_jan . '</th>';
						}
						if($x == 2){
							echo '<th>' . $format_total_deductions_feb . '</th>';
						}
						if($x == 3){
							echo '<th>' . $format_total_deductions_mar . '</th>';
						}
						if($x == 4){
							echo '<th>' . $format_total_deductions_apr . '</th>';
						}
						if($x == 5){
							echo '<th>' . $format_total_deductions_may . '</th>';
						}
						if($x == 6){
							echo '<th>' . $format_total_deductions_jun . '</th>';
						}
						if($x == 7){
							echo '<th>' . $format_total_deductions_jul . '</th>';
						}
						if($x == 8){
							echo '<th>' . $format_total_deductions_aug . '</th>';
						}
						if($x == 9){
							echo '<th>' . $format_total_deductions_sep . '</th>';
						}
						if($x == 10){
							echo '<th>' . $format_total_deductions_oct . '</th>';
						}
						if($x == 11){
							echo '<th>' . $format_total_deductions_nov . '</th>';
						}
						if($x == 12){
							echo '<th>' . $format_total_deductions_dec . '</th>';
						}                        

					}
					$total_deductions_total = $count_allEmpEPF + $count_allEmpSOCSO + $count_allEmpEIS + $count_allDeduction + $count_allLoan + $count_allUnpaidLeave + $count_allAdvanceDeduct + $count_allEmpEPFAdhoc;
					$format_total_deductions_total = number_format("$total_deductions_total",2);

					echo '<th>' . $format_total_deductions_total . '</th>';

					//Adjustments
					echo '<tr>';
					echo '<td>' . 'Adjustments' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countJanAdjustment = $countJan + $data["process_payroll_adjustment"];
						}
						if($i == 2){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countFebAdjustment = $countFeb + $data["process_payroll_adjustment"];
						}
						if($i == 3){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>'; 
							$countMarAdjustment = $countMar + $data["process_payroll_adjustment"];
						}
						if($i == 4){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countAprAdjustment = $countApr + $data["process_payroll_adjustment"];
						}
						if($i == 5){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countMayAdjustment = $countMay + $data["process_payroll_adjustment"];
						}
						if($i == 6){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countJunAdjustment = $countJun + $data["process_payroll_adjustment"];
						}
						if($i == 7){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countJulAdjustment = $countJul + $data["process_payroll_adjustment"];
						}
						if($i == 8){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countAugAdjustment = $countAug + $data["process_payroll_adjustment"];
						}
						if($i == 9){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countSepAdjustment = $countSep + $data["process_payroll_adjustment"];
						}
						if($i == 10){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countOctAdjustment = $countOct + $data["process_payroll_adjustment"];
						} 
						if($i == 11){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countNovAdjustment = $countNov + $data["process_payroll_adjustment"];
						}
						if($i == 12){
							echo '<td>' . $data["process_payroll_adjustment"] . '</td>';
							$countDecAdjustment = $countDec + $data["process_payroll_adjustment"];
						}

					}


					$count_allAdjustment = $countJanAdjustment + $countFebAdjustment + $countMarAdjustment + $countAprAdjustment + $countMayAdjustment + $countJunAdjustment + $countJulAdjustment + $countAugAdjustment + $countSepAdjustment + $countOctAdjustment + $countNovAdjustment + $countDecAdjustment;
					$format_count_allAdjustment = number_format("$count_allAdjustment",2);

					echo '<td>' . $format_count_allAdjustment . '</td>';
					echo '</tr>';

					//yearly individual nett pay
					$nett_pay_jan = $total_earnings_jan - $total_deductions_jan + $countJanAdjustment;
					$format_nett_pay_jan = number_format("$nett_pay_jan",2);

					$nett_pay_feb = $total_earnings_feb - $total_deductions_feb + $countFebAdjustment;
					$format_nett_pay_feb = number_format("$nett_pay_feb",2);

					$nett_pay_mar = $total_earnings_mar - $total_deductions_mar + $countMarAdjustment;
					$format_nett_pay_mar = number_format("$nett_pay_mar",2);

					$nett_pay_apr = $total_earnings_apr - $total_deductions_apr + $countAprAdjustment;
					$format_nett_pay_apr = number_format("$nett_pay_apr",2);

					$nett_pay_may = $total_earnings_may - $total_deductions_may + $countMayAdjustment;
					$format_nett_pay_may = number_format("$nett_pay_may",2);

					$nett_pay_jun = $total_earnings_jun - $total_deductions_jun + $countJunAdjustment;
					$format_nett_pay_jun = number_format("$nett_pay_jun",2);

					$nett_pay_jul = $total_earnings_jul - $total_deductions_jul + $countJulAdjustment;
					$format_nett_pay_jul = number_format("$nett_pay_jul",2);

					$nett_pay_aug = $total_earnings_aug - $total_deductions_aug + $countAugAdjustment;
					$format_nett_pay_aug = number_format("$nett_pay_aug",2);

					$nett_pay_sep = $total_earnings_sep - $total_deductions_sep + $countSepAdjustment;
					$format_nett_pay_sep = number_format("$nett_pay_sep",2);

					$nett_pay_oct = $total_earnings_oct - $total_deductions_oct + $countOctAdjustment;
					$format_nett_pay_oct = number_format("$nett_pay_oct",2);

					$nett_pay_nov = $total_earnings_nov - $total_deductions_nov + $countNovAdjustment;
					$format_nett_pay_nov = number_format("$nett_pay_nov",2);

					$nett_pay_dec = $total_earnings_dec - $total_deductions_dec + $countDecAdjustment;
					$format_nett_pay_dec = number_format("$nett_pay_dec",2);

					$nett_pay_total = $total_earnings_total - $total_deductions_total + $count_allAdjustment;
					$format_nett_pay_total = number_format("$nett_pay_total",2);

					echo '<th>' . 'NETT PAY'. '</th>';

					for($x=1;$x<=12;$x++){
						if($x == 1){
							echo '<th>' . $format_nett_pay_jan . '</th>';
						}
						if($x == 2){
							echo '<th>' . $format_nett_pay_feb . '</th>';
						}
						if($x == 3){
							echo '<th>' . $format_nett_pay_mar . '</th>';
						}
						if($x == 4){
							echo '<th>' . $format_nett_pay_apr . '</th>';
						}
						if($x == 5){
							echo '<th>' . $format_nett_pay_may . '</th>';
						}
						if($x == 6){
							echo '<th>' . $format_nett_pay_jun . '</th>';
						}
						if($x == 7){
							echo '<th>' . $format_nett_pay_jul . '</th>';
						}
						if($x == 8){
							echo '<th>' . $format_nett_pay_aug . '</th>';
						}
						if($x == 9){
							echo '<th>' . $format_nett_pay_sep . '</th>';
						}
						if($x == 10){
							echo '<th>' . $format_nett_pay_oct . '</th>';
						}
						if($x == 11){
							echo '<th>' . $format_nett_pay_nov . '</th>';
						}
						if($x == 12){
							echo '<th>' . $format_nett_pay_dec . '</th>';
						}                        
					}
					echo '<th>' . $format_nett_pay_total . '</th>';

					//Employer EPF
					echo '<tr>';
					echo '<td>' . 'Employer EPF' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJanEmprEPF = $countJan + $data["epf_employer_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countFebEmprEPF = $countFeb + $data["epf_employer_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>'; 
							$countMarEmprEPF = $countMar + $data["epf_employer_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countAprEmprEPF = $countApr + $data["epf_employer_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countMayEmprEPF = $countMay + $data["epf_employer_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJunEmprEPF = $countJun + $data["epf_employer_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJulEmprEPF = $countJul + $data["epf_employer_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countAugEmprEPF = $countAug + $data["epf_employer_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countSepEmprEPF = $countSep + $data["epf_employer_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countOctEmprEPF = $countOct + $data["epf_employer_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countNovEmprEPF = $countNov + $data["epf_employer_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countDecEmprEPF = $countDec + $data["epf_employer_deduction"];
						}

					}


					$count_allEmprEPF = $countJanEmprEPF + $countFebEmprEPF + $countMarEmprEPF + $countAprEmprEPF + $countMayEmprEPF + $countJunEmprEPF + $countJulEmprEPF + $countAugEmprEPF + $countSepEmprEPF + $countOctEmprEPF + $countNovEmprEPF + $countDecEmprEPF;
					$format_count_allEmprEPF = number_format("$count_allEmprEPF",2);

					echo '<td>' . $format_count_allEmprEPF . '</td>';
					echo '</tr>';

					//Employer EPF Adhoc
					echo '<tr>';
					echo '<td>' . 'Employer EPF (Adhoc)' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query2 = mysqli_query($conn, "select process_adhoc.*, employee_info.* FROM process_adhoc INNER JOIN employee_info WHERE process_adhoc_process_month = '$i' AND process_adhoc.emp_id = '$get_emp_id' AND process_adhoc_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query2);

						if($i == 1){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJanEmprEPFAdhoc = $countJan + $data["epf_employer_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countFebEmprEPFAdhoc = $countFeb + $data["epf_employer_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>'; 
							$countMarEmprEPFAdhoc = $countMar + $data["epf_employer_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countAprEmprEPFAdhoc = $countApr + $data["epf_employer_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countMayEmprEPFAdhoc = $countMay + $data["epf_employer_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJunEmprEPFAdhoc = $countJun + $data["epf_employer_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countJulEmprEPFAdhoc = $countJul + $data["epf_employer_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countAugEmprEPFAdhoc = $countAug + $data["epf_employer_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countSepEmprEPFAdhoc = $countSep + $data["epf_employer_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countOctEmprEPFAdhoc = $countOct + $data["epf_employer_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countNovEmprEPFAdhoc = $countNov + $data["epf_employer_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["epf_employer_deduction"] . '</td>';
							$countDecEmprEPFAdhoc = $countDec + $data["epf_employer_deduction"];
						}

					}


					$count_allEmprEPFAdhoc = $countJanEmprEPFAdhoc + $countFebEmprEPFAdhoc + $countMarEmprEPFAdhoc + $countAprEmprEPFAdhoc + $countMayEmprEPFAdhoc + $countJunEmprEPFAdhoc + $countJulEmprEPFAdhoc + $countAugEmprEPFAdhoc + $countSepEmprEPFAdhoc + $countOctEmprEPFAdhoc + $countNovEmprEPFAdhoc + $countDecEmprEPFAdhoc;
					$format_count_allEmprEPFAdhoc = number_format("$count_allEmprEPFAdhoc",2);

					echo '<td>' . $format_count_allEmprEPFAdhoc . '</td>';
					echo '</tr>';

					//Employer SOCSO
					echo '<tr>';
					echo '<td>' . 'Employer SOCSO' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countJanEmprSOCSO = $countJan + $data["socso_employer_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countFebEmprSOCSO = $countFeb + $data["socso_employer_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>'; 
							$countMarEmprSOCSO = $countMar + $data["socso_employer_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countAprEmprSOCSO = $countApr + $data["socso_employer_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countMayEmprSOCSO = $countMay + $data["socso_employer_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countJunEmprSOCSO = $countJun + $data["socso_employer_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countJulEmprSOCSO = $countJul + $data["socso_employer_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countAugEmprSOCSO = $countAug + $data["socso_employer_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countSepEmprSOCSO = $countSep + $data["socso_employer_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countOctEmprSOCSO = $countOct + $data["socso_employer_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countNovEmprSOCSO = $countNov + $data["socso_employer_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["socso_employer_deduction"] . '</td>';
							$countDecEmprSOCSO = $countDec + $data["socso_employer_deduction"];
						}

					}


					$count_allEmprSOCSO = $countJanEmprSOCSO + $countFebEmprSOCSO + $countMarEmprSOCSO + $countAprEmprSOCSO + $countMayEmprSOCSO + $countJunEmprSOCSO + $countJulEmprSOCSO + $countAugEmprSOCSO + $countSepEmprSOCSO + $countOctEmprSOCSO + $countNovEmprSOCSO + $countDecEmprSOCSO;
					$format_count_allEmprSOCSO = number_format("$count_allEmprSOCSO",2);

					echo '<td>' . $format_count_allEmprSOCSO . '</td>';
					echo '</tr>';

					//Employer EIS
					echo '<tr>';
					echo '<td>' . 'Employer EIS' . '</td>';                  
					for($i=1;$i<=12;$i++){

						$query = mysqli_query($conn, "select process_payroll.*, employee_info.* FROM process_payroll INNER JOIN employee_info WHERE process_payroll_process_month = '$i' AND process_payroll.emp_id = '$get_emp_id' AND process_payroll_process_year = '$get_year'");
						$data = mysqli_fetch_assoc($query);

						if($i == 1){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countJanEmprEIS = $countJan + $data["eis_employer_deduction"];
						}
						if($i == 2){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countFebEmprEIS = $countFeb + $data["eis_employer_deduction"];
						}
						if($i == 3){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>'; 
							$countMarEmprEIS = $countMar + $data["eis_employer_deduction"];
						}
						if($i == 4){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countAprEmprEIS = $countApr + $data["eis_employer_deduction"];
						}
						if($i == 5){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countMayEmprEIS = $countMay + $data["eis_employer_deduction"];
						}
						if($i == 6){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countJunEmprEIS = $countJun + $data["eis_employer_deduction"];
						}
						if($i == 7){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countJulEmprEIS = $countJul + $data["eis_employer_deduction"];
						}
						if($i == 8){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countAugEmprEIS = $countAug + $data["eis_employer_deduction"];
						}
						if($i == 9){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countSepEmprEIS = $countSep + $data["eis_employer_deduction"];
						}
						if($i == 10){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countOctEmprEIS = $countOct + $data["eis_employer_deduction"];
						} 
						if($i == 11){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countNovEmprEIS = $countNov + $data["eis_employer_deduction"];
						}
						if($i == 12){
							echo '<td>' . $data["eis_employer_deduction"] . '</td>';
							$countDecEmprEIS = $countDec + $data["eis_employer_deduction"];
						}

					}


					$count_allEmprEIS = $countJanEmprEIS + $countFebEmprEIS + $countMarEmprEIS + $countAprEmprEIS + $countMayEmprEIS + $countJunEmprEIS + $countJulEmprEIS + $countAugEmprEIS + $countSepEmprEIS + $countOctEmprEIS + $countNovEmprEIS + $countDecEmprEIS;
					$format_count_allEmprEIS = number_format("$count_allEmprEIS",2);

					echo '<td>' . $format_count_allEmprEIS . '</td>';
					echo '</tr>';

					//yearly individual total Employer Cost
					$employer_cost_jan = $nett_pay_jan + $countJanEmprEPF + $countJanEmprSOCSO + $countJanEmprEIS + $countJanEmprEPFAdhoc;
					$format_employer_cost_jan = number_format("$employer_cost_jan",2);

					$employer_cost_feb = $nett_pay_feb + $countFebEmprEPF + $countFebEmprSOCSO + $countFebEmprEIS + $countFebEmprEPFAdhoc;
					$format_employer_cost_feb = number_format("$employer_cost_feb",2);

					$employer_cost_mar = $nett_pay_mar + $countMarEmprEPF + $countMarEmprSOCSO + $countMarEmprEIS + $countMarEmprEPFAdhoc;
					$format_employer_cost_mar = number_format("$employer_cost_mar",2);

					$employer_cost_apr = $nett_pay_apr + $countAprEmprEPF + $countAprEmprSOCSO + $countAprEmprEIS + $countAprEmprEPFAdhoc;
					$format_employer_cost_apr = number_format("$employer_cost_apr",2);

					$employer_cost_may = $nett_pay_may + $countMayEmprEPF + $countMayEmprSOCSO + $countMayEmprEIS + $countMayEmprEPFAdhoc;
					$format_employer_cost_may = number_format("$employer_cost_may",2);

					$employer_cost_jun = $nett_pay_jun + $countJunEmprEPF + $countJunEmprSOCSO + $countJunEmprEIS + $countJunEmprEPFAdhoc;
					$format_employer_cost_jun = number_format("$employer_cost_jun",2);

					$employer_cost_jul = $nett_pay_jul + $countJulEmprEPF + $countJulEmprSOCSO + $countJulEmprEIS + $countJulEmprEPFAdhoc;
					$format_employer_cost_jul = number_format("$employer_cost_jul",2);

					$employer_cost_aug = $nett_pay_aug + $countAugEmprEPF + $countAugEmprSOCSO + $countAugEmprEIS + $countAugEmprEPFAdhoc;
					$format_employer_cost_aug = number_format("$employer_cost_aug",2);

					$employer_cost_sep = $nett_pay_sep + $countSepEmprEPF + $countSepEmprSOCSO + $countSepEmprEIS + $countSepEmprEPFAdhoc;
					$format_employer_cost_sep = number_format("$employer_cost_sep",2);

					$employer_cost_oct = $nett_pay_oct + $countOctEmprEPF + $countOctEmprSOCSO + $countOctEmprEIS + $countOctEmprEPFAdhoc;
					$format_employer_cost_oct = number_format("$employer_cost_oct",2);

					$employer_cost_nov = $nett_pay_nov + $countNovEmprEPF + $countNovEmprSOCSO + $countNovEmprEIS + $countNovEmprEPFAdhoc;
					$format_employer_cost_nov = number_format("$employer_cost_nov",2);

					$employer_cost_dec = $nett_pay_dec + $countDecEmprEPF + $countDecEmprSOCSO + $countDecEmprEIS + $countDecEmprEPFAdhoc;
					$format_employer_cost_dec = number_format("$employer_cost_dec",2);

					$employer_cost_total = $nett_pay_total + $count_allEmprEPF + $count_allEmprSOCSO + $count_allEmprEIS + $count_allEmprEPFAdhoc;
					$format_employer_cost_total = number_format("$employer_cost_total",2);

					echo '<th>' . 'Total Employer Cost' . '</th>';

					for($x=1;$x<=12;$x++){
						if($x == 1){
							echo '<th>' . $format_employer_cost_jan . '</th>';
						}
						if($x == 2){
							echo '<th>' . $format_employer_cost_feb . '</th>';
						}
						if($x == 3){
							echo '<th>' . $format_employer_cost_mar . '</th>';
						}
						if($x == 4){
							echo '<th>' . $format_employer_cost_apr . '</th>';
						}
						if($x == 5){
							echo '<th>' . $format_employer_cost_may . '</th>';
						}
						if($x == 6){
							echo '<th>' . $format_employer_cost_jun . '</th>';
						}
						if($x == 7){
							echo '<th>' . $format_employer_cost_jul . '</th>';
						}
						if($x == 8){
							echo '<th>' . $format_employer_cost_aug . '</th>';
						}
						if($x == 9){
							echo '<th>' . $format_employer_cost_sep . '</th>';
						}
						if($x == 10){
							echo '<th>' . $format_employer_cost_oct . '</th>';
						}
						if($x == 11){
							echo '<th>' . $format_employer_cost_nov . '</th>';
						}
						if($x == 12){
							echo '<th>' . $format_employer_cost_dec . '</th>';
						}                        
					}
					echo '<th>' . $format_employer_cost_total . '</th>';
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
