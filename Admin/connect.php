<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';//data base ko có mk
    $database = 'btl_web';

    $conn = new mysqLi($server,$user,$pass,$database);
    if ($conn){
        mysqli_query($conn,"SET NAMES 'utf8' ");
    }
    else{
        echo "Kết nối thất bại <br>";
    }
?>