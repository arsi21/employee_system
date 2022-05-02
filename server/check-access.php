<?php 

//include server partial
include_once("connection.php");

//start connection
 $con = connection();

 //start session
if(!isset($_SESSION)){
    session_start();
}

//check if session username and password has value
if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    //hash password
    $hash_password = sha1($_SESSION['password']);

    //check if username and password match and it has status greater than 0
    $check_user = mysqli_query($con, "SELECT * FROM user WHERE username = '$_SESSION[username]' AND password = '$hash_password' AND status > 0");
    $count_user = mysqli_num_rows($check_user);
    $rowData = mysqli_fetch_array($check_user);

    if($count_user > 0){
        $_SESSION['access'] = $rowData['access'];//set session value
    }else{
        header("location:login.php?errorMsg=loginRequired");
    }
}else{
    header("location:login.php?errorMsg=loginRequired");
}

?>