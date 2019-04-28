<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
//header('Content-Type:multipart/form-data');
include "Config.php";

$name=$_POST['name'];
$datetime=$_POST['datetime'];
 $fp = fopen($_FILES["file"]["tmp_name"],"r");
$ReadBinary = fread($fp,filesize($_FILES["file"]["tmp_name"]));
fclose($fp);
// $photo  = addslashes($ReadBinary);
$photo = base64_encode($ReadBinary);

// echo $photo;

$strSQL="INSERT INTO Timeline_image (`img_ID`, `W_ID`, `Report_ID`, `img_name`, `img_data`, `Upload_DateTime`) 
VALUES (null,'WID0000101','22','".$name."','".$photo."','".$datetime."')";

 $re_cus=$con->query($strSQL);
 if($re_cus)
     echo "1";
 else
     echo $strSQL;
    
exit();
?>