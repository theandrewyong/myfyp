<?php
    session_start();
	include "conn.php";
    if(empty($_SESSION["username"])){
        header("location:index.php");
    }
    $username = $_SESSION["username"];

	$get_emp_id = $_GET["emp_id"];

	
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Payroll Software - Edit Employee</title>

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
<h1 class="mt-4">Edit Employee</h1>
<hr>
<!-- dashboard conten here -->
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5 bg-white rounded shadow mb-5">
            <!-- Rounded tabs -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Employee Info</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Allowance</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profilex-tab" data-toggle="tab" href="#profilex" role="tab" aria-controls="profilex" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Deduction</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
							<div class="container">
								
								<?php
								  //submit_1
								  if(isset($_POST["submit_1"])){
									  
									$emp_full_name = $_POST["emp_full_name"];
									$emp_gender = $_POST["emp_gender"];
									$emp_dob = $_POST["emp_dob"];
									$emp_email = $_POST["emp_email"];
									$emp_address = $_POST["emp_address"];
									$emp_mobile = $_POST["emp_mobile"];
									$emp_telephone = $_POST["emp_telephone"];
									$emp_ic = $_POST["emp_ic"];
									$emp_passport = $_POST["emp_passport"];
									$emp_immigration = $_POST["emp_immigration"];
									$emp_title = $_POST["emp_title"];
									$emp_wages = $_POST["emp_wages"];
									$emp_payment_method = $_POST["emp_payment_method"];
									$emp_bank_name = $_POST["emp_bank_name"];
									$emp_account = $_POST["emp_account"];
									$emp_health_status = $_POST["emp_health_status"];
									$emp_martial_status = $_POST["emp_martial_status"];
									$emp_spouse_status = $_POST["emp_spouse_status"];
									$emp_epf = $_POST["emp_epf"];
									$emp_socso = $_POST["emp_socso"];
									$emp_socso_type = $_POST["emp_socso_type"];
									$emp_eis_type = $_POST["emp_eis_type"];
									$emp_join_date = $_POST["emp_join_date"];
									$emp_confirm_date = $_POST["emp_confirm_date"];
									$emp_resign_date  = $_POST["emp_resign_date"];
									$data_edited_date = date("Y/m/d");
									  
	
									  $update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_full_name='$emp_full_name', emp_gender='$emp_gender', emp_dob='$emp_dob', emp_email='$emp_email', emp_address='$emp_address', emp_mobile='$emp_mobile', emp_telephone='$emp_telephone', emp_ic='$emp_ic', emp_passport='$emp_passport', emp_immigration='$emp_immigration', emp_title='$emp_title', emp_wages='$emp_wages', emp_payment_method='$emp_payment_method', emp_bank_name='$emp_bank_name', emp_account='$emp_account', emp_health_status='$emp_health_status', emp_martial_status='$emp_martial_status', emp_spouse_status='$emp_spouse_status', emp_epf='$emp_epf', emp_socso='$emp_socso', emp_socso_type='$emp_socso_type', emp_eis_type='$emp_eis_type', emp_join_date='$emp_join_date', emp_confirm_date='$emp_confirm_date', emp_resign_date='$emp_resign_date', data_edited_date='$data_edited_date' WHERE emp_id ='$get_emp_id'");

								  }
								//submit_2
									if(isset($_POST["submit_2"])){
										
										$emp_allowance_desc = $_POST["select_allowance_desc"];
										$emp_id = $get_emp_id;
										
										$select_employee_allowance = "SELECT * FROM allowance WHERE allowance_desc = '$emp_allowance_desc'";
										
										$prepared_stmt_insert = mysqli_prepare($conn, $select_employee_allowance);
										mysqli_stmt_execute($prepared_stmt_insert);
										$result = $prepared_stmt_insert->get_result(); 
										$data = $data = $result->fetch_assoc();
										 
										$allowance_id = $data["allowance_id"];
										$allowance_desc = $data["allowance_desc"];
										$allowance_rate = $data["allowance_rate"];
										
										$new_employee_allowance = "INSERT INTO employee_allowance (emp_id, allowance_id, allowance_desc, allowance_rate) VALUES (?,?,?,?)";
										

										$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_allowance);

										mysqli_stmt_bind_param($prepared_stmt_insert, 'ssss', $emp_id, $allowance_id, $allowance_desc, $allowance_rate);
										
										mysqli_stmt_execute($prepared_stmt_insert);
										mysqli_stmt_close($prepared_stmt_insert);
									}
								//submit_3
									if(isset($_POST["submit_3"])){
										
										$emp_deduction_desc = $_POST["select_deduction_desc"];
										$emp_id = $get_emp_id;
										
										$select_employee_deduction = "SELECT * FROM deduction WHERE deduction_desc = '$emp_deduction_desc'";
										
										$prepared_stmt_insert = mysqli_prepare($conn, $select_employee_deduction);
										mysqli_stmt_execute($prepared_stmt_insert);
										$result = $prepared_stmt_insert->get_result(); 
										$data = $data = $result->fetch_assoc();
										 
										$deduction_id = $data["deduction_id"];
										$deduction_desc = $data["deduction_desc"];
										$deduction_rate = $data["deduction_rate"];
										
										$new_employee_deduction = "INSERT INTO employee_deduction (emp_id, deduction_id, deduction_desc, deduction_rate) VALUES (?,?,?,?)";
										

										$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_deduction);

										mysqli_stmt_bind_param($prepared_stmt_insert, 'ssss', $emp_id, $deduction_id, $deduction_desc, $deduction_rate);
										
										mysqli_stmt_execute($prepared_stmt_insert);
										mysqli_stmt_close($prepared_stmt_insert);
									}
								
								  //show all existing value in all input fields
									$show_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$get_emp_id'");
									$show_data = mysqli_fetch_assoc($show_sql);
									$show_emp_id = $show_data['emp_id'];
									$show_emp_full_name = $show_data['emp_full_name'];
									$show_emp_gender = $show_data['emp_gender'];
									$show_emp_dob = $show_data['emp_dob'];
									$show_emp_email = $show_data['emp_email'];
									$show_emp_address = $show_data['emp_address'];
									$show_emp_mobile = $show_data['emp_mobile'];
									$show_emp_telephone = $show_data['emp_telephone'];
									$show_emp_ic = $show_data['emp_ic'];
									$show_emp_passport = $show_data['emp_passport'];
									$show_emp_immigration = $show_data['emp_immigration'];
									$show_emp_title = $show_data['emp_title'];
									$show_emp_wages = $show_data['emp_wages'];
									$show_emp_payment_method = $show_data['emp_payment_method'];
									$show_emp_bank_name = $show_data['emp_bank_name'];
									$show_emp_account = $show_data['emp_account'];
									$show_emp_health_status = $show_data['emp_health_status'];
									$show_emp_martial_status = $show_data['emp_martial_status'];
									$show_emp_spouse_status = $show_data['emp_spouse_status'];
									$show_emp_epf = $show_data['emp_epf'];
									$show_emp_socso = $show_data['emp_socso'];
									$show_emp_socso_type = $show_data['emp_socso_type'];
									$show_emp_eis_type = $show_data['emp_eis_type'];
									$show_emp_join_date = $show_data['emp_join_date'];
									$show_emp_confirm_date = $show_data['emp_confirm_date'];
									$show_emp_resign_date = $show_data['emp_resign_date'];
								  ?>
								
								<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
									<a id="employee_section"><h1>Employee Main Profile</h1></a> 
									<div class="col-sm-3"><a href="#payroll_section" class="btn btn-primary btn-block payroll_button">Payroll Details</a></div>
										
											<div class="col-md-9">
												<label for="emp_id">Employee ID</label>
												<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $get_emp_id; ?>" disabled>
											</div>
										
									  	<div class="form-group">
										<label for="emp_full_name" class="col-sm-3 control-label"><h6>Full Name</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>" autofocus>
										</div>
										</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Gender<?php echo $show_emp_gender; ?></h6></label>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="femaleRadio" name="emp_gender" value="Female"
														<?php 
															if($show_emp_gender == "Female"){
															   echo 'checked="checked"';
															}
															else{
															}
														 ?> >Female
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="maleRadio" name="emp_gender" value="Male"
														<?php 
															if($show_emp_gender == "Male"){
															   echo 'checked="checked"';
															}
															else{
															}
														 ?> >Male
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_dob" class="col-sm-3 control-label"><h6>Date of Birth</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_dob" class="form-control" name="emp_dob" value="<?php echo $show_emp_dob; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_email" class="col-sm-3 control-label"><h6>Email</h6></label>
										<div class="col-sm-9">
											<input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email" value="<?php echo $show_emp_email; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_address" class="col-sm-3 control-label"><h6>Address</h6></label>
										<div class="col-sm-9">
											<input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address" value="<?php echo $show_emp_address; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_mobile" class="col-sm-3 control-label"><h6>Phone number</h6></label>
										<div class="col-sm-9">
											<input type="tel" id="emp_mobile" placeholder="Phone" class="form-control" name="emp_mobile" value="<?php echo $show_emp_mobile; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_telephone" class="col-sm-5 control-label"><h6>Telephone number</h6></label>
										<div class="col-sm-9">
											<input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone" value="<?php echo $show_emp_telephone; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_ic" class="col-sm-3 control-label"><h6>IC</h6></label>
										<div class="col-sm-9">
											<input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic" value="<?php echo $show_emp_ic; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_passport" class="col-sm-7 control-label"><h6>Passport Number (Optional)</h6></label>
										<div class="col-sm-9">
											<input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport" value="<?php echo $show_emp_passport; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_immigration" class="col-sm-7 control-label"><h6>Immigration Number (Optional)</h6> </label>
										<div class="col-sm-9">
											<input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control" value="<?php echo $show_emp_immigration; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_title" class="col-sm-3 control-label"><h6>Job Title</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control" value="<?php echo $show_emp_title; ?>">
										</div>
									</div>
									
									<br/>
									<hr/>
									<a id="payroll_section"><h1>Payroll Details</h1></a>
									<div class="col-sm-5"><a href="#employee_section" class="btn btn-primary btn-block employee_button">Employee Main Profile</a></div>
									
									<div class="form-group">
										<label for="emp_wages" class="col-sm-3 control-label"><h6>Wages</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control" value="<?php echo $show_emp_wages; ?>" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Payment Method</h6></label>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="bankin" name="emp_payment_method" value="Bank-In"
															   <?php 
															if($show_emp_payment_method == "Bank-In"){
															   echo 'checked="checked"';
															}
															else{
															}
														 ?> >Bank-In
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="cash" name="emp_payment_method" value="Cash"
															   <?php 
															if($show_emp_payment_method == "Cash"){
															   echo 'checked="checked"';
															}
															else{
															}
														 ?> >Cash
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="cheque" name="emp_payment_method" value="Cheque"
															   <?php 
															if($show_emp_payment_method == "Cheque"){
															   echo 'checked="checked"';
															}
															else{
															}
														 ?> >Cheque
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="sel1 control-label col-sm-3"><h6>Bank Name</h6></label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_bank_name" name="emp_bank_name">
												<option value="Maybank" <?php if($show_emp_bank_name == "Mabank"){echo 'selected="selected"';} else{} ?>>Maybank</option>
												<option value="CIMB" <?php if($show_emp_bank_name == "CIMB"){echo 'selected="selected"';} else{} ?>>CIMB Bank</option>
												<option value="Public Bank" <?php if($show_emp_bank_name == "Public Bank"){echo 'selected="selected"';} else{} ?>>Public Bank Berhad</option>
												<option value="RHB" <?php if($show_emp_bank_name == "RHB"){echo 'selected="selected"';} else{} ?>>RHB Bank</option>
												<option value="Hong Leong" <?php if($show_emp_bank_name == "Hong Leong"){echo 'selected="selected"';} else{} ?>>Hong Leong Bank</option>
												<option value="AmBank" <?php if($show_emp_bank_name == "AmBank"){echo 'selected="selected"';} else{} ?>>AmBank</option>
												<option value="Bank Rakyat" <?php if($show_emp_bank_name == "Bank Rakyat"){echo 'selected="selected"';} else{} ?>>Bank Rakyat</option>
												<option value="HSBC" <?php if($show_emp_bank_name == "HSBC"){echo 'selected="selected"';} else{} ?>>HSBC Bank Malaysia</option>
												<option value="UOB" <?php if($show_emp_bank_name == "UOB"){echo 'selected="selected"';} else{} ?>>UOB Malaysia Bank</option>
												<option value="OCBC" <?php if($show_emp_bank_name == "OCBC"){echo 'selected="selected"';} else{} ?>>OCBC Bank Malaysia</option>
												<option value="Affin" <?php if($show_emp_bank_name == "Affin"){echo 'selected="selected"';} else{} ?>>Affin Bank	</option>
												<option value="Bank Islam" <?php if($show_emp_bank_name == "Bank Islam"){echo 'selected="selected"';} else{} ?>>Bank Islam Malaysia</option>
												<option value="Standard Chartered" <?php if($show_emp_bank_name == "Standard Chartered"){echo 'selected="selected"';} else{} ?>>Standard Chartered Bank Malaysia</option>
												<option value="CitiBank" <?php if($show_emp_bank_name == "CitiBank"){echo 'selected="selected"';} else{} ?>>CitiBank Malaysia</option>
												<option value="BSN" <?php if($show_emp_bank_name == "BSN"){echo 'selected="selected"';} else{} ?>>Bank Simpanan Nasional (BSN)</option>
												<option value="Alliance" <?php if($show_emp_bank_name == "Alliance"){echo 'selected="selected"';} else{} ?>>Alliance Bank</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_account" class="col-sm-3 control-label"><h6>Bank Account</h6></label>
										<div class="col-sm-9">
											<input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account" value="<?php echo $show_emp_account; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-3"><h6>Health Status</h6></label>
										<div class="col-sm-9">
											<div class="row">
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="resident" name="emp_health_status" value="Resident" <?php if($show_emp_health_status == "Resident"){echo 'checked="checked"';} else{}?>>Resident
													</label>
												</div>
												<div class="col-sm-4">
													<label class="radio-inline">
														<input type="radio" id="self-disabled" name="emp_health_status" value="Self-Disabled" <?php if($show_emp_health_status == "Self-Disabled"){echo 'checked="checked"';} else{}?>>Self-Disabled
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
														<input type="radio" id="single" name="emp_martial_status" value="Single" <?php if($show_emp_martial_status == "Single"){echo 'checked="checked"';} else{} ?>>Single
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="married" name="emp_martial_status" value="Married" <?php if($show_emp_martial_status == "Married"){echo 'checked="checked"';} else{} ?>>Married
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="divorced" name="emp_martial_status" value="Divorced" <?php if($show_emp_martial_status == "Divorced"){echo 'checked="checked"';} else{} ?>>Divorced
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="widow" name="emp_martial_status" value="Widow" <?php if($show_emp_martial_status == "Widow"){echo 'checked="checked"';} else{} ?>>Widow
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
														<input type="radio" id="work" name="emp_spouse_status" value="Work" <?php if($show_emp_spouse_status == "Work"){echo 'checked="checked"';} else{} ?>>Work
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="disabled" name="emp_spouse_status" value="Disabled" <?php if($show_emp_spouse_status == "Disabled"){echo 'checked="checked"';} else{} ?>>Disabled
													</label>
												</div>
												<div class="col-sm-3">
													<label class="radio-inline">
														<input type="radio" id="none" name="emp_spouse_status" value="None" <?php if($show_emp_spouse_status == "None"){echo 'checked="checked"';} else{} ?>>None
													</label>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_epf" class="col-sm-3 control-label"><h6>Employee EPF</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control" value="<?php echo $show_emp_epf; ?>" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_socso" class="col-sm-3 control-label"><h6>Employee SOCSO</h6></label>
										<div class="col-sm-9">
											<input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control" value="<?php echo $show_emp_socso; ?>" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-3"><h6>SOCSO Type</h6></label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_socso_type" name="emp_socso_type">
												<option value="Category 1" <?php if($show_emp_socso_type == "Category 1"){echo 'selected="selected"';} else{} ?>>Category 1</option>
												<option value="Category 2" <?php if($show_emp_socso_type == "Category 2"){echo 'selected="selected"';} else{} ?>>Category 2</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-3"><h6>EIS Eligibility</h6></label>
										<div class="col-sm-9">
											<select class="form-control" id="emp_eis_type" name="emp_eis_type">
												<option value="Yes" <?php if($show_emp_eis_type == "Yes"){echo 'selected="selected"';} else{} ?>>Yes</option>
												<option value="No" <?php if($show_emp_eis_type == "No"){echo 'selected="selected"';} else{} ?>>No</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_join_date" class="col-sm-3 control-label"><h6>Employee Join Date</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_join_date" name="emp_join_date" class="form-control" value="<?php echo $show_emp_join_date; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_confirm_date" class="col-sm-3 control-label"><h6>Employee Start Date</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control" value="<?php echo $show_emp_confirm_date; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_resign_date" class="col-sm-3 control-label"><h6>Employee Resign Date (Optional)</h6></label>
										<div class="col-sm-9">
											<input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control" value="<?php echo $show_emp_resign_date; ?>">
										</div>
									</div>
									
										<div class="row">
											<div class="col-md-6">
												<br>
												<input type="submit" class="btn btn-primary" name="submit_1" id="submit_1" value="Submit"> 
											</div>
										</div>
									
								  </form>
							</div>
                    </div>
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                    		<div class="container">
								<h1>Assign Allowance</h1>
								<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
										<div class="col-sm-9">
												<label for="emp_id">Employee ID</label>
												<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $get_emp_id; ?>" disabled>
											</div>

											<br/>
											
											<div class="col-sm-9">
												<div class="form-group">
												<label for="emp_full_name" class="control-label"><h6>Full Name</h6></label>
												<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>" disabled>
											</div>
										</div>
									
										
											<div class="form-group">
												<div class="container"><label class="sel1 control-label"><h6>Allowance Type</h6></label></div>
												<div class="col-sm-9">
													<select class="form-control" id="select_allowance_desc" name="select_allowance_desc">
														<?php
															$select_all_sql = mysqli_query($conn, "SELECT * FROM allowance");
															while($data = mysqli_fetch_assoc($select_all_sql)){
																//echo $data["name"];
																echo '<option value="' . $data["allowance_desc"] . '">' . $data["allowance_desc"] . '</option>';
															}

															?>
													  </select>
												</div>
											</div>
										
									
									<div class="container"><input type="submit" class="btn btn-primary" name="submit_2" id="submit_2" value="Add Item"> </div>
										
										<br/>
									
										<div class="col-sm-9">
											<table id="example" class="table table-bordered">
												<thead>
													<tr>
														<th>Employee ID</th>
														<th>Allwoance ID</th>
														<th>Allowance Name</th>
														<th>Alowance Rate (RM)</th>
														<th>Edit Rate</th>

													</tr>
												</thead>
												<tbody>
													
											<?php
											//$payroll_sql = "SELECT employee_allowance.emp_id, employee_info.emp_full_name, employee_allowance.allowance_id, employee_allowance.allowance_desc, employee_allowance.allowance_rate FROM employee_allowance INNER JOIN employee_info ON employee_info.emp_id = employee_allowance.emp_id INNER JOIN allowance ON allowance.allowance_id = employee_allowance.allowance_id";
													
											$table_sql = mysqli_query($conn, "SELECT * FROM employee_allowance WHERE emp_id = $get_emp_id");		
											$allowance_total = 0;
											
											if($datarows = mysqli_num_rows($table_sql) > 0){
                    						while($data = mysqli_fetch_assoc($table_sql)){
											echo '<tr>';
											echo '<td>' . $data["emp_id"] . '</td>';
											echo '<td>' . $data["allowance_id"] . '</td>';
											echo '<td>' . $data["allowance_desc"] . '</td>';
											echo '<td>' . $data["allowance_rate"] . '</td>';
											echo "<td>" . '<a href="employee_allowance_edit.php?emp_allowance_id=' . $data["emp_allowance_id"] . '&emp_id=' . $data["emp_id"] . '">Edit</a>' . "</td>";
											echo '</tr>';
												
											$allowance_rate = $data["allowance_rate"];
											$allowance_total = $allowance_total + $allowance_rate;
											
											}}
												
											$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_allowance='$allowance_total' WHERE emp_id ='$get_emp_id'");
											
											?>
												</tbody>
                							</table>
											<div class="container allowance_total"><b>Total: <?php echo $allowance_total?></b></div>
										</div>
										
								</form>
							</div>
                    </div>
                    <div id="profilex" role="tabpanel" aria-labelledby="profilex-tab" class="tab-pane fade px-4 py-5">
                    		<div class="container">
								<h1>Assign Dedcution</h1>
								<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
										<div class="col-sm-9">
												<label for="emp_id">Employee ID</label>
												<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $get_emp_id; ?>" disabled>
											</div>

											<br/>
											
											<div class="col-sm-9">
												<div class="form-group">
												<label for="emp_full_name" class="control-label"><h6>Full Name</h6></label>
												<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>" disabled>
											</div>
										</div>
									
										
											<div class="form-group"><div class="container"><label class="sel1 control-label"><h6>Deduction Type</h6></label></div>
												<div class="col-sm-9">
													<select class="form-control" id="select_deduction_desc" name="select_deduction_desc">
														<?php
															$select_all_sql = mysqli_query($conn, "SELECT * FROM deduction");
															while($data = mysqli_fetch_assoc($select_all_sql)){
																//echo $data["name"];
																echo '<option value="' . $data["deduction_desc"] . '">' . $data["deduction_desc"] . '</option>';
															}

															?>
													  </select>
												</div>
											</div>
										
									
									<div class="container"><input type="submit" class="btn btn-primary" name="submit_3" id="submit_3" value="Add Item"> </div>
										
										<br/>
									
										<div class="col-sm-9">
											<table id="example" class="table table-bordered">
												<thead>
													<tr>
														<th>Employee ID</th>
														<th>Deduction ID</th>
														<th>Deduction Name</th>
														<th>Deduction Rate (RM)</th>
														<th>Edit Rate</th>

													</tr>
												</thead>
												<tbody>
													
											<?php
													
											$table_sql_d = mysqli_query($conn, "SELECT * FROM employee_deduction WHERE emp_id = $get_emp_id");		
											$deduction_total = 0;
											
											if($datarows = mysqli_num_rows($table_sql_d) > 0){
                    						while($data = mysqli_fetch_assoc($table_sql_d)){
											echo '<tr>';
											echo '<td>' . $data["emp_id"] . '</td>';
											echo '<td>' . $data["deduction_id"] . '</td>';
											echo '<td>' . $data["deduction_desc"] . '</td>';
											echo '<td>' . $data["deduction_rate"] . '</td>';
											echo "<td>" . '<a href="employee_deduction_edit.php?emp_deduction_id=' . $data["emp_deduction_id"] . '&emp_id=' . $data["emp_id"] . '">Edit</a>' . "</td>";
											echo '</tr>';
												
											$deduction_rate = $data["deduction_rate"];
											$deduction_total = $deduction_total + $deduction_rate;
											
											}}
												
											$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_deduction='$deduction_total' WHERE emp_id ='$get_emp_id'");
											
											?>
												</tbody>
                							</table>
											<div class="container deduction_total"><b>Total: <?php echo $deduction_total?></b></div>
										</div>
										
								</form>
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
