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


    
    //check if all input fields have value
    if(!empty($_GET['fname']) && !empty($_GET['lname']) && !empty($_GET['gender']) && !empty($_GET['bday']) && !empty($_GET['address']) && !empty($_GET['email'])){
        //regex pattern
        $namePattern = "/^\s+|\s+$|\s{2,}|[0-9]+|^\-+|\-$|\-{2,}|[^a-zA-Z\s\-]/";
        $bdayPattern = "/^[\d\-]+$/";
        $addressPattern = "/^[a-zA-Z\d\s\-\_\.\(\)\#]+$/";
        $emailPattern = "/^[a-zA-Z\d\-\_\.]+@[a-zA-Z\d]+\.[a-zA-Z\.]+$/";

        //check if all input are valid
        if(preg_match($namePattern, $fname) == 0){
            $isFnameValid = true;
        }else{
            $isFnameValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=fname&id=$id&lname=$lname&gender=$gender&bday=$bday&address=$address&email=$email");
            exit();
        }

        if(preg_match($namePattern, $lname) == 0){
            $isLnameValid = true;
        }else{
            $isLnameValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=lname&id=$id&fname=$fname&gender=$gender&bday=$bday&address=$address&email=$email");
            exit();
        }

        if($gender == "Male" || $gender == "Female"){
            $isGenderValid = true;
        }else{
            $isGenderValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=gender&id=$id&fname=$fname&lname=$lname&bday=$bday&address=$address&email=$email");
            exit();
        }

        if(preg_match($bdayPattern, $bday)){
            $isBdayValid = true;
        }else{
            $isBdayValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=bday&id=$id&fname=$fname&lname=$lname&gender=$gender&address=$address&email=$email");
            exit();
        }

        if(preg_match($addressPattern, $address)){
            $isAddressValid = true;
        }else{
            $isAddressValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=address&id=$id&fname=$fname&lname=$lname&gender=$gender&bday=$bday&email=$email");
            exit();
        }

        if(preg_match($emailPattern, $email)){
            $isEmailValid = true;
        }else{
            $isEmailValid = false;

            //redirect to details.php
            header("Location: ../details.php?errorMsg=email&id=$id&fname=$fname&lname=$lname&gender=$gender&bday=$bday&address=$address");
            exit();
        }

        

        if($isFnameValid && $isLnameValid && $isGenderValid && $isBdayValid && $isAddressValid && $isEmailValid){
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
    }else{
        //redirect to details.php
        header("Location: ../details.php?errorMsg=emptyField&id=$id&fname=$fname&lname=$lname&gender=$gender&bday=$bday&address=$address&email=$email");
    }
}

?>