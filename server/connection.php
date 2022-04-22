<?php 

    function connection(){
        $serverName = "localhost";
        $username = "root";
        $password = "";
        $dbName = "employee_system";

        //create connection
        $con = new mysqli($serverName, $username, $password, $dbName);

        //check connection
        if($con->connect_error){
            die("Connection failed: " . $con->connect_error);
        }else{
            return $con;
        }
    }

?>