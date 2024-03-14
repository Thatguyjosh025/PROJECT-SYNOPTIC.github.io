<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "users";
    
    $conn = mysqli_connect($servername,$username,$password,$db_name,);

    if($conn->connect_error){
        die("Connection Error".$conn->connect_error);
    }
?>