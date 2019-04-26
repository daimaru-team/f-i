<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
//header('Content-Type:multipart/form-data');
$name=$_POST['name'];

echo "name= = = = ".$name;
$img_name=$_FILES['file']['name'];
if (move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$_FILES['file']['name'])) {
    echo "done";
    exit;
}
echo "failed";
exit();

?>