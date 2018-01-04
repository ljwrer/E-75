<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",TRUE);
    ?>
    <?php
        print "<pre>";
        print_r($_GET);
        print_r($_POST);
        print_r($_REQUEST);
        print_r($_POST["q"]);    
        print "</pre>";
    ?>
    </div>
    <div>
        <?php if(isset($_POST['summer'])): ?>
        <div><b><?= $_POST['summer']  ?></b></div>
        <b>hello,summer!</b>
        <?php endif ?>
        <?php if(@$_POST['summer']): ?>
        <b>hello,summer!</b>
        <?php endif ?>
    </div>
</body>
</html>
