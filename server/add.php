<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

//check if the submit button is clicked
if(isset($_POST['submit'])){

    //check if all input fields have value
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['gender']) && !empty($_POST['bday']) && !empty($_POST['address']) && !empty($_POST['email'])){

        //get data from the form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $bday = $_POST['bday'];
        $address = $_POST['address'];
        $email = $_POST['email'];



                

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

            //redirect to index.php
            header("Location: ../index.php?errorMsg=fname&lname=$lname&gender=$gender&bday=$bday&address=$address&email=$email");
            exit();
        }

        if(preg_match($namePattern, $lname) == 0){
            $isLnameValid = true;
        }else{
            $isLnameValid = false;

            //redirect to index.php
            header("Location: ../index.php?errorMsg=lname&fname=$fname&gender=$gender&bday=$bday&address=$address&email=$email");
            exit();
        }

        if($gender == "Male" || $gender == "Female"){
            $isGenderValid = true;
        }else{
            $isGenderValid = false;

            //redirect to index.php
            header("Location: ../index.php?errorMsg=gender&fname=$fname&lname=$lname&bday=$bday&address=$address&email=$email");
            exit();
        }

        if(preg_match($bdayPattern, $bday)){
            $isBdayValid = true;
        }else{
            $isBdayValid = false;

            //redirect to index.php
            header("Location: ../index.php?errorMsg=bday&fname=$fname&lname=$lname&gender=$gender&address=$address&email=$email");
            exit();
        }

        if(preg_match($addressPattern, $address)){
            $isAddressValid = true;
        }else{
            $isAddressValid = false;

            //redirect to index.php
            header("Location: ../index.php?errorMsg=address&fname=$fname&lname=$lname&gender=$gender&bday=$bday&email=$email");
            exit();
        }

        if(preg_match($emailPattern, $email)){
            $isEmailValid = true;
        }else{
            $isEmailValid = false;

            //redirect to index.php
            header("Location: ../index.php?errorMsg=email&fname=$fname&lname=$lname&gender=$gender&bday=$bday&address=$address");
            exit();
        }

        

        if($isFnameValid && $isLnameValid && $isGenderValid && $isBdayValid && $isAddressValid && $isEmailValid){







        //query for inserting data into database
        $sql = "INSERT INTO `employee_info`
        (`first_name`, `last_name`, `gender`, `birthday`, `address`, `email`) 
        VALUES ('$fname', '$lname', '$gender', '$bday', '$address', '$email')";

        //insert data into database
        $con->query($sql) or die ($con->error);

        //redirect to index.php
        header("Location: ../index.php");

        }
    }else{
        //redirect to index.php
        header("Location: ../index.php");
    }
}

?>