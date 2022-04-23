<?php 
//include connection
include_once ("connection.php");

//start connection
$con = connection();

if(isset($_POST['delete'])){
    $id = $_POST['id'];
}

//for displaying all the names
$sql = "DELETE FROM employee_info WHERE id = '$id'";
$con->query($sql) or die ($con->error);

header("Location: ../client/index.php");

?>