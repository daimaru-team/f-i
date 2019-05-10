<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
//header('Content-Type:multipart/form-data');
include "Config.php";


// $img_name=$_FILES['file']['name'];
$name=$_POST['name'];
$img_name=$name.GenerateImgName($con);


$W_ID=$_POST['W_ID'];
$Report_ID=GetReport_ID($con);

$Upload_DateTime=$_POST['Upload_DateTime'];
$DirectoryName="uploads/report_img/".$W_ID;

if (!file_exists($DirectoryName)) {
    mkdir($DirectoryName, 0777, true);
    // echo "create new directory \r\n";
}else{
    // echo "using old directory \r\n";
}


if (move_uploaded_file($_FILES["file"]["tmp_name"],$DirectoryName."/".$img_name)) {
    // echo "\r\n done";
    $img_path=$DirectoryName."/".$img_name;
    $check=insert_img($con,$W_ID,$Report_ID,$img_name,$img_path,$Upload_DateTime);
}
echo $check;

function insert_img($con,$W_ID,$Report_ID,$img_name,$img_path,$Upload_DateTime){
    $query="INSERT INTO `Timeline_image`(`img_ID`, `W_ID`, `Report_ID`, `img_name`, `img_path`, `Upload_DateTime`) 
    VALUES (null,'".$W_ID."','".$Report_ID."','".$img_name."','".$img_path."','".$Upload_DateTime."')";
    $result=$con->query($query);

    if($result){
        return "1";
        // echo "\r\n insert done";
    }else{
        return "0";
        // echo "\r\n insert Error";
    }
      
}

function GenerateImgName($con){
    $query="SELECT COUNT(*) AS TOTAL FROM `Timeline_image`";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=1+(int)$response[0]['TOTAL'];
    $genID="_IMG";
    $loopgen=4-strlen((string)$calID);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$calID;
    $genID.=".jpg";
    return $genID;
}


function GetReport_ID($con){
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

exit();
// $imagename = $_FILES['new_image']['name'];
// $source = $_FILES['new_image']['tmp_name'];
// $target = "temp/".$imagename;

?>