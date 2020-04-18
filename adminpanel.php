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

<title>Payroll Software - Add Employee</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">
<style>
    .mot {
        margin-top: 10px;
        float:left;
        clear: both;
    }   
    
    .xot {
        float: right;
    }
    
</style>
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
<h1 class="mt-4">Admin Panel</h1>
<hr>
<!-- dashboard conten here -->
<section class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <ul id="tabsJustified" class="nav nav-tabs nav-fill">
                <li class="nav-item"><a href="" data-target="#home1" data-toggle="tab" class="nav-link small text-uppercase">Create New User</a></li>
                <li class="nav-item"><a href="" data-target="#profile1" data-toggle="tab" class="nav-link small text-uppercase active">Existing User</a></li>
            </ul>
            <br>
            <div id="tabsJustifiedContent" class="tab-content">
                <div id="home1" class="tab-pane fade">

                    
    <?php
 
                    
        if(isset($_POST["submit"])){
            
        $username = mysqli_escape_string($conn, $_POST["username"]);
          $password = mysqli_escape_string($conn, $_POST["password"]);
          $permission = mysqli_escape_string($conn, $_POST["permission"]);
            
            $new_user_sql = "INSERT INTO users (username, password, permission) VALUES (?,?,?)";
            $prepared_stmt_insert = mysqli_prepare($conn, $new_user_sql);
            mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $username, $password, $permission);
            mysqli_stmt_execute($prepared_stmt_insert);
            mysqli_stmt_close($prepared_stmt_insert); 
            
        }    
                           
                    
                    
    ?>
                    
                    
   <form action="adminpanel.php" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" class="form-control" id="email" name="username" autofocus>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password">
    </div>
    <div class="form-group">
      <label for="sel1">Permission level (1 for Admin | 2 for Employee):</label>
      <select class="form-control" id="sel1" name="permission">
        <option>Select Permission</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  </form>
                </div>
                <div id="profile1" class="tab-pane fade active show">
    <div class="row">
        <div class="col-12">
        <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Permission Level</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_all_sql = mysqli_query($conn, "SELECT * FROM users");
            while($data = mysqli_fetch_assoc($select_all_sql)){
                
                echo "<tr>";
                echo "<td>" . "1" . "</td>";
                echo "<td>" . $data["username"] . "</td>";
                echo "<td>" . $data["permission"] . "</td>";
                echo "</tr>";
            }        
            ?>
        </tbody>
    </table>
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});
    
$(document).ready( function() {
  $('#example').dataTable( {
     language: {
        search: "",
         "lengthMenu": "_MENU_",
        searchPlaceholder: "Search records"
     },
    "sDom": '<"mot"f><"xot"l>rt<"bottom"pi><"clear">'
  } );
} );
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>
