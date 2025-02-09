<?php
    $server = 'localhost';
    $user = 'root';
    $pass = '';//data base ko có mk
    $database = 'btl_web';

    $conn = new mysqLi($server,$user,$pass,$database);
        mysqli_query($conn,"SET NAMES 'utf8' ");
?>