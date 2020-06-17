<?php
    session_start();
    include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta name="description" content=""/>
<meta name="author" content=""/>
<title>Payroll Software - Login</title>
<?php include "all_css.php"; ?>
<link href="vendor/bootstrap/js/bootstrap.min.js"/>
<link href="vendor/jquery/jquery.min.js"/>
<link href="vendor/css/login.css" rel="stylesheet"/>
</head>
	
<body>
	<?php
		$errorMsg = "";
		if(isset($_POST["submit"])){
			$login_username = mysqli_escape_string($conn, $_POST["username"]);
			$login_pass = mysqli_escape_string($conn, $_POST["password"]);

			//If form is not empty
			if(!empty($login_username) && !empty($login_pass)){

				$mypass = $login_pass;
				$sql_query_string = "SELECT * FROM account WHERE username =?";
				$prepared_stmt = mysqli_prepare($conn, $sql_query_string);
				mysqli_stmt_bind_param($prepared_stmt, "s", $login_username);
				mysqli_stmt_execute($prepared_stmt);
				$query_result = mysqli_stmt_get_result($prepared_stmt);
				mysqli_stmt_close($prepared_stmt);

				if($member_data = mysqli_num_rows($query_result) > 0){
					$result = mysqli_fetch_assoc($query_result);
					
					if($mypass == $result["password"]){
						$_SESSION["username"] = $result["username"];
						$_SESSION["permission"] = $result["permission"];
						$_SESSION["username_id"] = $result["username_id"];
						header("location:maintainemployee.php");
					}
					else{
						$errorMsg = "Wrong password!";
					}
				}
				else{
					$errorMsg = "Account does not exist!";
				}
			}
			else{
				$errorMsg = "Please fill in all the empty fields!";
			}
		}
	?>
	<div id="login">
		<div class="login-logo m-5"><img src="img/sql-logo.png" id="sql-logo" alt="Payroll Logo"/>
		</div>
		<div class="container">
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6">
					<div id="login-box" class="col-md-12">
						<form id="login-form" class="form" action="index.php" method="post">
							<h2 class="text-center text-info">Login</h2>
							<div class="form-group">
								<label for="username" class="text-info">Username:</label><br>
								<input type="text" name="username" id="username" class="form-control" autofocus>
							</div>

							<div class="form-group">
								<label for="password" class="text-info">Password:</label><br>
								<input type="password" name="password" id="password" class="form-control">
							</div>

							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php
		if(!empty($errorMsg)){
			echo "<script>alert('" . $errorMsg . "');</script>";
		}
    ?>
</body>
</html>

<script>
 localStorage.clear();
    sessionStorage.clear();
</script>