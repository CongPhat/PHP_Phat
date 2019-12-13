<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" >
    
    <link rel="stylesheet" href="./../css/dashboard.css">
    <title>Quan Ly San Pham</title>
</head>
<body>
    <?php 
        require('./../connect/dbConn.php');
        include('checkuser.php');
        $user = $_SESSION['user'];
    ?>

    <section class='dashboard'>
        <div class='container'>
            <div class='dashboard_wrapper'>
                <div class='dashboard_inner'>
                    <div class='dashboard_title'>
                        <h1>Dashboard</h1>
                    </div>
                    <div class='dashboard_top'>
                        <div class='user'>
                            <h4>Hello: <?php echo $user['username']?></h4>
                        </div>
                        <div class='add_product'>
                            <a href="./add.php">Add Product</a>
                        </div>
                    </div>
                    <div class='title'>
                        <div class='row justify-content-center align-items-center'>
                            <div class='col-md-3 item_title'>
                                <h4 class='name_title'>Id</h4>
                            </div>
                            <div class='col-md-4 item_title'>
                                <h4 class='name_title'>Name</h4>
                            </div>
                            <div class='col-md-3 item_title'>
                                <h4 class='name_title'>Quality</h4>
                            </div>
                            <div class='col-md-1 item_title'>
                                <h4 class='name_title'>Edit</h4>
                            </div>
                            <div class='col-md-1 item_title'>
                                <h4 class='name_title'>Delete</h4>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $sql = 'SELECT * FROM products where status = 1';
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) {
                    ?>

                    <div class='items'>
                        <div class='row justify-content-center align-items-center'>
                            <div class='col-md-3 item_product'>
                                <h4 class='name_title'><?php echo $row['id']?></h4>
                            </div>
                            <div class='col-md-4 item_product'>
                                <h4 class='name_title'><?php echo $row['name_product']?></h4>
                            </div>
                            <div class='col-md-3 item_product'>
                                <h4 class='name_title'><?php echo $row['quality_product']?></h4>
                            </div>
                            <div class='col-md-1 item_product'>
                                <a href="./delete.php?id=<?php echo $row['id']?>"><i class="fas fa-trash"></i></a>
                            </div>
                            <div class='col-md-1 item_product'>
                                <a href="./edit.php?id=<?php echo $row['id']?>"><i class="fas fa-edit"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
        mysqli_close($conn);
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>