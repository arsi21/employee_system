<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

//check if the submit button is clicked
if(isset($_POST['submit'])){

    //check if all input field have value
    if($_POST['id'] != "" && $_POST['fname'] != "" && $_POST['lname'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['conPassword'] != ""){
        //get data from the form
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conPassword = $_POST['conPassword'];
       
        //regex pattern
        $idPattern = "/^\d+$/";
        $namePattern = "/^\s+|\s+$|\s{2,}|[0-9]+|^\-+|\-$|\-{2,}|[^a-zA-Z\s\-]/";
        $usernamePattern = "/^[a-zA-Z\d\-\_\.@]+$/";
        $passwordPattern = "/^.{5,}$/";

        //check all input if valid
        if(preg_match($idPattern, $id)){
            $isIdValid = true;
        }else{
            $isIdValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=id&fname=$fname&lname=$lname&username=$username");
            exit();
        }

        if(preg_match($namePattern, $fname) == 0){
            $isFnameValid = true;
        }else{
            $isFnameValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=fname&id=$id&lname=$lname&username=$username");
            exit();
        }

        if(preg_match($namePattern, $lname) == 0){
            $isLnameValid = true;
        }else{
            $isLnameValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=lname&id=$id&fname=$fname&username=$username");
            exit();
        }

        if(preg_match($usernamePattern, $username)){
            $isUsernameValid = true;
        }else{
            $isUsernameValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=username&id=$id&fname=$fname&lname=$lname");
            exit();
        }

        if(preg_match($passwordPattern, $password)){
            $isPasswordValid = true;
        }else{
            $isPasswordValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=password&id=$id&fname=$fname&lname=$lname&username=$username");
            exit();
        }

        if(preg_match($passwordPattern, $conPassword)){
            $isConPasswordValid = true;
        }else{
            $isConPasswordValid = false;
            //redirect to signup.php
            header("Location: ../signup.php?errorMsg=conPassword&id=$id&fname=$fname&lname=$lname&username=$username");
            exit();
        }


        if($isIdValid && $isFnameValid && $isLnameValid && $isUsernameValid && $isPasswordValid && $isConPasswordValid){
            //check if employee information is existing
            $sqlCheckEmp = "SELECT * FROM employee_info WHERE id = '$id' AND first_name = '$fname' AND last_name = '$lname'";
            $employeeData = $con->query($sqlCheckEmp) or die ($con->error);
            $countEmp = $employeeData->num_rows;

            if($countEmp > 0){
                $sqlCheckUser = "SELECT * FROM user WHERE username = '$username'";
                $user = $con->query($sqlCheckUser) or die ($con->error);
                $rowUser = $user->fetch_assoc();
                $totalUser = $user->num_rows;
        
                //check if username existing
                if($totalUser > 0){
                    //redirect to signup.php
                    header("Location: ../signup.php?errorMsg=userTaken&id=$id&fname=$fname&lname=$lname&username=$username");
                    exit();
                }elseif($password != $conPassword){//check if password and confirm password match
                    //redirect to signup.php
                    header("Location: ../signup.php?errorMsg=passNotMatch&id=$id&fname=$fname&lname=$lname&username=$username");
                    exit();
                }else{
                    //default value of access and status
                    $access = "regular";
                    $status = 3;

                    //hash password before inserting to database
                    $hash_password = sha1($password);
        
                    //query for inserting data into database
                    $sql = "INSERT INTO `user`(`username`, `password`,`access`, `status`, `employee_id`) 
                    VALUES ('$username', '$hash_password', '$access', '$status', '$id')";
        
                    //insert data into database
                    $con->query($sql) or die ($con->error);
        
                    //redirect to index.php
                    header("Location: ../login.php");
        
                }
            }else{
                //if employee not existing redirect to signup.php
                header("Location: ../signup.php?errorMsg=dataNotFound&id=$id&fname=$fname&lname=$lname&username=$username");
                exit();
            }
        }
    }else{
        //if some of field is no value redirect to signup.php
        header("Location: ../signup.php?errorMsg=fillUpAll&id=$id&fname=$fname&lname=$lname&username=$username");
        exit();
    }
}

?>