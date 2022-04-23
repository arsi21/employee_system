<?php 
//include server partial file
include_once ("connection.php");

//start the connection
$con = connection();

//check if the submit button is clicked
if(isset($_POST['signup'])){

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['conPassword'])){
        //get data from the form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conPassword = $_POST['conPassword'];

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
            $access = "regular";

            //query for inserting data into database
            $sql = "INSERT INTO `user`(`username`, `password`,`access`) 
            VALUES ('$username', '$password', '$access')";

            //insert data into database
            $con->query($sql) or die ($con->error);

            //redirect to index.php
            header("Location: ../client/login.php");

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