<?php
    $dom = simplexml_load_file('http://news.qq.com/newsgn/rss_newsgn.xml');
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
    <ul>
    <?php foreach($dom->channel->item as $item): ?>
        <li>
        <a href="<?= $item->link ?>">
            <?= htmlspecialchars($item->title) ?>
        </a>
        </li>
    <?php endforeach  ?>
    </ul>
</body>
</html>