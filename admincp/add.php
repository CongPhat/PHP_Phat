<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" >
    
    <link rel="stylesheet" href="./../css/dashboard.css">
    <title>Add Product</title>
</head>
<body>
    <?php 
        require('./../connect/dbConn.php');
        session_start();
        
        $errorName = '';
        $errorQuality = '';

        if(isset($_POST['btn_submit_add'])) {
            $name = $_POST['nameProduct'];
            $quality = $_POST['qualityProduct'];
            $status = $_POST['statusProduct'];
            $statusInt = (int)$status;

            if(empty($name)) {
                $_SESSION['errorName'] = 'Please Enter Name Product';
            } else {
                $_SESSION['errorName'] = '';
            }

            if(empty($quality)) {
                $_SESSION['errorQuality'] = 'Please Enter Quality Product';
            } else {
                $_SESSION['errorQuality'] = '';
            }

            if(!empty($name) && !empty($quality)) {
                $sql = "INSERT INTO products (name_product, quality_product, status) values ('$name', '$quality', '$statusInt')";
                $result = mysqli_query($conn, $sql);
                header('location:dashboard.php');
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errorName = $_SESSION['errorName'];
            $errorQuality = $_SESSION['errorQuality'];
        }
        mysqli_close($conn);
    ?>

    <section class='dashboard'>
        <div class='container'>
            <div class='dashboard_wrapper'>
                <div class='dashboard_inner'>
                    <div class='dashboard_title'>
                        <h1>Add Product</h1>
                    </div>
                    <div class='dashboard_main'>
                        <div class='dashboard_main_inner'>
                            <form action="add.php" method='POST' class='dashboard_form'>
                                <div class='group'>
                                    <label for="name_product">Name Product:</label>
                                    <input type="text" name='nameProduct' id='name_product'/>
                                    <span class='error'><?php echo $errorName?></span>
                                </div>
                                <div class='group'>
                                    <label for="quality_product">Quality Product:</label>
                                    <input type="text" name='qualityProduct' id='quality_product'/>
                                    <span class='error'><?php echo $errorQuality?></span>
                                </div>
                                <div class='group'>
                                    <label for="status_product">Status:</label>
                                    <select name="statusProduct" id="status_product">
                                        <option value="1">Active</option>
                                        <option value="0">No Active</option>
                                    </select>
                                </div>
                                <button type='submit' name='btn_submit_add'>ADD PRODUCT</button>
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