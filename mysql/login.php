<?php
session_start();
require('../lib/helper.php');
require('../etc/include.php');
setHeader("Mysql-login");
?>
<h1>mysql-login</h1>
<?php
$login = FALSE;
if(isset($_SESSION['auth']) && $_SESSION['auth'] == TRUE){
    $login = TRUE;
}
if(isset($_POST['user']) && isset($_POST['pwd'])){
    $connection = mysql_connect(HOST,USER);
    if($connection === FALSE){
        die("Could not connect to database" . mysql_error());
    }
    if(mysql_select_db(DB,$connection) === FALSE){
        die("Could not select database" . mysql_error());
    }
    $pass = mysql_real_escape_string($_POST['pwd']);
    $sql = sprintf("SELECT 1 FROM users WHERE user = '%s' AND pass = AES_ENCRYPT('%s','%s')",mysql_real_escape_string($_POST['user']),$pass,$pass);
    $result = mysql_query($sql);
    echo $result;
    if($result === FALSE){
        die("Could not query database" . mysql_error());
    }
    if(mysql_num_rows($result)==1){
        $_SESSION['auth'] = true;
        $login = true;
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
    <?php if($login): ?>
    <div>logged!</div>
    <?php else: ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div><label>user name:<input name="user" /></label></div>
        <div><label>password:<input name="pwd" /></label></div>
        <div><input type="submit" value="login"></div>        
    </form>
    <?php endif; ?>
</body>
</html>
<?php
setFooter();
?>