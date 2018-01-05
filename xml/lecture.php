<?php
    $dom = simplexml_load_file('lectures.xml');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lectures</title>
</head>
<body>
    <h1>Lectures</h1>
    <ul>
    <?php 
      foreach($dom->lecture as $lecture){
        print("<li>");
        print($lecture["number"]);
        print(": ");
        print($lecture->title);
        print("<ul>");
        foreach ($lecture->resources->resource as $resource){
            print("<li>");
            print($resource['name']);
            print(": ");
            foreach ($resource->format as $format){
                $path = $format["path"];
                print("<a href='$path'>");
                print($format["label"]);
                print("</a>");
                print('<a href="$path">');
                print($format["label"]);
                print("</a>");
                print(" | ");
            }
            print("</li>");
        }
        print("</ul>");            
        print("</li>");
      }  
    ?>
    </ul>
</body>
</html>