<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

//check if the submit button is clicked
if(isset($_POST['submit'])){

    //check if all input field have value
    if($_POST['id'] != "" && $_POST['fname'] != "" && $_POST['lname'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['conPassword'] != ""){
        //regex pattern
        $idPattern = "/^\d+$/";
        $namePattern = "/^\s+|\s+$|\s{2,}|[0-9]+|^\-+|\-$|\-{2,}|[^a-zA-Z\s\-]/";
        $usernamePattern = "/^[a-zA-Z\d\-\_\.@]+$/";
        $passwordPattern = "/^.{5,}$/";

        //check all input if valid
        if(preg_match($idPattern, $_POST['id'])){
            $isIdValid = true;
        }else{
            $isIdValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid ID!
                </div>
            ';
        }

        if(preg_match($namePattern, $_POST['fname']) == 0){
            $isFnameValid = true;
        }else{
            $isFnameValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid First Name!
                </div>
            ';
        }

        if(preg_match($namePattern, $_POST['lname']) == 0){
            $isLnameValid = true;
        }else{
            $isLnameValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid Last Name!
                </div>
            ';
        }

        if(preg_match($usernamePattern, $_POST['username'])){
            $isUsernameValid = true;
        }else{
            $isUsernameValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid Username!
                </div>
            ';
        }

        if(preg_match($passwordPattern, $_POST['password'])){
            $isPasswordValid = true;
        }else{
            $isPasswordValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid Password!
                </div>
            ';
        }

        if(preg_match($passwordPattern, $_POST['conPassword'])){
            $isConPasswordValid = true;
        }else{
            $isConPasswordValid = false;
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Invalid Confirm Password!
                </div>
            ';
        }


        if($isIdValid && $isFnameValid && $isLnameValid && $isUsernameValid && $isPasswordValid && $isConPasswordValid){
            //get data from the form
            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conPassword = $_POST['conPassword'];

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
                    $errorMsg = '
                        <div class="alert alert-warning" role="alert">
                            Username is already taken!
                        </div>
                    ';
                }elseif($password != $conPassword){//check if password and confirm password match
                    $errorMsg = '
                        <div class="alert alert-warning" role="alert">
                            Password and confirm password did not match!
                        </div>
                    ';
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
                    header("Location: ../client/login.php");
        
                }
            }else{
                //if employee not existing show error
                $errorMsg = '
                        <div class="alert alert-danger" role="alert">
                            Data not found! Make sure you type your information correctly.
                        </div>
                ';
            }
        }
    }else{
        $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Fill up all field!
                </div>
        ';
    }
}

?>