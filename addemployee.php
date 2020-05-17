<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];
?>

<?php
$message='';
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

    mysqli_stmt_bind_param($prepared_stmt_insert, 'sssssssssssssssssssssssssss', $combined, $emp_full_name, $emp_gender, $emp_dob, $emp_email, $emp_address, $emp_mobile, $emp_telephone, $emp_ic, $emp_passport, $emp_immigration, $emp_title, $emp_wages, $emp_payment_method, $emp_bank_name, $emp_account, $emp_health_status, $emp_martial_status, $emp_spouse_status, $emp_epf, $emp_socso, $emp_socso_type, $emp_eis_type, $emp_join_date, $emp_confirm_date, $emp_resign_date, $data_created_date);

    mysqli_stmt_execute($prepared_stmt_insert);
    mysqli_stmt_close($prepared_stmt_insert);

    $update_sql = mysqli_query($conn, "UPDATE employee_id_count SET emp_id_count='$emp_display_id'");	

    }

}

$show_sql = mysqli_query($conn, "SELECT * FROM employee_id_count");
$show_data = mysqli_fetch_assoc($show_sql);
$show_emp_id_count = $show_data['emp_id_count'] + 1;

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
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                        <form class="form-horizontal" role="form" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>Employee Profile Info</b></p>
                                <hr>
                                <div class="form-group">
                                    <label for="emp_display_id">Employee Display ID <?php echo $message; ?></label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E</span>  
                                        <input type="number" id="emp_display_id" name="emp_display_id" class="form-control" min="1000" max="9999" value="<?php echo $show_emp_id_count; ?>">
                                    </div>
                                </div>        
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" id="emp_full_name" name="emp_full_name" placeholder="Full Name" class="form-control">
                                </div>
                                <div class="form-group">
                                <label>Gender</label>
                                    <select class="form-control" id="emp_gender" name="emp_gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" id="emp_dob" class="form-control" name="emp_dob" value="<?php echo date('Y-m-t'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="emp_email" placeholder="Email" class="form-control" name= "emp_email">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="address" id="emp_address" placeholder="Address" class="form-control" name="emp_address">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="tel" id="emp_mobile" placeholder="Phone" class="form-control" name="emp_mobile">
                                </div>
                                <div class="form-group">
                                    <label>Telephone Number</label>
                                    <input type="tel" id="emp_telephone" placeholder="Telephone" class="form-control" name="emp_telephone">
                                </div>
                                <div class="form-group">
                                    <label>Employee IC No.</label>
                                    <input type="ic" id="emp_ic" placeholder="IC/ID" class="form-control" name="emp_ic">
                                </div>
                                <div class="form-group">
                                    <label>Passport Number (Optional)</label>
                                    <input type="passport" id="emp_passport" placeholder="Passport Number" class="form-control" name="emp_passport">
                                </div>
                                <div class="form-group">
                                    <label>Immigration Number (Optional)</label>
                                    <input type="immigration" id="emp_immigration" name="emp_immigration" placeholder="Immigration Number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input type="text" id="emp_title" name="emp_title" placeholder="Job title description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Employee Join Date</label>
                                    <input type="date" id="emp_join_date" name="emp_join_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Employee Start Date</label>
                                    <input type="date" id="emp_confirm_date" name="emp_confirm_date" class="form-control" value="<?php echo date('Y-m-t'); ?>">
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6"><!-- right side -->
                                <p><b>Payroll Details</b></p>
                                <hr>
                                <div class="form-group">
                                    <label>Wages</label>
                                    <input type="text" id="emp_wages" name="emp_wages" placeholder="Employee Wages" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select class="form-control" id="emp_payment_method" name="emp_payment_method">
                                        <option value="Bank_In">Bank_In</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name</label>
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
                                <div class="form-group">
                                    <label>Bank Account</label>
                                    <input type="text" id="emp_account" placeholder="Bank Account Number" class="form-control" name= "emp_account">
                                </div>
                                <div class="form-group">
                                    <label>Health Status</label>
                                    <select class="form-control" id="emp_health_status" name="emp_health_status">
                                        <option value="Resident">Resident</option>
                                        <option value="Self-Disabled">Self-Disabled</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Martial Status</label>
                                    <select class="form-control" id="emp_martial_status" name="emp_martial_status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widow">Widow</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Spouse Status</label>
                                    <select class="form-control" id="emp_spouse_status" name="emp_spouse_status">
                                        <option value="Work">Work</option>
                                        <option value="Disabled">Disabled</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Employee EPF</label>
                                    <input type="number" id="emp_epf" name="emp_epf" placeholder="Employee EPF Number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Employee SOCSO</label>
                                    <input type="number" id="emp_socso" name="emp_socso" placeholder="Employee SOCSO Number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>SOCSO Type</label>
                                    <select class="form-control" id="emp_socso_type" name="emp_socso_type">
                                        <option value="Category 1">Category 1</option>
                                        <option value="Category 2">Category 2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>EIS Eligibility</label>
                                    <select class="form-control" id="emp_eis_type" name="emp_eis_type">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Employee Resign Date (Optional)</label>
                                    <input type="date" id="emp_resign_date" name="emp_resign_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block p-2" name="register">Register</button>
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