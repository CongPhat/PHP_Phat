<?php 
    session_start();
    if(isset($_SESSION['user'])) {
    } else {
        header('location:./../index.php');
    }

?>