<?php
session_start();
include "conn.php";
    if(empty($_SESSION["username"])){
header("location:index.php");
}
$username = $_SESSION["username"];

$error = FALSE;
$error_username = "";
$error_password = "";
$username = "";
$password = "";
$permission = ""; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["username"])){
        $error_username = '<span class="text-danger"> *Invalid Username</span>';
        $error = TRUE;
    }else{
        $username = mysqli_escape_string($conn,  test_input($_POST["username"]));
    }
    if(empty($_POST["password"])){
        $error_password = '<span class="text-danger"> *Invalid Password</span>';
        $error = TRUE;
    }else{
        $password = mysqli_escape_string($conn, test_input($_POST["password"]));
    }
    $permission = mysqli_escape_string($conn, test_input($_POST["permission"]));

    if($error == FALSE){
        $new_user_sql = "INSERT INTO account (username, password, permission) VALUES (?,?,?)";
        $prepared_stmt_insert = mysqli_prepare($conn, $new_user_sql);
        mysqli_stmt_bind_param($prepared_stmt_insert, 'sss', $username, $password, $permission);
        mysqli_stmt_execute($prepared_stmt_insert);
        mysqli_stmt_close($prepared_stmt_insert);
        echo '<script>alert("Created Successfully");</script>';
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Payroll Software - Admin Panel</title>
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
            <div class="p-3 bg-white rounded shadow mb-5">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills flex-column flex-sm-row text-center bg-light border-0 rounded-nav">
                    <li class="nav-item flex-sm-fill">
                        <a id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 text-uppercase font-weight-bold active">Create User</a>
                    </li>
                    <li class="nav-item flex-sm-fill">
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 text-uppercase font-weight-bold">Existing User</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div id="home" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-1 py-3 show active">          
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="form-group">
                                <label for="email">Username:<?php echo $error_username;?></label>
                                <input type="text" class="form-control" id="email" name="username">
                            </div>
                        <div class="form-group">
                            <label for="pwd">Password:<?php echo $error_password;?></label>
                            <input type="password" class="form-control" id="pwd" name="password">
                        </div>
                        <div class="form-group">
                            <label for="sel1">Permission level (1 for Admin | 2 for Employee):</label>
                            <select class="form-control" id="sel1" name="permission">
                                <option value="2">2 - Employee</option>
                                <option value="1">1 - Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div id="profile" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-1 py-3">
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
                                            echo "<td>" . '<a href="deleteadmin.php?id=' . $username_id . '" onclick="return confirm(\'Confirm Delete?\');">Delete</a>'. "</td>";
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
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
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
        "sDom": '<"dtb_search"f><"dtb_length"l>rt<"bottom"pi><"clear">'
    } );
} );    
    
</script>
  
</body>

</html>