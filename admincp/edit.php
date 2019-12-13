<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" >
    
    <link rel="stylesheet" href="./../css/dashboard.css">
    <title>Edit Product</title>
</head>
<body>
    <?php 
        require('./../connect/dbConn.php');
        session_start();
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            // check id trong Database
            $sqlCheckId = "SELECT * FROM products WHERE id = '$id'";
            $result = mysqli_query($conn, $sqlCheckId);
            if (mysqli_num_rows($result) == 0) {
                header('location:dashboard.php');
            }

        } else {
            header('location:dashboard.php');
        }

        $nameCurrent = '';
        $qualityCurrent = '';
        $statusCurrent = 1;


        //Ban dau` vao trang
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $sqlId = "SELECT * FROM products WHERE id = '$id'";
            $result = mysqli_query($conn, $sqlId);
            $row = mysqli_fetch_assoc($result);
    
            $nameCurrent = $row['name_product'];
            $qualityCurrent = $row['quality_product'];
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST['btn_submit_edit'])) {
                $nameCurrent = $_POST['nameProduct'];
                $qualityCurrent = $_POST['qualityProduct'];
                $statusCurrent = $_POST['statusProduct'];
                $statusCurrentInt = (int)$statusCurrent;

                $sql = "UPDATE products 
                        SET name_product = '$nameCurrent', quality_product = '$qualityCurrent', status = '$statusCurrentInt'
                        WHERE id = '$id'";

                $result = mysqli_query($conn, $sql);
                header('location:dashboard.php');
            }

        }
        mysqli_close($conn);
    ?>

    <section class='dashboard'>
        <div class='container'>
            <div class='dashboard_wrapper'>
                <div class='dashboard_inner'>
                    <div class='dashboard_title'>
                        <h1>Edit Product</h1>
                    </div>
                    <div class='dashboard_main'>
                        <div class='dashboard_main_inner'>
                            <form action="edit.php?id=<?php echo $id?>" method='POST' class='dashboard_form'>
                                <div class='group'>
                                    <label for="name_product">Name Product:</label>
                                    <input type="text" name='nameProduct' id='name_product' value='<?php echo $nameCurrent?>'/>
                                    <span class='error'></span>
                                </div>
                                <div class='group'>
                                    <label for="quality_product">Quality Product:</label>
                                    <input type="text" name='qualityProduct' id='quality_product' value='<?php echo $qualityCurrent?>'/>
                                    <span class='error'></span>
                                </div>
                                <div class='group'>
                                    <label for="status_product">Status:</label>
                                    <select name="statusProduct" id="status_product">
                                        <option value="1">Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                </div>
                                <button type='submit' name='btn_submit_edit'>Edit Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>