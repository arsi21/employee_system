<?php 
    //include server partial
    include_once("connection.php");

    //start connection
    $con = connection();

	// SESSION
	session_start();
	
	mysqli_query($con, "UPDATE user SET lock_date = '', status = '3' WHERE username = '$_SESSION[username]'");
 ?>