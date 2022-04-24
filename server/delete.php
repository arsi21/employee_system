<?php 
//include connection
include_once ("connection.php");

//start connection
$con = connection();

if(isset($_POST['delete'])){
    $id = $_POST['id'];
}

//for deleting details
$deleteEmp = "DELETE FROM employee_info WHERE id = '$id'";
$con->query($deleteEmp) or die ($con->error);

$deleteUser = "DELETE FROM user WHERE employee_id = '$id'";
$con->query($deleteUser) or die ($con->error);

header("Location: ../client/index.php");

?>