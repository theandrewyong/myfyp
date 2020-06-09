<?php
session_start();
include "conn.php";
if(empty($_SESSION["username"])){
    header("location:index.php");
}
$username = $_SESSION["username"];

$message1='';
//Require php excel class
require_once "Classes/PHPExcel.php";

//import EPF function
if(isset($_POST["import_epf"])){
    //Check files to make sure it is not empty
	if(($_FILES["epf_excel"]["tmp_name"])!=''){
		//Get extension name from end array
		$array = explode(".", $_FILES["epf_excel"]["name"]);
        $extension = end($array);
        //If extension is xlsx
		if($extension=="xlsx"){
            //Call class function
			$tmpfname = $_FILES["epf_excel"]["tmp_name"];
			$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
			$excelObj = $excelReader->load($tmpfname);
			$worksheet = $excelObj->getSheet(0);
			$lastRow = $worksheet->getHighestRow();
            //Row from excel file
			for ($row = 1; $row <= $lastRow; $row++) {
            //Insert excel value into array
			 $my_array[] = $worksheet->getCell('A'.$row)->getValue();
			 $my_epf_start[] = $worksheet->getCell('D'.$row)->getValue();
			 $my_epf_end[] = $worksheet->getCell('E'.$row)->getValue();
			 $my_epf_emp[] = $worksheet->getCell('F'.$row)->getValue();
			 $my_epf_empr[] = $worksheet->getCell('G'.$row)->getValue();
			}
		$count = 0;
		//Foreach data inside array
		foreach($my_array as $ma){
            //Select data tp get epf formula id from existing table data
			$get_epf_id_sql = mysqli_query($conn, "SELECT * FROM epf_formula WHERE epf_formula_id = '$ma'");
			$gei_result = mysqli_fetch_assoc($get_epf_id_sql);
			$gr_id = $gei_result["epf_formula_id"];

			//Update table based on array
			$update_sql = mysqli_query($conn, "UPDATE epf_formula SET epf_formula_wage_start = '$my_epf_start[$count]', epf_formula_wage_end = '$my_epf_end[$count]', epf_formula_employee_amt = '$my_epf_emp[$count]', epf_formula_employer_amt = '$my_epf_empr[$count]' WHERE epf_formula_id = '$gr_id'");
			$count = $count + 1;
			}
			$message1 = '<label class="text-success">Excel Successfully Imported</label>'; //Feedback message
    }
		else {
			$message1 = '<label class="text-danger">Kindly convert your Excel file to .xlsx to ensure Data Stability</label>';
		}
    	
	}
	
	else{
		$message1 = '<label class="text-danger">Please Select a File</label>';
	}	
}
//import SOCSO
$message2='';
if(isset($_POST["import_socso"])){
		
	if(($_FILES["socso_excel"]["tmp_name"])!=''){
		
		$array = explode(".", $_FILES["socso_excel"]["name"]);
        $extension = end($array);
		if($extension=="xlsx"){
			$tmpfname = $_FILES["socso_excel"]["tmp_name"];
			$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
			$excelObj = $excelReader->load($tmpfname);
			$worksheet = $excelObj->getSheet(0);
			$lastRow = $worksheet->getHighestRow();

			for ($row = 1; $row <= $lastRow; $row++) {

			//insert to array
			 $my_array[] = $worksheet->getCell('A'.$row)->getValue();
			 $my_socso_start[] = $worksheet->getCell('B'.$row)->getValue();
			 $my_socso_end[]= $worksheet->getCell('C'.$row)->getValue();
			 $my_socso_emp_fc[] = $worksheet->getCell('D'.$row)->getValue();
			 $my_socso_empr_fc[] = $worksheet->getCell('E'.$row)->getValue();
			 $my_socso_total_fc[] = $worksheet->getCell('F'.$row)->getValue();
			 $my_socso_empr_sc[] = $worksheet->getCell('G'.$row)->getValue();
	
			}
		$count = 0;
		
		foreach($my_array as $ma){
			$get_socso_id_sql = mysqli_query($conn, "SELECT * FROM socso_formula WHERE socso_formula_id = '$ma'");
			$gei_result = mysqli_fetch_assoc($get_socso_id_sql);
			$gr_id = $gei_result["socso_formula_id"];

			//do update
			$update_sql = mysqli_query($conn, "UPDATE socso_formula SET socso_formula_wage_start = '$my_socso_start[$count]', socso_formula_wage_end = '$my_socso_end[$count]', socso_formula_employee_amt = '$my_socso_emp_fc[$count]', socso_formula_employer_amt = '$my_socso_empr_fc[$count]', socso_formula_total = '$my_socso_total_fc[$count]', socso_formula_employer_contribution = '$my_socso_empr_sc[$count]' WHERE socso_formula_id = '$gr_id'");
			$count = $count + 1;
			}
			$message2 = '<label class="text-success">Excel Successfully Imported</label>';
    }
		else {
			$message2 = '<label class="text-danger">Kindly convert your Excel file to .xlsx to ensure Data Stability</label>';
		}
    	
	}
	
	else{
		$message2 = '<label class="text-danger">Please Select a File</label>';
	}
		
	
}

