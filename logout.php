<?php
    //destroy the session and go to the products page
    session_start(); 
    session_destroy();
    header("location:index.php");
?>