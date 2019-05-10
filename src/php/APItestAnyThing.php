<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

// $W_ID='WID0000107';
// $Status='2';
echo GenerateReport_ID($con);

// echo "\r\n".$W_ID."\r\n";
// $query="UPDATE `WorkInProcess` SET `Status`='$Status' WHERE `W_ID`='$W_ID'";
// echo "\r\n".$query."\r\n";
// $result=$con->query($query);

// if($result){
//     echo "1";
//     echo "\r\n".$query;
// }else{
//     echo "0";
// }

function GenerateReport_ID($con){
    $query="SELECT * FROM `Timeline_Report` ORDER BY DateTime_Created DESC LIMIT 1";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=$response[0]['Report_ID'];
    $cutStr=str_replace("REP","",$calID);
    $int = (int) filter_var($calID, FILTER_SANITIZE_NUMBER_INT);
    
    $genID="REP";
    $loopgen=7-strlen((string)$int);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$int;
    return $genID;
}


function GenerateUserLogIn($con,$Cus_ID,$tel,$Email){
    
    $queryUser="INSERT INTO `users`(`id`, `User_Login`, `password`, `Owner_ID`, `User_Type`) VALUES (NULL,'".$Email."','".$tel."','".$Cus_ID."','Customer')";
    $reUser=$con->query($queryUser);

    if($reUser){
        echo "\r\nSuccess User= ".$queryUser."\r\n";
        return true;
    }else{
        return false;
        echo "\r\nError Customer ".$queryUser."\r\n";
    }
}

?>