//import EIS
$message3='';
if(isset($_POST["import_eis"])){
		
	if(($_FILES["eis_excel"]["tmp_name"])!=''){
		
		$array = explode(".", $_FILES["eis_excel"]["name"]);
        $extension = end($array);
		if($extension=="xlsx"){
			$tmpfname = $_FILES["eis_excel"]["tmp_name"];
			$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
			$excelObj = $excelReader->load($tmpfname);
			$worksheet = $excelObj->getSheet(0);
			$lastRow = $worksheet->getHighestRow();

			for ($row = 1; $row <= $lastRow; $row++) {

			//insert to array
			 $my_array[] = $worksheet->getCell('A'.$row)->getValue();
			 $my_eis_start[] = $worksheet->getCell('B'.$row)->getValue();
			 $my_eis_end[]= $worksheet->getCell('C'.$row)->getValue();
			 $my_eis_emp[] = $worksheet->getCell('D'.$row)->getValue();
			 $my_eis_empr[] = $worksheet->getCell('E'.$row)->getValue();
			 $my_eis_total[] = $worksheet->getCell('F'.$row)->getValue();
	
			}
		$count = 0;
		
		foreach($my_array as $ma){
			$get_eis_id_sql = mysqli_query($conn, "SELECT * FROM eis_formula WHERE eis_formula_id = '$ma'");
			$gei_result = mysqli_fetch_assoc($get_eis_id_sql);
			$gr_id = $gei_result["eis_formula_id"];

			//do update
			$update_sql = mysqli_query($conn, "UPDATE eis_formula SET eis_formula_wage_start = '$my_eis_start[$count]', eis_formula_wage_end = '$my_eis_end[$count]', eis_formula_employee_amt = '$my_eis_emp[$count]', eis_formula_employer_amt = '$my_eis_empr[$count]', eis_formula_total = '$my_eis_total[$count]' WHERE eis_formula_id = '$gr_id'");
			$count = $count + 1;
			}
			$message3 = '<label class="text-success">Excel Successfully Imported</label>';
    }
		else {
			$message3 = '<label class="text-danger">Kindly convert your Excel file to .xlsx to ensure Data Stability</label>';
		}
    	
	}
	
	else{
		$message3 = '<label class="text-danger">Please Select a File</label>';
	}
		
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Payroll Software - Views</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Views</h1>
            <hr>
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">EPF table</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">SOCSO table</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile1-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile1" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">EIS table</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-1 py-3 show active">
                    <!-- EPF table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 col-12">
								<form method="post" enctype="multipart/form-data">
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile" name="epf_excel" accept="xlsx">
									<label class="custom-file-label" for="customFile">Select XLS File</label>
								</div>
									<input type="submit" name="import_epf" class="btn btn-info col-md-6 col-12" value="Import EPF Excel File" />
									<div><?php echo $message1; ?></div><br>
								</form>	
                                    </div>
                                    <div class="col-md-6 col-12">
                                <form role="form" action="export_table.php" method="post">
                                    <button type="submit" class="btn btn-primary col-md-6 float-right col-12" name="export_epf">Export EPF Excel File</button>
                                </form>
                                    </div>                                    
                                </div>
									<hr>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Wages</th>
                                                <th colspan="2">EPF</th>
                                            </tr>
                                            <tr>
                                                <td>Start With</td>
                                                <td>End With</td>
                                                <td>Employee EPF</td>
                                                <td>Employer EPF</td>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                                    $epf_formula_sql = "SELECT * FROM epf_formula";
                                    $epf_formula_prepared_stmt_insert = mysqli_prepare($conn, $epf_formula_sql);
                                   	mysqli_stmt_execute($epf_formula_prepared_stmt_insert);
                                    $epf_result = $epf_formula_prepared_stmt_insert->get_result(); 
									
                                    if($epf_result->num_rows > 0) { 
                                        while ($data = $epf_result->fetch_assoc()) {
											
											$format_epf_start = number_format($data["epf_formula_wage_start"],2);
											$format_epf_end = number_format($data["epf_formula_wage_end"],2);
											$format_epf_employee = number_format($data["epf_formula_employee_amt"],2);
											$format_epf_employer = number_format($data["epf_formula_employer_amt"],2);
											
                                            echo '<tr>';
                                            echo '<td>' . $format_epf_start . '</td>';
                                            echo '<td>' . $format_epf_end . '</td>';
                                            echo '<td>' . $format_epf_employee . '</td>';
                                            echo '<td>' . $format_epf_employer . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>            
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th>Wages Start With</th>
                                    <th>Wages End With</th>
                                    <th>Employee EPF</th>
                                    <th>Employer EPF</th>
                                    </tr>
                                    </tfoot>
                                    </table>
                                </div>        
                            </div>
                        </div>    
                    <!-- EPF table end -->
						<br/>

						
                    </div>
                <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">
                <!-- SOCSO table -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-12">
								<form method="post" enctype="multipart/form-data">
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile" name="socso_excel" accept="xlsx">
									<label class="custom-file-label" for="customFile">Select XLS File</label>
								</div>
									<input type="submit" name="import_socso" class="btn btn-info col-md-6 col-12" value="Import SOCSO Excel File" />
									<div><?php echo $message2; ?></div><br>
								</form>	
                                </div>
                                <div class="col-md-6 col-12">
                            <form role="form" action="export_table.php" method="post">
                                <button type="submit" class="btn btn-primary col-md-6 float-right col-12" name="export_socso">Export SOCSO Excel File</button>
                            </form>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="example3" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Wages</th>
                                            <th colspan="3">First Category</th>
                                            <th>Second Category</th>
                                        </tr>
                                        <tr>
                                            <td>Start With</td>
                                            <td>End With</td>
                                            <td>Employee Share</td>
                                            <td>Employer Share</td>
                                            <td>Total</td>
                                            <td>Employer Contribution</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM socso_formula";
                                    $prepared_stmt_insert = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_execute($prepared_stmt_insert);
                                    $result = $prepared_stmt_insert->get_result(); 

                                    if($result->num_rows > 0) { 
                                        while ($data = $result->fetch_assoc()) {
											$format_socso_start = number_format($data["socso_formula_wage_start"],2);
											$format_socso_end = number_format($data["socso_formula_wage_end"],2);
											$format_socso_employee = number_format($data["socso_formula_employee_amt"],2);
											$format_socso_employer = number_format($data["socso_formula_employer_amt"],2);
											$format_socso_total = number_format($data["socso_formula_total"],2);
											$format_socso_contribution = number_format($data["socso_formula_employer_contribution"],2);
											
                                            echo '<tr>';
                                            echo '<td>' . $format_socso_start . '</td>';
                                            echo '<td>' . $format_socso_end . '</td>';
                                            echo '<td>' . $format_socso_employee . '</td>';
                                            echo '<td>' . $format_socso_employer . '</td>';
                                            echo '<td>' . $format_socso_total . '</td>';
                                            echo '<td>' . $format_socso_contribution . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>            
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <th>Wages Start With</th>
                                    <th>Wages End With</th>
                                    <th>Employee Share</th>
                                    <th>Employer Share</th>
                                    <th>Total</th>
                                    <th>Employer Contribution</th>
                                    </tr>
                                    </tfoot>                                    
                                </table>
                            </div>        
                        </div>
                    </div>    
                <!-- SOCSO table end --> 
					<br/>

                </div>
                <div id="profile1" role="tabpanel" aria-labelledby="profile1-tab" class="tab-pane fade px-1 py-3">
                <!-- EIS table -->
                    <div class="row">
                        <div class="col-md-12">
							<div class="row">
                                <div class="col-md-6 col-12">
								<form method="post" enctype="multipart/form-data">
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile" name="eis_excel" accept="xlsx">
									<label class="custom-file-label" for="customFile">Select XLS File</label>
								</div>
									<input type="submit" name="import_eis" class="btn btn-info col-md-6 col-12" value="Import EIS Excel File" />
									<div><?php echo $message2; ?></div><br>
								</form>	
                                </div>
                                <div class="col-md-6 col-12">
                            <form role="form" action="export_table.php" method="post">
                                <button type="submit" class="btn btn-primary col-md-6 float-right col-12" name="export_eis">Export EIS Excel File</button>
                            </form>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Wages</th>
                                            <th colspan="3">EIS</th>
                                        </tr>
                                        <tr>
                                            <td>Start With</td>
                                            <td>End With</td>
                                            <td>Employee EIS</td>
                                            <td>Employer EIS</td>
                                            <td>Total</td>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM eis_formula";
                                $prepared_stmt_insert = mysqli_prepare($conn, $sql);
                                mysqli_stmt_execute($prepared_stmt_insert);
                                $result = $prepared_stmt_insert->get_result(); 

                                if($result->num_rows > 0) { 
                                    while ($data = $result->fetch_assoc()) {
										$format_eis_start = number_format ($data["eis_formula_wage_start"],2);
										$format_eis_end = number_format ($data["eis_formula_wage_end"],2);
										$format_eis_employee = number_format ($data["eis_formula_employee_amt"],2);
										$format_eis_employer = number_format ($data["eis_formula_employer_amt"],2);
										$format_eis_total = number_format ($data["eis_formula_total"],2);
										
                                        echo '<tr>';
                                        echo '<td>' . $format_eis_start . '</td>';
                                        echo '<td>' . $format_eis_end . '</td>';
                                        echo '<td>' . $format_eis_employee . '</td>';
                                        echo '<td>' . $format_eis_employer . '</td>';
                                        echo '<td>' . $format_eis_total . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>            
                                </tbody>
                                    <tfoot>
                                    <tr>
                                    <th>Wages Start With</th>
                                    <th>Wages End With</th>
                                    <th>Employee EIS</th>
                                    <th>Employer EIS</th>
                                    <th>Total</th>
                                    </tr>
                                    </tfoot>                                      
                                </table>
                            </div>        
                        </div>
                    </div>    
                <!-- EIS table end -->  
					<br/>
                </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<style>
/* CSS style for individual input box width */
.ggwp {
    width: 100%;
}
</style>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
//Function for customized data tables
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    //DataTable
    var table = $('#example').DataTable({
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">',
        //inistComplete function for individual column search
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } ).addClass('ggwp');
                $('#example tfoot tr').appendTo('#example thead');
            } );
        }
    });
    
 
} );    


$(document).ready( function() {
    $('#example2 tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
     
    
    $('#example2').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">',
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } ).addClass('ggwp');
                $('#example2 tfoot tr').appendTo('#example2 thead');
            } );
        }
        } );   
} );

$(document).ready( function() {
    $('#example3 tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
     
    
    $('#example3').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">',
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } ).addClass('ggwp');
                $('#example3 tfoot tr').appendTo('#example3 thead');
            } );
        }        
    } );   
} );
</script>
</body>
</html>