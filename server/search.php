<?php 
//include connection
include_once ("connection.php");

//start connection
$con = connection();

//get the input value
$search = $_GET['search'];

//getting all data that has the value of $search
$sql = "SELECT * FROM employee_info WHERE first_name LIKE '%$search%' || 
last_name LIKE '%$search%' ORDER BY id DESC";
$result = $con->query($sql);

?>