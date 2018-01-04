<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION['auth'])||$_SESSION['auth']!=TRUE){
            $host = $_SERVER['HTTP_HOST'];
            $path = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("Location: http://$host$path/login.php");
        }
    ?>
    <p>welcome! <?= $_SESSION['user'] ?></p>
</body>
</html>