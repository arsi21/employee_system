<?php 
//include connection
include_once ("connection.php");

//start connection
$con = connection();

$search = $_GET['search'];

//for displaying all the names
$sql = "SELECT * FROM employee_info WHERE first_name LIKE '%$search%' || last_name LIKE '%$search%' ORDER BY id DESC";
$result = $con->query($sql);

?>