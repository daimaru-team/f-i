<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');

header('Content-type: application/json charset=utf-8');

include "Config.php";

$Emp_ID=$_POST['Emp_ID'];
$Emp_PID=$_POST['Emp_PID'];
$Emp_Name=$_POST['Emp_Name'];
$Emp_Lname=$_POST['Emp_Lname'];
$Pos_ID=$_POST['Pos_ID'];
$Nickname=$_POST['Nickname'];
$Birthday=$_POST['Birthday'];
$Start_Date=$_POST['Start_Date'];
$Salary=$_POST['Salary'];
$Emp_Type=$_POST['Emp_Type'];
$Address=$_POST['Address'];
$Phone_Num=$_POST['Phone_Num'];
$Email=$_POST['Email'];
$LineID=$_POST['LineID'];
$speciality=$_POST['speciality'];

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $query_CusTB="INSERT INTO `Employee`(`Emp_ID`, `Emp_PID`, `Emp_Name`, `Emp_Lname`, `Pos_ID`, `Nickname`, `Birthday`, `Start_Date`, 
    `Salary`, `Emp_Type`, `Address`, `Phone_Num`, `Email`, `LineID`, `speciality`) 
    VALUES ('".$Emp_ID."','".$Emp_PID."','".$Emp_Name."','".$Emp_Lname."','".$Pos_ID."','".$Nickname."','".$Birthday."','".$Start_Date."'
    ,'".$Salary."','".$Emp_Type."','".$Address."','".$Phone_Num."','".$Email."','".$LineID."','".$speciality."')";
    
    $re_cus=$con->query($query_CusTB);

    if($re_cus)
    {
        echo "Success query_CusTB \r\n".$re_cus."\r\n";
    }    
    else{
        echo "Error Customer".$re_cus."\r\n";
    }



function GenerateWID($con){
    $query="SELECT COUNT(*) AS TOTAL FROM `WorkInProcess`";
    $result = $con->query($query);
    
    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=1+(int)$response[0]['TOTAL'];
    $genID="WID";
    $loopgen=7-strlen((string)$calID);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$calID;
    
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