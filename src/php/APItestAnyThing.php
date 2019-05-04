<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
//header('Content-Type:multipart/form-data');
include "Config.php";

echo json_encode($_FILES["file"]);
// if (move_uploaded_file($_FILES["file"]["tmp_name"],$DirectoryName."/".$img_name)) {
//     echo "\r\n done";
 
// }
exit();
// $imagename = $_FILES['new_image']['name'];
// $source = $_FILES['new_image']['tmp_name'];
// $target = "temp/".$imagename;

?>