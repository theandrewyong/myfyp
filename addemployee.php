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
<title>Payroll Software - Add Employee</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
<div id="page-content-wrapper">
<?php include "navbar.php"; ?>
<div class="container-fluid">
<h1 class="mt-4">Add Employee</h1>
<hr>
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5 bg-white rounded shadow mb-5">
								<form class="form-horizontal" role="form" action="addemployee_data.php" method="post">
									<a id="employee_section"><h1>Employee Main Profile</h1></a> 
									<div class="col-sm-3"><a href="#payroll_section" class="btn btn-primary btn-block payroll_button">Payroll Details</a></div>
									
									<div class="form-group">
										<label for="emp_full_name" class="col-sm-3 control-label"><h6>Full Name</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Gender</h6></label>
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
										<label for="emp_dob" class="col-sm-3 control-label"><h6>Date of Birth</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_dob" class="form-control" name="emp_dob" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_email" class="col-sm-3 control-label"><h6>Email</h6></label>
										<div class="col-sm-9">
											<input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_address" class="col-sm-3 control-label"><h6>Address</h6></label>
										<div class="col-sm-9">
											<input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_mobile" class="col-sm-3 control-label"><h6>Phone number</h6></label>
										<div class="col-sm-9">
											<input type="tel" id="emp_mobile" placeholder="Phone" class="form-control" name="emp_mobile">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_telephone" class="col-sm-5 control-label"><h6>Telephone number</h6></label>
										<div class="col-sm-9">
											<input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_ic" class="col-sm-3 control-label"><h6>IC</h6></label>
										<div class="col-sm-9">
											<input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_passport" class="col-sm-7 control-label"><h6>Passport Number (Optional)</h6></label>
										<div class="col-sm-9">
											<input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_immigration" class="col-sm-7 control-label"><h6>Immigration Number (Optional)</h6> </label>
										<div class="col-sm-9">
											<input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_title" class="col-sm-3 control-label"><h6>Job Title</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control">
										</div>
									</div>
									
									<br/>
									<hr/>
									<a id="payroll_section"><h1>Payroll Details</h1></a>
									<div class="col-sm-5"><a href="#employee_section" class="btn btn-primary btn-block employee_button">Employee Main Profile</a></div>
									
									<div class="form-group">
										<label for="emp_wages" class="col-sm-3 control-label"><h6>Wages</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Payment Method</h6></label>
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
										<label class="sel1 control-label col-sm-3"><h6>Bank Name</h6></label>
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
										<label for="emp_account" class="col-sm-3 control-label"><h6>Bank Account</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Health Status</h6></label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="resident" name="emp_health_status" value="Resident">Resident
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="self-disabled" name="emp_health_status" value="Self-Disabled">Self-Disabled
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Martial Status</h6></label>
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
										<label class="control-label col-sm-3"><h6>Spouse Status</h6></label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="work" name="emp_spouse_status" value="Work">Work
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="disabled" name="emp_spouse_status" value="Disabled">Disabled
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="none" name="emp_spouse_status" value="None">None
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_epf" class="col-sm-3 control-label"><h6>Employee EPF</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_socso" class="col-sm-3 control-label"><h6>Employee SOCSO</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-3"><h6>SOCSO Type</h6></label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_socso_type" name="emp_socso_type">
												<option value="Category 1">Category 1</option>
												<option value="Category 2">Category 2</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-3"><h6>EIS Eligibility</h6></label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_eis_type" name="emp_eis_type">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_join_date" class="col-sm-3 control-label"><h6>Employee Join Date</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_join_date" name="emp_join_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_confirm_date" class="col-sm-3 control-label"><h6>Employee Start Date</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_resign_date" class="col-sm-3 control-label"><h6>Employee Resign Date (Optional)</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn-block">Register</button>
									</div>
									
								</form> <!-- /form -->
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
