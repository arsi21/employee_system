<?php 

//include server partial
include_once("connection.php");

//start connection
 $con = connection();

 //start session
 session_start();

 //check if the login button is clicked
if(isset($_POST['loginBtn'])){

    //check if username and password have value
    if($_POST['username'] != "" && $_POST['password'] != ""){
        //get all the input data
        $username = $_POST['username'];
        $password = $_POST['password'];

        //regex pattern
        $usernamePattern = "/^[a-zA-Z\d\-\_\.@]+$/";
        $passwordPattern = "/^.{5,}$/";

        //check if all input are valid
        if(preg_match($usernamePattern, $username)){
            $isUsernameValid = true;
        }else{
            $isUsernameValid = false;

            //redirect to login.php
            header("Location: ../client/login.php?errorMsg=username");
            exit();
        }

        if(preg_match($passwordPattern, $password)){
            $isPasswordValid = true;
        }else{
            $isPasswordValid = false;

            //redirect to login.php
            header("Location: ../client/login.php?errorMsg=password&username=$username");
            exit();
        }

        if($isUsernameValid && $isPasswordValid){
            //put username in session
            $_SESSION['username'] = $username;

            //sql for getting username
            $check_username = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
            $count_username = mysqli_num_rows($check_username);

            //check if username exist
            if($count_username > 0){
                //check if the username have a status greater that 0
                $check_status = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
                $count_status = $check_status->fetch_assoc();

                date_default_timezone_set('Asia/Manila');
                $dateTimeNow = strtotime("now");
                $lockDate = strtotime($count_status['lock_date']);
                
                if($count_status['status'] > 0){
                    //put username in session
                    $_SESSION['username'] = $username;

                    //hash password
                    $hash_password = sha1($password);

                    //check if username and password match
                    $check_password = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$hash_password'");
                    $count_password = mysqli_num_rows($check_password);
                    $user = mysqli_fetch_array($check_password);

                    if($count_password > 0){
                        $_SESSION['password'] = $password;
                        $_SESSION['access'] = $user['access'];
                        $_SESSION['employee_id'] = $user['employee_id'];

                        //reset status
                        $default_status = 3;
                        mysqli_query($con, "UPDATE user SET status = '$default_status' WHERE username = '$_SESSION[username]'");

                        header("location:index.php");
                    }else{
                        //decrement status by 1
                        $get_status = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");

                        while($row = mysqli_fetch_array($get_status)){
                            $current_status = $row['status'];
                            $new_status = $current_status - 1;
                        }

                        $update_status = mysqli_query($con, "UPDATE user SET status = '$new_status' WHERE username = '$_SESSION[username]'");

                        if($update_status){
                            //check if status is 0
                            if($new_status == 0){
                                date_default_timezone_set('Asia/Manila');
                                $timer = strtotime("now + 60 second");
                                $time_stamp = date('M d, Y h:i:s a', $timer);

                                $update_lock_date = mysqli_query($con, "UPDATE user SET lock_date = '$time_stamp' WHERE username = '$_SESSION[username]'");
                            }else{
                                $attempt = "Remaining attempt: " . $new_status;
                                //redirect to login.php
                                header("Location: ../client/login.php?errorMsg=wrongPassword&username=$username&attempt=$attempt");
                                exit();
                            }
                        }
                    }
                
                }elseif($count_status['lock_date'] != ""){
                    //check if lock_date is expired
                    if($dateTimeNow > $lockDate){
                        //hash password
                        $hash_password = sha1($password);

                        //check if username and password match
                        $check_password = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$hash_password'");
                        $count_password = mysqli_num_rows($check_password);
                        $user = mysqli_fetch_array($check_password);

                        //reset the status to 3 and lock_date
                        $default_status = 3;
                        mysqli_query($con, "UPDATE user SET status = '$default_status' WHERE username = '$username'");
                        mysqli_query($con, "UPDATE user SET lock_date = '' WHERE username = '$username'");
                        

                        if($count_password > 0){
                            $_SESSION['password'] = $password;
                            $_SESSION['access'] = $user['access'];
                            $_SESSION['employee_id'] = $user['employee_id'];

                            //reset status
                            $default_status = 3;
                            mysqli_query($con, "UPDATE user SET status = '$default_status' WHERE username = '$_SESSION[username]'");
                            mysqli_query($con, "UPDATE user SET lock_date = '' WHERE username = '$username'");

                            header("location:index.php");
                        }else{
                            //decrement status by 1
                            $get_status = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");

                            while($row = mysqli_fetch_array($get_status)){
                                $current_status = $row['status'];
                                $new_status = $current_status - 1;
                            }

                            $update_status = mysqli_query($con, "UPDATE user SET status = '$new_status' WHERE username = '$username'");

                            if($update_status){
                                //check if status is 0
                                if($new_status == 0){
                                    date_default_timezone_set('Asia/Manila');
                                    $timer = strtotime("now + 60 second");
                                    $time_stamp = date('M d, Y h:i:s a', $timer);

                                    $update_lock_date = mysqli_query($con, "UPDATE user SET lock_date = '$time_stamp' WHERE username = '$username'");
                                }else{
                                    $attempt = "Remaining attempt: " . $new_status;
                                    //redirect to login.php
                                    header("Location: ../client/login.php?errorMsg=wrongPassword&username=$username&attempt=$attempt");
                                    exit();
                                }
                            }
                        }
                    }
                }
            }else{
                //redirect to login.php
                header("Location: ../client/login.php?errorMsg=noUserFound&username=$username");
                exit();
            }

        }
    }else{
        //redirect to login.php
        header("Location: ../client/login.php?errorMsg=completeInfo");
        exit();
    }
}

?>