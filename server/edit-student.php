<?php 
//include server partial file
include_once ("../server/connection.php");

//start the connection
$con = connection();


//check if the submit button is clicked
if(isset($_GET['edit'])){

    //get data from the form
    $id = $_GET['id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $gender = $_GET['gender'];
    $grade = $_GET['grade'];
    $bday = $_GET['bday'];

    //query for inserting data into database
    $sql = "UPDATE `student_info` SET first_name = '$fname', 
    last_name = '$lname', 
    gender = '$gender', 
    grade_level = '$grade', 
    birthday = '$bday'
    WHERE id = '$id'";

    //insert data into database
    $con->query($sql) or die ($con->error);

    //redirect to index.php
    header("Location: ../client/details.php?id=".$id);
}

?>