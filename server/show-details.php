<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM employee_info WHERE id = '$id'";
$result = $con->query($sql) or die ($con->error);
$row = $result->fetch_assoc();

?>