<?php
    $host="localhost";
    $uname="root";
    $pass="";
    $database="ecommerce";

    $conn=mysqli_connect($host, $uname, $pass, $database);

    if($conn){
        
    }
    else{
        die("Connection failed !");
    }
?>