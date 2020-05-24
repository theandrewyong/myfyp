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
						<form role="form" action="export_table.php" method="post">
							<button type="submit" class="btn btn-primary btn-block" name="export_epf">Export EPF table</button>
						</form>
						
                    </div>
                <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">
                <!-- SOCSO table -->
                    <div class="row">
                        <div class="col-12">
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
                                </table>
                            </div>        
                        </div>
                    </div>    
                <!-- SOCSO table end --> 
					<br/>
					<form role="form" action="export_table.php" method="post">
						<button type="submit" class="btn btn-primary btn-block" name="export_socso">Export SOCSO table</button>
					</form>
                </div>
                <div id="profile1" role="tabpanel" aria-labelledby="profile1-tab" class="tab-pane fade px-1 py-3">
                <!-- EIS table -->
                    <div class="row">
                        <div class="col-12">
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
                                </table>
                            </div>        
                        </div>
                    </div>    
                <!-- EIS table end -->  
					<br/>
					<form role="form" action="export_table.php" method="post">
						<button type="submit" class="btn btn-primary btn-block" name="export_eis">Export EIS table</button>
					</form>
                </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<style>
  

    
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

$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
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
                } );
            } );
        }
    });
    
 
} );    


    
/*$(document).ready( function() {
    $('#example').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );   
} );
*/
$(document).ready( function() {
    $('#example2').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
        } );   
} );

$(document).ready( function() {
    $('#example3').dataTable( {
        responsive: true,
        language: {
        search: "",
        "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
        },
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );   
} );
</script>
</body>
</html>