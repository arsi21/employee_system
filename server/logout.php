<?php 

session_start();

//remove session data
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['access']);

//redirect to index.php
header("Location: ../client/index.php");

?>