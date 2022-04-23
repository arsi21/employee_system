<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

//check if the submit button is clicked
if(isset($_POST['submit'])){

    //get data from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    //query for inserting data into database
    $sql = "INSERT INTO `employee_info`(`first_name`, `last_name`, 
    `gender`, `birthday`, `address`, `email`) VALUES ('$fname', '$lname', '$gender', '$bday', '$address', '$email')";

    //insert data into database
    $con->query($sql) or die ($con->error);

    //redirect to index.php
    header("Location: ../client/index.php");
}

?>