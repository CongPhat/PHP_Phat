<?php 
    require('./../connect/dbConn.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location:dashboard.php');
    }

    $sql = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    header('location:dashboard.php');

    mysqli_close($conn);
?>