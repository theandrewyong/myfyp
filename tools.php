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
<title>Payroll Software - Tools</title>
<?php include "all_css.php"; ?>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include "sidebar.php"; ?>
    <div id="page-content-wrapper">
    <?php include "navbar.php"; ?>
        <div class="container-fluid">
            <h1 class="mt-4">Tools</h1>
            <hr>
            <?php 
            $message = '';
            if(isset($_POST["import"])){

                if($_FILES["database"]["name"] != ''){
                    $array = explode(".", $_FILES["database"]["name"]);
                    $extension = end($array);
                    
                    if($extension == 'sql'){
                        $connect = mysqli_connect("localhost", "root", "", "payroll_db");
                        $drop_table = mysqli_query($conn, "DROP DATABASE payroll_db");
                        $create_table = mysqli_query($conn, "CREATE DATABASE payroll_db");
                        $output = '';
                        $count = 0;
                        $file_data = file($_FILES["database"]["tmp_name"]);
                        
                        foreach($file_data as $row){
                            $start_character = substr(trim($row), 0, 2);
                            if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != ''){
                                $output = $output . $row;
                                $end_character = substr(trim($row), -1, 1);
                                
                                if($end_character == ';'){
                                    if(!mysqli_query($connect, $output)){
                                        $count++;
                                    }
                                    $output = '';
                                }
                            }
                        }
                        if($count > 0){
                            $message = '<label class="text-danger">There is an error in Database Import</label>';
                        }else{
                            $message = '<label class="text-success">Database Successfully Imported</label>';
                        }
                    }else{
                        $message = '<label class="text-danger">Invalid File</label>';
                    }
                }else{
                    $message = '<label class="text-danger">Please Select SQL File</label>';
                }
            }
            
            $message2 = '';
            if(isset($_POST["export"])){
                $connection = mysqli_connect('localhost','root','','payroll_db');
                $tables = array();
                $result = mysqli_query($connection,"SHOW TABLES");
                
                while($row = mysqli_fetch_row($result)){
                    $tables[] = $row[0];
                }
                $return = '';
                
                foreach($tables as $table){
                    $result = mysqli_query($connection,"SELECT * FROM ".$table);
                    $num_fields = mysqli_num_fields($result);
                    $row2 = mysqli_fetch_row(mysqli_query($connection,"SHOW CREATE TABLE ".$table));
                    $return .= "\n\n".$row2[1].";\n\n";

                    for($i=0;$i<$num_fields;$i++){
                        while($row = mysqli_fetch_row($result)){
                            $return .= "INSERT INTO ".$table." VALUES(";
                            
                            for($j=0;$j<$num_fields;$j++){
                                $row[$j] = addslashes($row[$j]);
                                if(isset($row[$j])){
                                    $return .= '"'.$row[$j].'"';
                                }else{ 
                                    $return .= '""';
                                }
                                if($j<$num_fields-1){
                                    $return .= ',';
                                }
                            }
                            $return .= ");\n";
                        }
                    }
                    $return .= "\n\n\n";
                }
                
                $handle = fopen("C:\Users\Public\Downloads\backup.sql","w+");
                fwrite($handle, "SET FOREIGN_KEY_CHECKS = 0;\n");
                fwrite($handle,$return);
                fclose($handle);
                
                $message2 = '<label class="text-success">Database Successfully Backed-Up to C:\Users\Public\Downloads\backup.sql</label>';
            }            
            ?>
            
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                    <h3>Import SQL File</h3>
                    <p>Note: Only Accept SQL File</p>
                    <hr>
                    <div>
                        <?php
                            echo $message;
                        ?>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" name="database">
                        <label class="custom-file-label" for="customFile">Select SQL File</label>
                    </div>
                        <input type="submit" name="import" class="btn btn-info" value="Import SQL File" />
                    </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="p-3 bg-white rounded shadow mb-5">
                    <h3>Export SQL File</h3>
                    <p>Note: Exported SQL file will be Backed-Up to C:\Users\Public\Downloads\</p>
                    <hr>
                    <div>
                        <?php echo $message2; ?>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <input type="submit" name="export" class="btn btn-info" value="Export SQL File"/>
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
    
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
    
</script>
</body>
</html>