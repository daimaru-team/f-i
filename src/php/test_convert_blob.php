<?php
        require 'connect_db.php';
        if(isset($_POST['submit'])&&(!empty($_FILES['image']['tmp_name'])))
        {
             $pic_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
             $pic_size=$_FILES['image']['size'];
             $query="INSERT INTO `pic-table`      VALUES('','{$pic_data}','{$pic_size['mime']}')";
             mysql_query($query) or die('ERROR: Failed');
         }
        else
       {
             echo 'Please Submit File';
        }
?>