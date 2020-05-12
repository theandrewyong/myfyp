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
<section class="container py-4 col-sm-12">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white shadow mb-5">
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
						<?php
							$message='';
						$format_emp_wages=0;
							$count =0;
							if(isset($_POST["register"])){

							$emp_display_id = $_POST["emp_display_id"];
							$combined = "E" . $emp_display_id;
								
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
							//---------------------------------------------------
							$emp_wages = $_POST["emp_wages"];
							$format_emp_wages = number_format("$emp_wages",2);	
							
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
							$emp_resign_date = $_POST["emp_resign_date"];
							$data_created_date = date("Y/m/d");
								
							$select_sql = mysqli_query($conn, "SELECT * FROM employee_info"); 
							while($data = mysqli_fetch_assoc($select_sql)){
								if ($combined == $data["emp_display_id"])
								{
									$message = '<label class="text-danger">Error: ID already exist.</label>';
									$count = $count+1;
								}
							}
							
							if ($count==0){
								$new_employee_sql = "INSERT INTO employee_info (emp_display_id, emp_full_name, emp_gender, emp_dob, emp_email, emp_address, emp_mobile, emp_telephone, emp_ic, emp_passport, emp_immigration, emp_title, emp_wages, emp_payment_method, emp_bank_name, emp_account, emp_health_status, emp_martial_status, emp_spouse_status, emp_epf, emp_socso, emp_socso_type, emp_eis_type, emp_join_date, emp_confirm_date, emp_resign_date, data_created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

								$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_sql);

								mysqli_stmt_bind_param($prepared_stmt_insert, 'sssssssssssssssssssssssssss', $combined, $emp_full_name, $emp_gender, $emp_dob, $emp_email, $emp_address, $emp_mobile, $emp_telephone, $emp_ic, $emp_passport, $emp_immigration, $emp_title, $format_emp_wages, $emp_payment_method, $emp_bank_name, $emp_account, $emp_health_status, $emp_martial_status, $emp_spouse_status, $emp_epf, $emp_socso, $emp_socso_type, $emp_eis_type, $emp_join_date, $emp_confirm_date, $emp_resign_date, $data_created_date);

								mysqli_stmt_execute($prepared_stmt_insert);
								mysqli_stmt_close($prepared_stmt_insert);

								$update_sql = mysqli_query($conn, "UPDATE employee_id_count SET emp_id_count='$emp_display_id'");	
								
								//header("Location: maintainemployee.php");
							}
 
							}
						
						$show_sql = mysqli_query($conn, "SELECT * FROM employee_id_count");
						$show_data = mysqli_fetch_assoc($show_sql);
						$show_emp_id_count = $show_data['emp_id_count'] + 1;
						
							?>
						
								<form class="form-horizontal" role="form" method="post">
