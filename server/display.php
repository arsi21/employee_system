<?php 
//include connection
include_once ("connection.php");

//start connection
$con = connection();

//for displaying all the names
$sql = "SELECT * FROM student_info ORDER BY id DESC";
$result = $con->query($sql);

?>