<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.css">
    <title>Login</title>
</head>
<body>
    <?php

        require('./connect/dbConn.php');
        session_start();

        $errorUsername = '';
        $errorPassword = '';
        $userNameCurrent = '';


        if(isset($_POST['btn_submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username)){
                $_SESSION['errorUsername'] = 'Please Enter Username !';
            } else {
                $_SESSION['errorUsername'] = '';
            }

            if (empty($password)){
                $_SESSION['errorPassword'] = 'Please Enter Password !';
                $_SESSION['userNameCurrent'] = $username = $_POST['username'];
            } else {
                $_SESSION['userNameCurrent'] = $username = $_POST['username'];
                $_SESSION['errorPassword'] = '';
            }
            
            if(!empty($username) && !empty($password)) {
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 0) {
                    $_SESSION['errorUsername'] = 'Username does not exist !';
                } else if(mysqli_num_rows($result) > 1) {
                    $_SESSION['errorUsername'] = 'Duplicate account !';
                } else {
                    $row = mysqli_fetch_assoc($result);
                    if($row['password'] != md5($password)) {
                        $_SESSION['errorPassword'] = 'Wrong Password !';
                    } else {
                        $session_user = [
                            'id' => $row['id'],
                            'username' => $row['username']
                        ];
                        $_SESSION['user'] = $session_user;
                        header('location:./admincp/dashboard.php');
                    };
                }
            }
        }
        mysqli_close($conn);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errorUsername = $_SESSION['errorUsername'];
            $errorPassword = $_SESSION['errorPassword'];
            $userNameCurrent = $_SESSION['userNameCurrent'];
        }
        
    ?>
    <section class='login'>
        <div class='container'>
            <div class='login_wrapper'>
                <div class='login_inner'>
                    <div class='title_login'>
                        <h4 class='title'>Login Account</h4>
                    </div>
                    <form action="index.php" method='post' id='login' name='login' class='form_login'>
                        <div class='login_group'>
                            <label for="username">Username:</label>
                            <input type="text" value='<?php echo $userNameCurrent?>' id='username' name='username'/>
                            <span class='error'><?php echo $errorUsername ?></span>
                        </div>
                        <div class='login_group'>
                            <label for="password">Password:</label>
                            <input type="text" value='' id='password' name='password'/>
                            <span class='error'><?php echo $errorPassword ?></span>
                        </div>
                        <button type='submit' name='btn_submit'>LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>