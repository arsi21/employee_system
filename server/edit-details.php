<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();


//check if the submit button is clicked
if(isset($_GET['edit'])){

    //get data from the form
    $id = $_GET['id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $gender = $_GET['gender'];
    $bday = $_GET['bday'];
    $address = $_GET['address'];
    $email = $_GET['email'];

    //query for updating data into database
    $sql = "UPDATE `employee_info` SET 
    first_name = '$fname', 
    last_name = '$lname', 
    gender = '$gender', 
    birthday = '$bday',
    address = '$address',
    email = '$email'
    WHERE id = '$id'";

    //insert data into database
    $con->query($sql) or die ($con->error);

    //redirect to details.php
    header("Location: ../details.php?id=".$id);
}

?>