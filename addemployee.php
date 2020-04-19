<?php
    session_start();
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

<title>Payroll Software - Add Employee</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">

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
<h1 class="mt-4">Add Employee</h1>
<hr>
<!-- dashboard conten here -->
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Tabs</h2>
            <ul id="tabsJustified" class="nav nav-tabs nav-fill">

                <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase active">Main Profile</a></li>
                <li class="nav-item"><a href="" data-target="#allowance" data-toggle="tab" class="nav-link small text-uppercase">Allowance</a></li>
				<li class="nav-item"><a href="" data-target="#deduction" data-toggle="tab" class="nav-link small text-uppercase">Deduction</a></li>
            </ul>
            <br>

			<div id="tabsJustifiedContent" class="tab-content">
				
                <div id="profile1" class="tab-pane fade active show">
                    <div class="row pb-2">
                        <div class="col-md-12">
							
							<div class="container">
								<!--<form class="form-horizontal" role="form" action="addemployee_data.php" method="post">-->
								<form class="form-horizontal" role="form">
									<h1>Employee Main Profile</h1>
									
									<div class="form-group">
										<label for="emp_id" class="col-sm-3 control-label">Assign Unique ID Number</label>
										<div class="col-sm-9">
											<input type="number" id="emp_id" name="emp_id" placeholder="Unique ID for Employee" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_full_name" class="col-sm-3 control-label">Full Name</label>
										<div class="col-sm-9">
											<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3">Gender</label>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="femaleRadio" name="emp_gender" value="Female">Female
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="maleRadio" name="emp_gender" value="Male">Male
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_dob" class="col-sm-3 control-label">Date of Birth</label>
										<div class="col-sm-9">
											<input type="date" id="emp_dob" class="form-control" name="emp_dob">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_email" class="col-sm-3 control-label">Email </label>
										<div class="col-sm-9">
											<input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_address" class="col-sm-3 control-label">Address</label>
										<div class="col-sm-9">
											<input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_mobile" class="col-sm-3 control-label">Phone number </label>
										<div class="col-sm-9">
											<input type="tel" id="emp_mobile" placeholder="Phone number" class="form-control" name="emp_mobile" pattern="[0-9]{3}-[0-9]{3}-[0-9]{5}">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_telephone" class="col-sm-3 control-label">Telephone number </label>
										<div class="col-sm-9">
											<input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{5}">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_ic" class="col-sm-3 control-label">IC </label>
										<div class="col-sm-9">
											<input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_passport" class="col-sm-7 control-label">Passport Number (Optional) </label>
										<div class="col-sm-9">
											<input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_immigration" class="col-sm-7 control-label">Immigration Number (Optional) </label>
										<div class="col-sm-9">
											<input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_title" class="col-sm-3 control-label">Job Title </label>
										<div class="col-sm-9">
											<input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control">
										</div>
									</div>
									
									<h1>Payroll Details</h1>
									
									<div class="form-group">
										<label for="emp_wages" class="col-sm-3 control-label">Wages</label>
										<div class="col-sm-9">
											<input type="number" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3">Payment Method</label>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="bankin" name="emp_payment_method" value="Bank-In">Bank-In
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="cash" name="emp_payment_method" value="Cash">Cash
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="cheque" name="emp_payment_method" value="Cheque">Cheque
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
									  <label class="sel1 control-label col-sm-3">Bank Name</label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_bank_name" name="emp_bank_name">
												<option value="Maybank">Maybank</option>
												<option value="CIMB">CIMB Bank</option>
												<option value="Public Bank">Public Bank Berhad</option>
												<option value="RHB">RHB Bank</option>
												<option value="Hong Leong">Hong Leong Bank</option>
												<option value="AmBank">AmBank</option>
												<option value="Bank Rakyat">Bank Rakyat</option>
												<option value="HSBC">HSBC Bank Malaysia</option>
												<option value="UOB">UOB Malaysia Bank</option>
												<option value="OCBC">OCBC Bank Malaysia</option>
												<option value="Affin">Affin Bank	</option>
												<option value="Bank Islam">Bank Islam Malaysia</option>
												<option value="Standard Chartered">Standard Chartered Bank Malaysia</option>
												<option value="CitiBank">CitiBank Malaysia</option>
												<option value="BSN">Bank Simpanan Nasional (BSN)</option>
												<option value="Alliance">Alliance Bank</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_account" class="col-sm-3 control-label">Bank Account </label>
										<div class="col-sm-9">
											<input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-6">Health Status (Optional)</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="checkbox-inline"><input type="checkbox" value="Resident" name="emp_health_status">Resident</label>
												</div>
												<div class="col-sm-6">
													<label class="checkbox-inline"><input type="checkbox" value="Self-Disabled" name="emp_health_status">Self-Disabled</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3">Martial Status</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="single" name="emp_martial_status" value="Single">Single
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="married" name="emp_martial_status" value="Married">Married
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="divorced" name="emp_martial_status" value="Divorced">Divorced
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="widow" name="emp_martial_status" value="Widow">Widow
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-6">Spouse Status (Optional)</label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="checkbox-inline"><input type="checkbox" value="Work" name="emp_spouse_status">Work</label>
												</div>
												<div class="col-sm-6">
													<label class="checkbox-inline"><input type="checkbox" value="Work" name="emp_spouse_status">Disabled</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_epf" class="col-sm-3 control-label">Employee EPF</label>
										<div class="col-sm-9">
											<input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_socso" class="col-sm-3 control-label">Employee SOCSO</label>
										<div class="col-sm-9">
											<input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
									  <label class="sel1 control-label col-sm-3">SOCSO Type</label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_socso_type" name="emp_socso_type">
												<option value="Category 1">Category 1</option>
												<option value="Category 2">Category 2</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
									  <label class="sel1 control-label col-sm-3">EIS Eligibility</label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_eis_type" name="emp_eis_type">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_join_date" class="col-sm-3 control-label">Employee Join Date</label>
										<div class="col-sm-9">
											<input type="date" id="emp_join_date" name="emp_join_date" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_confirm_date" class="col-sm-3 control-label">Employee Start Date</label>
										<div class="col-sm-9">
											<input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_resign_date" class="col-sm-3 control-label">Employee Resign Date (Optional)</label>
										<div class="col-sm-9">
											<input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control">
										</div>
									</div>
									
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn-block">Register</button>
									</div>
									
								</form> <!-- /form -->
							</div>
						</div>
					</div>
                </div>
				
				<div id="allowance" class="tab-pane fade">
					<div class="row pb-2">
                        <div class="col-md-12">
                    		<div class="container">
								<h1>Assign Allowance</h1>
							</div>
						</div>
					</div>
				</div>
				
				<div id="deduction" class="tab-pane fade">
					<div class="row pb-2">
                        <div class="col-md-12">
                    		<div class="container">
								<h1>Assign Dedcution</h1>
							</div>
						</div>
					</div>
				</div>
				
            </div>
        </div>
	</div>
	
</section>
    
    
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

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});
</script>

</body>

</html>
