<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";

$query="SELECT * FROM `Timeline_Report` ORDER BY DateTime_Created DESC";
mysqli_set_charset($con,"utf8");
$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}

for($i=0;$i<COUNT($response);$i++){
    $key=$response[$i]['Report_ID'];
    $total=$response[$i]['Pic_total'];
    if((int)$total!=0){
        $queryPic="SELECT * FROM Timeline_image WHERE Report_ID='$key'";
        $resultPic = $con->query($queryPic);

        $imagedata = array();
        while($row = $resultPic->fetch_assoc()){
          $imagedata[] = $row;
        }
        $response[$i]['Pic_data']=$imagedata;
    }else{
      $response[$i]['Pic_data']="0";
    }
}

echo json_encode($response);
exit();
?>

