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
        $username = $_POST['username'];
        $password = $_POST['password'];

        //sql for getting username
        $check_username = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
        $count_username = mysqli_num_rows($check_username);

        //check if username exist
        if($count_username > 0){
            //check if the username have a status greater that 0
            $check_status = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND status != 0");
            $count_status = mysqli_num_rows($check_status);

            if($count_status > 0){
                //put username in session
                $_SESSION['username'] = $username;

                //check if username and password match
                $check_password = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
                $count_password = mysqli_num_rows($check_password);

                if($count_password > 0){
                    $_SESSION['password'] = $password;

                    //reset status
                    $default_status = 3;
                    mysqli_query($con, "UPDATE user SET status = '$default_status' WHERE username = '$_SESSION[username]'");

                    header("location:home.php");
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
                            $timer = strtotime("now + 10 second");
                            $time_stamp = date('M d, Y h:i:s a', $timer);

                            $update_lock_date = mysqli_query($con, "UPDATE user SET lock_date = '$time_stamp' WHERE username = '$_SESSION[username]'");
                        }else{
                            $errorMsg = '
                                <div class="alert alert-warning" role="alert">
                                    Wrong password!
                                </div>
                            ';
                            $attempt = "Remaining attempt: " . $new_status . "<br><br>";
                        }
                    }
                }
            }
        }else{
            $errorMsg = '
                <div class="alert alert-warning" role="alert">
                    No username found!
                </div>
            ';
        }

    }else{
        $errorMsg = '
            <div class="alert alert-warning" role="alert">
                Complete the information needed!
            </div>
        ';
    }
}

?>