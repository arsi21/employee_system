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
    }else{
        $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    Fill up all field!
                </div>
        ';
    }
}

?>