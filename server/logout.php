<?php 

session_start();

//remove session data
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['access']);
unset($_SESSION['employee_id']);

//redirect to index.php
header("Location: ../index.php");

?>