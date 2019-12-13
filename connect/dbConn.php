<?php 
    $server = 'localhost';
    $db = 'thiphp';
    $user = 'root';
    $pass = '';

    $conn = mysqli_connect($server, $user, $pass, $db);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

?>