<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";

$genW_ID=GenerateWID($con);
$cm_id="HON";
$genCar_ID=GenerateCar_ID($con,$cm_id);
echo "W_ID =".$genW_ID;
echo "Car_ID = ".$genCar_ID;

function GenerateWID($con){
    $query="SELECT COUNT(*) AS TOTAL FROM `WorkInProcess`";
    $result = $con->query($query);
    
    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;
          
    // $getvaluecal=(int)$_GET['getdata'];
    // echo $getvaluecal."=get \r\n";

    $calID=1+(int)$response[0]['TOTAL'];
    
    // echo "len CalID =".strlen((string)$calID);
    $genID="WID";
    $loopgen=7-strlen((string)$calID);
    for($i=0;$i<$loopgen;$i++){
        $genID.="0";
    }
    
    $genID.=(string)$calID;
    // echo "\r\n new W_ID =".$genID;
    
    return $genID;
}

function GenerateCar_ID($con, $cm_id){
    $query="SELECT COUNT(*) AS TOTAL  FROM Car WHERE Brand='$cm_id'";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=1+(int)$response[0]['TOTAL'];

    $genID=$cm_id;
    $loopgen=5-strlen((string)$calID);
    for($i=0;$i<$loopgen;$i++)
        $genID.="0";
    
    $genID.=(string)$calID;
    
    return $genID;
}
exit();

?>