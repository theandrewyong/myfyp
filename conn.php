<?php
    $conn = @mysqli_connect("localhost", "root", "") or die("Error connecting to database!");
    @mysqli_select_db($conn, "payroll_db") or die("Error selecting database!");
?>