<div class="row"><div class="col-sm-6"><!--left-------------------------------->
									<a id="employee_section"><h1>Employee Main Profile</h1></a> 
									<br> <?php echo $format_emp_wages; ?>
	
									<div class="form-group">
										<label for="emp_display_id" class="col-sm-12 control-label"><h5 class="pt-2">Employee Display ID <?php echo $message; ?></h5></label>
										<div class="col-sm-11">
											<div class="input-group-prepend">
												<span class="input-group-text">E</span>  
												<input type="number" id="emp_display_id" name="emp_display_id" class="form-control" min="1000" max="9999" value="<?php echo $show_emp_id_count; ?>" autofocus>
											</div>
										</div>
									</div>
	
									<div class="form-group">
										<label for="emp_full_name" class="col-sm-12 control-label"><h5 class="pt-2">Full Name</h5></label>
										<div class="col-sm-11">
											<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" autofocus>
										</div>
									</div>
	
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Gender</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_gender" name="emp_gender">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_dob" class="col-sm-12 control-label"><h5 class="pt-2">Date of Birth</h5></label>
										<div class="col-sm-11">
											<input type="date" id="emp_dob" class="form-control" name="emp_dob" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_email" class="col-sm-12 control-label"><h5 class="pt-2">Email</h5></label>
										<div class="col-sm-11">
											<input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_address" class="col-sm-12 control-label"><h5 class="pt-2">Address</h5></label>
										<div class="col-sm-11">
											<input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_mobile" class="col-sm-12 control-label"><h5 class="pt-2">Phone number</h5></label>
										<div class="col-sm-11">
											<input type="tel" id="emp_mobile" placeholder="Phone" class="form-control" name="emp_mobile">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_telephone" class="col-sm-12 control-label"><h5 class="pt-2">Telephone number</h5></label>
										<div class="col-sm-11">
											<input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_ic" class="col-sm-12 control-label"><h5 class="pt-2">IC</h5></label>
										<div class="col-sm-11">
											<input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_passport" class="col-sm-12 control-label"><h5 class="pt-2">Passport Number (Optional)</h5></label>
										<div class="col-sm-11">
											<input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_immigration" class="col-sm-12 control-label"><h5 class="pt-2">Immigration Number (Optional)</h5> </label>
										<div class="col-sm-11">
											<input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_title" class="col-sm-12 control-label"><h5 class="pt-2">Job Title</h5></label>
										<div class="col-sm-11">
											<input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control">
										</div>
									</div>
	
									<div class="form-group">
										<label for="emp_join_date" class="col-sm-12 control-label"><h5 class="pt-2">Employee Join Date</h5></label>
										<div class="col-sm-11">
											<input type="date" id="emp_join_date" name="emp_join_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_confirm_date" class="col-sm-12 control-label"><h5 class="pt-2">Employee Start Date</h5></label>
										<div class="col-sm-11">
											<input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
										</div>
									</div>
							</div><!--left--------------------------------------------------->
									<br/>
									<hr/>
<div class="col-sm-6"><!--right--------------------------------------------------->
									<a id="payroll_section"><h1>Payroll Details</h1></a>
									<br>
									<div class="form-group">
										<label for="emp_wages" class="col-sm-12 control-label"><h5 class="pt-2">Wages</h5></label>
										<div class="col-sm-11">
											<input type="number" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control" autofocus>
										</div>
									</div>
	
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Payment Method</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_payment_method" name="emp_payment_method">
												<option value="Bank_In">Bank_In</option>
												<option value="Cash">Cash</option>
												<option value="Cheque">Cheque</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Bank Name</h5></label>
										<div class="col-sm-11">
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
										<label for="emp_account" class="col-sm-12 control-label"><h5 class="pt-2">Bank Account</h5></label>
										<div class="col-sm-11">
											<input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account">
										</div>
									</div>
	
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Health Status</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_health_status" name="emp_health_status">
												<option value="Resident">Resident</option>
												<option value="Self-Disabled">Self-Disabled</option>
											</select>
										</div>
									</div>
	
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Martial Status</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_martial_status" name="emp_martial_status">
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Divorced">Divorced</option>
												<option value="Widow">Widow</option>
											</select>
										</div>
									</div>
	
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">Spouse Status</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_spouse_status" name="emp_spouse_status">
												<option value="Work">Work</option>
												<option value="Disabled">Disabled</option>
												<option value="None">None</option>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_epf" class="col-sm-12 control-label"><h5 class="pt-2">Employee EPF</h5></label>
										<div class="col-sm-11">
											<input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_socso" class="col-sm-12 control-label"><h5 class="pt-2">Employee SOCSO</h5></label>
										<div class="col-sm-11">
											<input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control" autofocus>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">SOCSO Type</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_socso_type" name="emp_socso_type">
												<option value="Category 1">Category 1</option>
												<option value="Category 2">Category 2</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="sel1 control-label col-sm-12"><h5 class="pt-2">EIS Eligibility</h5></label>
										<div class="col-sm-11">
											<select class="form-control" id="emp_eis_type" name="emp_eis_type">
												<option value="Yes">Yes</option>
												<option value="No">No</option>
											  </select>
										</div>
									</div>
									
									<div class="form-group">
										<label for="emp_resign_date" class="col-sm-12 control-label"><h5 class="pt-2">Employee Resign Date (Optional)</h5></label>
										<div class="col-sm-11">
											<input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-11 pt-5"><button type="submit" class="btn btn-primary btn-block p-2" name="register">Register</button></div>
									</div>
							</div></div><!--right-------------------------------------------->

									
								</form> <!-- /form -->
                    </div>
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                        
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
