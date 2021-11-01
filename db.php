<?php
    $host = "localhost";
    $user = "freshmar_paw";
    $pass = "MaHENDRaGON19011901";
    $name = "freshmar_paw";
    
    $con = mysqli_connect($host,$user,$pass,$name);
    
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }

    session_start();
?>