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
<title>Payroll Software - Reports</title>
<?php include "all_css.php"; ?>
</head>
<body onload="myFunction();">
        <!-- modal must put after php refresh page, if not header wont work -->        
        <div id="guide3" class="modal modal-wide fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Step 3: Reports</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <p>To Print Payslip, click Print Payslip</p>
                <p>To View Payroll Summary Report, click View Payroll Summary</p>
              </div>
              <div class="modal-footer">
                  <a href="" class="btn btn-primary" id="psum" data-dismiss="modal">View Payroll Summary</a>
                  <a href="" class="btn btn-primary" id="ppslip" data-dismiss="modal">Print Payslip</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 
    
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Reports</h1>
            <p id="guide_reports">
            <hr>
            <div class="polaroids">
                <div class="polaroid">
                    <a href="payslip_report.php">
                        <img src="img/payslip.png" width="220px;">
                        <p>Payslip Report</p>
                    </a>
                </div>
				<div class="polaroid">
                    <a href="adhoc_report.php">    
                        <img src="img/adhoc.png" width="220px;">
                        <p>Adhoc Report</p>
                    </a>
                </div> 
                <div class="polaroid">
                    <a href="epf_report.php">
                        <img src="img/epf.png" width="220px;">
                        <p>EPF Report</p>
                    </a>
                </div>
                <div class="polaroid">
                    <a href="socso_report.php">    
                        <img src="img/socso.png" width="220px;">
                        <p>SOCSO Report</p>
                    </a>
                </div>
                <div class="polaroid">
                    <a href="eis_report.php">    
                        <img src="img/eis.png" width="220px;">
                        <p>EIS Report</p>
                    </a>
                </div>
                <div class="polaroid">
                    <a href="payroll_summary_report.php">    
                        <img src="img/payroll%20summary.png" width="220px;">
                        <p>Payroll Summary Report</p>
                    </a>
                </div>
                <div class="polaroid">
                    <a href="yearly_wages_report.php">    
                        <img src="img/yearly_icon.png" width="220px;">
                        <p>Yearly Wages Report</p>
                    </a>
                </div>
                <div class="polaroid">
                    <a href="yearly_individual_report.php">    
                        <img src="img/yearly_icon.png" width="220px;">
                        <p>Yearly Individual Report</p>
                    </a>
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
    
function myFunction() {
    if (localStorage.getItem("guidelines") !== null) {
      if (!sessionStorage.getItem('shown-modal3')){
        $('#guide3').modal('show');
        sessionStorage.setItem('shown-modal3', 'true');
      }
    }
}     
    
    
if (localStorage.getItem("guidelines") !== null) {
    
 document.getElementById("guide_reports").innerHTML = '<div class="p-2 bg-white rounded shadow mb-1"><a class="btn btn-primary" href="maintainemployee.php">Step 1: Maintain Employee</a><b> ></b><a class="btn btn-primary" href="newpayroll.php">Step 2: New Payroll</a><b> ></b><a class="btn btn-primary" href="reports.php">Step 3: Reports</div>';
}    
    
document.getElementById("ppslip").onclick = function () {
    location.href = "payslip_report.php";
}; 
    
document.getElementById("psum").onclick = function () {
    location.href = "payroll_summary_report.php";
};    
</script>
</body>
</html>