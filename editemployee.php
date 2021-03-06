<?php
	session_start();
	include "conn.php";
	if(empty($_SESSION["username"])){
	header("location:index.php");
	}
	$username = $_SESSION["username"];
	$get_emp_id = $_GET["emp_id"];
	$allow_button = FALSE;
	$a_count = 0;
	$deduct_button = FALSE;
	$d_count = 0;

	//Count exisiting allowance item
	$select_allowance = mysqli_query($conn, "SELECT * FROM allowance"); 
	while($data = mysqli_fetch_assoc($select_allowance)) {
		$a_count = $a_count+1;
	}
	
	//If there is existing allowance item, then add button for allowance is clickable
	if ($a_count>0){
		$allow_button = TRUE;
	}

	//Count exisiting deduction item
	$select_deduction = mysqli_query($conn, "SELECT * FROM deduction"); 
	while($data = mysqli_fetch_assoc($select_deduction)) {
		$d_count = $d_count+1;
	}
	
	//If there is existing deduction item, then add button for deduction is clickable
	if ($d_count>0){
		$deduct_button = TRUE;
	}
?>

<?php
	//Set empty string for storing messages
	$error = FALSE;
	$error_id ='';
	$error_name ='';
	$error_email ='';
	$error_address ='';
	$error_mobile ='';
	$error_ic ='';
	$error_title ='';
	$error_wages ='';
	$error_account ='';
	$error_epf ='';
	$error_socso ='';
	$message='';
	$count =0;

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_1"])){

			if(empty($_POST["emp_display_id"])){
				$error_id = '<span class="text-danger"> *Invalid Employee ID</span>'; //If display id field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_display_id = $_POST["emp_display_id"];
			}

			$select_sql = mysqli_query($conn, "SELECT * FROM employee_info"); 
				while($data = mysqli_fetch_assoc($select_sql)){
				if ($emp_display_id == $data["emp_display_id"] && $get_emp_id != $data["emp_id"])
				{
				$message = '<label class="text-danger">Error: ID already exist.</label>'; //If display id field existed in database reutrn Invalid message and error boolean is TRUE
				$count = $count+1;
					$error = TRUE;
				}
				}

			if(empty($_POST["emp_full_name"])){
				$error_name = '<span class="text-danger"> *Invalid Employee Name</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_full_name = $_POST["emp_full_name"];
			}

			if(empty($_POST["emp_email"])){
				$error_email = '<span class="text-danger"> *Invalid Employee Email</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_email = $_POST["emp_email"];
			}

			if(empty($_POST["emp_address"])){
				$error_address = '<span class="text-danger"> *Invalid Employee Address</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_address = $_POST["emp_address"];
			}

			if(empty($_POST["emp_mobile"])){
				$error_mobile = '<span class="text-danger"> *Invalid Employee Mobile</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_mobile = $_POST["emp_mobile"];
			}


			if(empty($_POST["emp_ic"])){
				$error_ic = '<span class="text-danger"> *Invalid Employee IC</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_ic = $_POST["emp_ic"];
			}

			if(empty($_POST["emp_title"])){
				$error_title = '<span class="text-danger"> *Invalid Employee Job Title</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_title = $_POST["emp_title"];
			}

			if(empty($_POST["emp_wages"])){
				$error_wages = '<span class="text-danger"> *Invalid Employee Wages</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_wages = $_POST["emp_wages"];
			}

			if(empty($_POST["emp_account"])){
				$error_account = '<span class="text-danger"> *Invalid Employee Bank Account</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_account = $_POST["emp_account"];
			}

			if(empty($_POST["emp_epf"])){
				$error_epf = '<span class="text-danger"> *Invalid Employee EPF No.</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_epf = $_POST["emp_epf"];
			}

			if(empty($_POST["emp_socso"])){
				$error_socso = '<span class="text-danger"> *Invalid Employee SOCSO No.</span>'; //If field is empty reutrn Invalid message and error boolean is TRUE
				$error = TRUE;
			}else{
				$emp_socso = $_POST["emp_socso"];
			}

			$emp_gender = $_POST["emp_gender"];
			$emp_dob = $_POST["emp_dob"];
			$emp_telephone = $_POST["emp_telephone"];
			$emp_passport = $_POST["emp_passport"];
			$emp_immigration = $_POST["emp_immigration"];
			$emp_payment_method = $_POST["emp_payment_method"];	
			$emp_bank_name = $_POST["emp_bank_name"];
			$emp_health_status = $_POST["emp_health_status"];
			$emp_martial_status = $_POST["emp_martial_status"];
			$emp_spouse_status = $_POST["emp_spouse_status"];
			$emp_socso_type = $_POST["emp_socso_type"];
			$emp_eis_type = $_POST["emp_eis_type"];
			$emp_join_date = $_POST["emp_join_date"];
			$emp_confirm_date = $_POST["emp_confirm_date"];
			$emp_resign_date = $_POST["emp_resign_date"];
			$data_edited_date = date("Y/m/d");

	//If all required fields are valid and error boolean is FALSE, update edited employee info
	if ($error == FALSE && $count==0){
		$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_display_id='$emp_display_id', emp_full_name='$emp_full_name', emp_gender='$emp_gender', emp_dob='$emp_dob', emp_email='$emp_email', emp_address='$emp_address', emp_mobile='$emp_mobile', emp_telephone='$emp_telephone', emp_ic='$emp_ic', emp_passport='$emp_passport', emp_immigration='$emp_immigration', emp_title='$emp_title', emp_wages='$emp_wages', emp_payment_method='$emp_payment_method', emp_bank_name='$emp_bank_name', emp_account='$emp_account', emp_health_status='$emp_health_status', emp_martial_status='$emp_martial_status', emp_spouse_status='$emp_spouse_status', emp_epf='$emp_epf', emp_socso='$emp_socso', emp_socso_type='$emp_socso_type', emp_eis_type='$emp_eis_type', emp_join_date='$emp_join_date', emp_confirm_date='$emp_confirm_date', emp_resign_date='$emp_resign_date', data_edited_date='$data_edited_date' WHERE emp_id ='$get_emp_id'");
	}
	echo "<script>alert('Updated Successfully!');document.location='maintainemployee.php'</script>";    
	}

	//submit_2
	if(isset($_POST["submit_2"])){
		$emp_allowance_desc = $_POST["select_allowance_desc"];
		$emp_id = $get_emp_id;

		//Select exising allowance data to be displayed in option
		$select_employee_allowance = "SELECT * FROM allowance WHERE allowance_desc = '$emp_allowance_desc'";
		$prepared_stmt_insert = mysqli_prepare($conn, $select_employee_allowance);
		mysqli_stmt_execute($prepared_stmt_insert);
		$result = $prepared_stmt_insert->get_result(); 
		$data = $data = $result->fetch_assoc();

		$allowance_id = $data["allowance_id"]; //Get allowance ID
		$allowance_desc = $data["allowance_desc"]; //Get allowance description
		$allowance_rate = $data["allowance_rate"]; //Get allowance rate

		//Insert data to employee allwoance after submit
		$new_employee_allowance = "INSERT INTO employee_allowance (emp_id, allowance_id, allowance_desc, allowance_rate) VALUES (?,?,?,?)";
		$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_allowance);
		mysqli_stmt_bind_param($prepared_stmt_insert, 'ssss', $emp_id, $allowance_id, $allowance_desc, $allowance_rate);
		mysqli_stmt_execute($prepared_stmt_insert);
		mysqli_stmt_close($prepared_stmt_insert);

		echo "<script>alert('Added Successfully!');document.location='maintainemployee.php'</script>";
	}
	//submit_3
	if(isset($_POST["submit_3"])){
		$emp_deduction_desc = $_POST["select_deduction_desc"];
		$emp_id = $get_emp_id;

		//Select exising deducyion data to be displayed in option
		$select_employee_deduction = "SELECT * FROM deduction WHERE deduction_desc = '$emp_deduction_desc'";
		$prepared_stmt_insert = mysqli_prepare($conn, $select_employee_deduction);
		mysqli_stmt_execute($prepared_stmt_insert);
		$result = $prepared_stmt_insert->get_result(); 
		$data = $data = $result->fetch_assoc();

		$deduction_id = $data["deduction_id"]; //Get deduction ID
		$deduction_desc = $data["deduction_desc"]; //Get deduction description
		$deduction_rate = $data["deduction_rate"]; //Get deduction rate

		//Insert data to employee deduction after submit
		$new_employee_deduction = "INSERT INTO employee_deduction (emp_id, deduction_id, deduction_desc, deduction_rate) VALUES (?,?,?,?)";
		$prepared_stmt_insert = mysqli_prepare($conn, $new_employee_deduction);
		mysqli_stmt_bind_param($prepared_stmt_insert, 'ssss', $emp_id, $deduction_id, $deduction_desc, $deduction_rate);
		mysqli_stmt_execute($prepared_stmt_insert);
		mysqli_stmt_close($prepared_stmt_insert);
		echo "<script>alert('Added Successfully!');document.location='maintainemployee.php'</script>";
	}

	//show all existing value in all input fields
	$show_sql = mysqli_query($conn, "SELECT * FROM employee_info WHERE emp_id = '$get_emp_id'");
	$show_data = mysqli_fetch_assoc($show_sql);
	$show_emp_display_id = $show_data['emp_display_id'];
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
<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Edit Employee</title>
<?php include "all_css.php"; ?>
</head>
	
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
	<div id="page-content-wrapper">
	<?php include "navbar.php"; ?>
		<div class="container-fluid">
		<h1 class="mt-4"><a href="maintainemployee.php" class="btn btn-primary">Back</a> Edit Employee</h1>
		<hr>
			<div class="p-3 bg-white rounded shadow mb-5">
			<ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-md-row text-center bg-light border-0 rounded-nav">
			<li class="nav-item flex-md-fill">
			<a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Edit Employee Info</a>
			</li>
			<li class="nav-item flex-md-fill">
			<a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Edit Employee Allowance</a>
			</li>
			<li class="nav-item flex-md-fill">
			<a id="profilex-tab" data-toggle="tab" href="#profilex" role="tab" aria-controls="profilex" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Edit Employee Deduction</a>
			</li>
			</ul>
				<div id="myTabContent" class="tab-content">
					<div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-1 py-3 show active">
						<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
							<div class="row">
								<div class="col-md-6">
								<p><b>Employee Main Profile</b></p>
									<div class="form-group">
									<label>Employee Display ID <?php echo $message; echo $error_id;?></label>
										<div class="input-group-prepend"> 
										<input type="text" id="emp_display_id" name="emp_display_id" class="form-control" value="<?php echo $show_emp_display_id; ?>">
										</div>
									</div>
									<div class="form-group">
										<label>Full Name <?php echo $error_name;?></label>
										<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>">
									</div>
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control" id="emp_gender" name="emp_gender">
											<option value="Male" <?php if($show_emp_gender == "Male"){echo 'selected="selected"';} else{} ?>>Male</option>
											<option value="Female" <?php if($show_emp_gender == "Female"){echo 'selected="selected"';} else{} ?>>Female</option>
										</select>
									</div>
									<div class="form-group">
										<label>Date of Birth (DoB)</label>
										<input type="date" id="emp_dob" class="form-control" name="emp_dob" value="<?php echo $show_emp_dob; ?>">
									</div>
									<div class="form-group">
										<label>Email <?php echo $error_email;?></label>
										<input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email" value="<?php echo $show_emp_email; ?>">
									</div>
									<div class="form-group">
										<label>Address <?php echo $error_address;?></label>
										<input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address" value="<?php echo $show_emp_address; ?>">
									</div>
									<div class="form-group">
										<label>Phone number <?php echo $error_mobile;?></label>
										<input type="tel" id="emp_mobile" placeholder="Phone" class="form-control" name="emp_mobile" value="<?php echo $show_emp_mobile; ?>">
									</div>
									<div class="form-group">
										<label>Telephone number</label>
										<input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone" value="<?php echo $show_emp_telephone; ?>">
									</div>
									<div class="form-group">
										<label>Employee IC No. <?php echo $error_ic;?></label>
										<input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic" value="<?php echo $show_emp_ic; ?>">
									</div>
									<div class="form-group">
										<label>Passport Number (Optional)</label>
										<input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport" value="<?php echo $show_emp_passport; ?>">
									</div>
									<div class="form-group">
										<label>Immigration Number (Optional)</label>
										<input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control" value="<?php echo $show_emp_immigration; ?>">
									</div>
									<div class="form-group">
										<label>Job Title <?php echo $error_title;?></label>
										<input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control" value="<?php echo $show_emp_title; ?>">
									</div>
									<div class="form-group">
										<label>Employee Join Date</label>
										<input type="date" id="emp_join_date" name="emp_join_date" class="form-control" value="<?php echo $show_emp_join_date; ?>">
									</div>
									<div class="form-group">
										<label>Employee Start Date</label>
										<input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control" value="<?php echo $show_emp_confirm_date; ?>">
									</div>
								</div>
								<br/>
								<hr/>
								<div class="col-md-6">
								<p><b>Employee Payroll Details</b></p>
									<div class="form-group">
									<label>Wages <?php echo $error_wages;?></label>
									<input type="text" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control" value="<?php echo $show_emp_wages; ?>">
									</div>
									<div class="form-group">
										<label>Payment Method</label>
										<select class="form-control" id="emp_payment_method" name="emp_payment_method">
											<option value="Bank-In" <?php if($show_emp_payment_method == "Bank-In"){echo 'selected="selected"';} else{} ?>>Bank-In</option>
											<option value="Cash" <?php if($show_emp_payment_method == "Cash"){echo 'selected="selected"';} else{} ?>>Cash</option>
											<option value="Cheque" <?php if($show_emp_payment_method == "Cheque"){echo 'selected="selected"';} else{} ?>>Cheque</option>
										</select>
									</div>
								<div class="form-group">
									<label>Bank Name</label>
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
								<div class="form-group">
									<label>Bank Account <?php echo $error_account;?></label>
									<input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account" value="<?php echo $show_emp_account; ?>">
								</div>
								<div class="form-group">
									<label>Health Status</label>
										<select class="form-control" id="emp_health_status" name="emp_health_status">
											<option value="Resident" <?php if($show_emp_health_status == "Resident"){echo 'selected="selected"';} else{} ?>>Resident</option>
											<option value="Self-Disabled" <?php if($show_emp_health_status == "Self-Disabled"){echo 'selected="selected"';} else{} ?>>Self-Disabled</option>
										</select>
								</div>
								<div class="form-group">
									<label>Martial Status</label>
									<select class="form-control" id="emp_martial_status" name="emp_martial_status">
										<option value="Single" <?php if($show_emp_martial_status == "Single"){echo 'selected="selected"';} else{} ?>>Single</option>
										<option value="Married" <?php if($show_emp_martial_status == "Married"){echo 'selected="selected"';} else{} ?>>Married</option>
										<option value="Divorced" <?php if($show_emp_martial_status == "Divorced"){echo 'selected="selected"';} else{} ?>>Divorced</option>
										<option value="Widow" <?php if($show_emp_martial_status == "Widow"){echo 'selected="selected"';} else{} ?>>Widow</option>
									</select>
								</div>
								<div class="form-group">
									<label>Spouse Status</label>
									<select class="form-control" id="emp_spouse_status" name="emp_spouse_status">
										<option value="Work" <?php if($show_emp_spouse_status == "Work"){echo 'selected="selected"';} else{} ?>>Work</option>
										<option value="Disabled" <?php if($show_emp_spouse_status == "Disabled"){echo 'selected="selected"';} else{} ?>>Disabled</option>
										<option value="None" <?php if($show_emp_spouse_status == "None"){echo 'selected="selected"';} else{} ?>>None</option>
									</select>
								</div>
								<div class="form-group">
									<label>Employee EPF <?php echo $error_epf;?></label>
									<input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control" value="<?php echo $show_emp_epf; ?>">
								</div>
								<div class="form-group">
									<label>Employee SOCSO <?php echo $error_socso;?></label>
									<input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control" value="<?php echo $show_emp_socso; ?>">
								</div>
								<div class="form-group">
									<label>SOCSO Type</label>
									<select class="form-control" id="emp_socso_type" name="emp_socso_type">
										<option value="Category 1" <?php if($show_emp_socso_type == "Category 1"){echo 'selected="selected"';} else{} ?>>Category 1</option>
										<option value="Category 2" <?php if($show_emp_socso_type == "Category 2"){echo 'selected="selected"';} else{} ?>>Category 2</option>
									</select>
								</div>
								<div class="form-group">
									<label>EIS Eligibility</label>
									<select class="form-control" id="emp_eis_type" name="emp_eis_type">
										<option value="Yes" <?php if($show_emp_eis_type == "Yes"){echo 'selected="selected"';} else{} ?>>Yes</option>
										<option value="No" <?php if($show_emp_eis_type == "No"){echo 'selected="selected"';} else{} ?>>No</option>
									</select>
								</div>
								<div class="form-group">
									<label>Employee Resign Date (Optional)</label>
									<input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control" value="<?php echo $show_emp_resign_date; ?>">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block p-2" name="submit_1" id="submit_1">Update</button>
								</div>
								</div>
							</div>		
						</form>
					</div>
					<div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">
					<p><b>Assign Allowance</b></p>
					<hr>
					<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="emp_id">Employee ID</label>
									<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $show_emp_display_id; ?>" disabled>
								</div>
							</div>                             
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Full Name</label>
									<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>" disabled>
								</div>
							</div>                  
						</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<label>Allowance Type</label>
								<select class="form-control" id="select_allowance_desc" name="select_allowance_desc">
								<?php
									$select_all_sql = mysqli_query($conn, "SELECT * FROM allowance");
									while($data = mysqli_fetch_assoc($select_all_sql)){
									echo '<option value="' . $data["allowance_desc"] . '">' . $data["allowance_desc"] . '</option>';
								}
								?>
								</select>
							</div>        
						</div>    
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" class="btn btn-primary" name="submit_2" id="submit_2" value="Add Item" <?php if($allow_button==FALSE) {echo "disabled";} ?> >
						</div>    
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
											<th>Allowance Name</th>
											<th>Alowance Rate (RM)</th>
											<th>Edit Rate</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
											//Selelct all employee allowance for display
											$table_sql = mysqli_query($conn, "SELECT * FROM employee_allowance WHERE emp_id = $get_emp_id");
										
											$allowance_total = 0;
										
											if($datarows = mysqli_num_rows($table_sql) > 0){
												while($data = mysqli_fetch_assoc($table_sql)){
													echo '<tr>';
													echo '<td>' . $data["allowance_desc"] . '</td>';
													echo '<td>' . $data["allowance_rate"] . '</td>';
													echo "<td>" . '<a class="btn btn-primary" href="employee_allowance_edit.php?emp_allowance_id=' . $data["emp_allowance_id"] . '&emp_id=' . $data["emp_id"] . '">Edit Allownace</a>' . "</td>";
													echo "<td>" . '<a class="btn btn-danger" onclick="return confirm(\'Confirm Delete?\');" href="deleteEmployeeAllowance.php?id=' . $data["emp_allowance_id"] . '&emp_id=' . $data["emp_id"] . '">Delete Allownace</a>' . "</td>";
													echo '</tr>';
													$allowance_rate = $data["allowance_rate"];
													$allowance_total = $allowance_total + $allowance_rate;
												}
											}
											//Update the allowance data to employee_info
											$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_allowance='$allowance_total' WHERE emp_id ='$get_emp_id'");
										?>
									</tbody>
								</table>
							<p><b>Total Allowance: <?php echo $allowance_total?></b></p>
							</div>
						</div>
					</div>
					</form>
					</div>
					<div id="profilex" role="tabpanel" aria-labelledby="profilex-tab" class="tab-pane fade px-1 py-3">
						<p><b>Assign Deduction</b></p>
						<hr>
						<form action="editemployee.php?emp_id=<?php echo "$get_emp_id"; ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="emp_id">Employee ID</label>
										<input type="text" class="form-control" name="emp_id" id="emp_id" value="<?php echo $show_emp_display_id; ?>" disabled>
									</div>
								</div>            
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control" value="<?php echo $show_emp_full_name; ?>" disabled>
									</div>
								</div>
							</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								<label>Deduction Type</label>
									<select class="form-control" id="select_deduction_desc" name="select_deduction_desc">
									<?php
										$select_all_sql = mysqli_query($conn, "SELECT * FROM deduction");
										while($data = mysqli_fetch_assoc($select_all_sql)){
										echo '<option value="' . $data["deduction_desc"] . '">' . $data["deduction_desc"] . '</option>';
									}
									?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary" name="submit_3" id="submit_3" value="Add Item" <?php if($deduct_button==FALSE) {echo "disabled";} ?> >
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered" width="100%">
										<thead>
											<tr>
												<th>Deduction Name</th>
												<th>Deduction Rate (RM)</th>
												<th>Edit Rate</th>
												<th>Delete</th>
											</tr>
										</thead>
										<tbody>
										<?php
											//Selelct all employee deductionn for display
											$table_sql_d = mysqli_query($conn, "SELECT * FROM employee_deduction WHERE emp_id = $get_emp_id");		

											$deduction_total = 0;

											if($datarows = mysqli_num_rows($table_sql_d) > 0){
												while($data = mysqli_fetch_assoc($table_sql_d)){
													echo '<tr>';
													echo '<td>' . $data["deduction_desc"] . '</td>';
													echo '<td>' . $data["deduction_rate"] . '</td>';
													echo "<td>" . '<a class="btn btn-primary" href="employee_deduction_edit.php?emp_deduction_id=' . $data["emp_deduction_id"] . '&emp_id=' . $data["emp_id"] . '">Edit Deduction</a>' . "</td>";
													echo "<td>" . '<a class="btn btn-danger" onclick="return confirm(\'Confirm Delete?\');" href="deleteEmployeeDeduction.php?id=' . $data["emp_deduction_id"] . '&emp_id=' . $data["emp_id"] . '">Delete Deduction</a>' . "</td>";
													echo '</tr>';
													$deduction_rate = $data["deduction_rate"];
													$deduction_total = $deduction_total + $deduction_rate;
												}
											}
											//Update the deduction data to employee_info
											$update_sql = mysqli_query($conn, "UPDATE employee_info SET emp_total_deduction='$deduction_total' WHERE emp_id ='$get_emp_id'");
										?>
										</tbody>
									</table>
									<p><b>Total: <?php echo $deduction_total?></b></p>
								</div>
							</div>
						</div>
						</form>
					</div>                    
				</div>
			</div>
		</div>
	</div>
</div>	
	
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
<script>
	$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
	});
</script>
</body>
	
</html>