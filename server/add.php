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
    $grade = $_POST['grade'];
    $bday = $_POST['bday'];

    //query for inserting data into database
    $sql = "INSERT INTO `student_info`(`first_name`, `last_name`, 
    `gender`, `grade_level`, `birthday`) VALUES ('$fname', '$lname', '$gender', '$grade', '$bday')";

    //insert data into database
    $con->query($sql) or die ($con->error);

    //redirect to index.php
    header("Location: ../client/index.php");
}

?>