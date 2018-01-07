<?php
require('../lib/helper.php');
setHeader("Mysql");
?>
<h1>mysql</h1>
<?php
    $dom = simplexml_load_file('characters.xml');
    $characterId = "Adol";
    $result = $dom->xpath("/characters/character[@id='$characterId']");
?>
<?= $result[0]->name ?>
<?php
setFooter();
?>