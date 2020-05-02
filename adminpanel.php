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
            <h1 class="mt-4">Admin Panel</h1>
            <hr>
            <div class="p-5 bg-white rounded shadow mb-5">
            <!-- Rounded tabs -->
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Create User</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Existing User</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
                    <?php
                    if(isset($_POST["submit"])){
                    $username = mysqli_escape_string($conn, $_POST["username"]);
                    $password = mysqli_escape_string($conn, $_POST["password"]);
                    $permission = mysqli_escape_string($conn, $_POST["permission"]);
                    $new_user_sql = "INSERT INTO account (username, password, permission) VALUES (?,?,?)";
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
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Permission Level</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                    <?php
                                    $select_all_sql = mysqli_query($conn, "SELECT * FROM account");
                                    while($data = mysqli_fetch_assoc($select_all_sql)){
                                    $username_id = $data["username_id"];
                                    echo "<tr>";
                                    echo "<td>" . $username_id . "</td>";
                                    echo "<td>" . $data["username"] . "</td>";
                                    echo "<td>" . $data["permission"] . "</td>";
                                    echo "<td>" . '<a href="editadmin.php?id=' . $username_id . '">Edit</a>' . "</td>";
                                    echo "<td>" . '<a href="deleteadmin.php?id=' . $username_id . '">Delete</a>'. "</td>";
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
    </div>
</div>

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
