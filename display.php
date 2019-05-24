<html>
    <head></head>
    <body>
        <?php

            $mysqli = new mysqli('localhost','root','root','images') or die($mysqli->connect_error);
            $table = 'cats';

            $result = mysqli->query("SELECT * FROM $table") or die($mysqli->error);

            while($date = $result->fetch_assoc()){
                echo "<h2>{$date['name']}</h2>";
                echo "<img src='{$date['img_dir']}' width='40%' height='40%'>";
            }
        ?>
    </body>
</html>