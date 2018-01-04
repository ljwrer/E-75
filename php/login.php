<?php
    define('USER','ray');
    define('PWD','123');
    session_start();
    if(isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
        $host = $_SERVER['HTTP_HOST'];
        $path = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("Location: http://$host$path/home.php");
    }
    $wrongLogin = FALSE;
    $userCache = '';
    if(isset($_POST['user']) && isset($_POST['pwd'])){
        $userCache = htmlspecialchars($_POST['user']);          
        if($_POST['user'] == USER && $_POST['pwd'] == PWD){
            $_SESSION['auth'] = TRUE;
            $_SESSION['user'] = $userCache;
            $host = $_SERVER['HTTP_HOST'];
            $path = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("Location: http://$host$path/home.php");
            exit;
        }else{  
            $wrongLogin = TRUE;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div><label>user name:<input name="user" value="<?= $userCache ?>" /></label></div>
        <div><label>password:<input name="pwd" /></label></div>
        <div><input type="submit" value="login"></div>        
    </form>
    <?php if($wrongLogin):  ?>
        <p>wrong user name or password</p>
    <?php endif;  ?>
</body>
</html>