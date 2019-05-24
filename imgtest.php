
<html>
    <head>

    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.js"></script>     </head>
    <body>
        <form action="imgtest.php" method="post" enctype="multipart/form-data">
            <input type="file" name="userfile[]" value="" multiple="">
            <input type="submit" name="submit" value="upload">
        </form>
    </body>


<?php
    $mysqli = new mysqli('localhost','root','root','images') or die($mysqli->connect_error);
    $table = 'cats';

    //$_$FILES global variable
    if(isset($_FILES['userfile'])){
        $file_array = reArrayFiles($_FILES['userfile']);
        //pre_r($file_array)
        for($i=0;$i<count($file_array);$i++){
            if($file_array[$i]['error'])
            {
                ?><div class="alert alert-danger">
                <?php echo $file_array[$i]['name'].'  -  '.$phpFileUploadErrors[$file_array[$i]['error']];
                ?> </div><?php
            }
            else{

                $extensions = array('jpg','png','gif','jpeg');

                $file_ext = explode('-',$file_array[$i]['name']);

                $name = $file_ext[0];
                $name = preg_replace("!-!"," ",$name);
                $name = ucwords($name);

                $file_ext = end($file_ext);

                if(!in_array($file_ext, $extenstions))
                {
                    ?><div class="alert alert-danger">
                    <?php echo "{$file_array[$i]['name']} - Invalid file extension!";
                    ?></div><?php
                }
                else{

                    $img_dir = 'web/'.$file_array[$i]['name'];

                    move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);

                    $sql = "INSERT IGNORE INTO $table (name, img_dir) VALUES('$name', '$img_dir')";
                    $mysqli->query($sql) or die($mysqli->error);

                            ?><div class="alert alert-success">
                            <?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
                            ?></div><?php
                }
            }
        }
    }

?>
</html>