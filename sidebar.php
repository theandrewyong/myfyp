<?php 
//Get current page url name
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
//Declare variables
$maintain_employee = FALSE;
$dashboard = FALSE;
$new_payroll = FALSE;
$new_adhoc = FALSE;
$history = FALSE;
$reports = FALSE;
$view = FALSE;
$admin_panel = FALSE;
$tools = FALSE;
//If current page is true, set to true
if($curPageName == 'dashboard.php'){
    $dashboard = TRUE;
}
if($curPageName == 'maintainemployee.php' || $curPageName == 'addemployee.php' || $curPageName == 'editemployee.php' || $curPageName == 'editallowance.php' || $curPageName == 'editdeduction.php' || $curPageName == 'employee_allowance_edit.php' || $curPageName == 'employee_deduction_edit.php'){
    $maintain_employee = TRUE;
}
if($curPageName == 'newpayroll.php'){
    $new_payroll = TRUE;
}
if($curPageName == 'newadhoc.php' || $curPageName == 'addpendingadhoc.php' || $curPageName == 'editadhocpending.php'){
    $new_adhoc = TRUE;
}
if($curPageName == 'historypayroll.php' || $curPageName == 'historydetails.php' || $curPageName == 'edithistory.php' || $curPageName == 'historyadhoc.php' || $curPageName == 'editadhochistory.php'){
    $history = TRUE;
}
if($curPageName == 'reports.php' || $curPageName == 'payslip_report.php' || $curPageName == 'adhoc_report.php' || $curPageName == 'epf_report.php' || $curPageName == 'socso_report.php' || $curPageName == 'eis_report.php' || $curPageName == 'payroll_summary_report.php' || $curPageName == 'yearly_wages_report.php' || $curPageName == 'yearly_individual_report.php'){
    $reports = TRUE;
}
if($curPageName == 'view.php'){
    $view = TRUE;
}
if($curPageName == 'adminpanel.php' || $curPageName == 'editadmin.php'){
    $admin_panel = TRUE;
}
if($curPageName == 'tools.php'){
    $tools = TRUE;
}
?>

<div class="bg-primary border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-white">
        PAYROLL SOFTWARE
    </div>

    <div class="list-group list-group-flush">

        <a href="maintainemployee.php" class="<?php if($maintain_employee){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Maintain Employee</a>

        <a href="newpayroll.php" class="<?php if($new_payroll){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">New Payroll</a> 

        <a href="newadhoc.php" class="<?php if($new_adhoc){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">New AdHoc</a>        

        <a href="historypayroll.php" class="<?php if($history){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Payroll History</a>

        <a href="reports.php" class="<?php if($reports){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Reports</a>

        <a href="view.php" class="<?php if($view){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">View</a>       
        
        <a href="dashboard.php" class="<?php if($dashboard){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Dashboard</a>                 

        <a href="tools.php" class="<?php if($tools){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Tools</a>

        <?php 
        //If permission is admin, show admin panel
        if($_SESSION["permission"] == 1){  
        ?>
        <a href="adminpanel.php" class="<?php if($admin_panel){echo "list-group-item list-group-item-action sidebar_color_active";}else{echo "list-group-item list-group-item-action sidebar_color";} ?>">Admin Panel</a>        
        <?php
        }
        ?>
    </div>
</div>

<script>
//On page first load, get dialog button
var save_button = document.getElementById('save')
save_button.onclick = saveData;
//1st dialog function
function saveData(){
//var input = document.getElementById("saveServer");
var input = 'guide';
//Store into localstorage if dialog guidelines is proceed
localStorage.setItem("guidelines", input.value);
var storedValue = localStorage.getItem("guidelines");
//document.getElementById("myDialog").showModal(); 
$('#guide1').modal('show'); 
}

var save_button1 = document.getElementById('g1')
save_button1.onclick = saveData1;    
//Function to show 2nd dialog, step 2
function saveData1(){
window.location.href = "newpayroll.php";
$('#guide2').modal('show'); 
}
</script>