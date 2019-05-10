<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

//($Cus_ID,$Cus_Name,$Cus_Lname,$Cus_Tel,$Address,$Email,$LineID,$Birthday,CURRENT_DATE())
//cus-----------------------------------------------------
$data=json_decode($_POST['data_insert'],true);

$Cus_ID=$data[0]['Cus_ID'];//pid
$Cus_Name = $data[0]['Cus_Name'];
$Cus_Lname = $data[0]['Cus_Lname'];
$Address = $data[0]['Address'];
$Email = $data[0]['Email'];
$LineID = $data[0]['LineID'];
$Cus_Tel=$data[0]['Tel'];
$Birthday = $data[0]['Birthday'];

//car-----------------------------------------------------
$W_ID=GenerateWID($con);
$Cm_ID = $data[0]['Cm_ID']; //brand
$Car_ID=GenerateCar_ID($con,$Cm_ID); //ใช้วิธี select count ละเอามาบวก 1 แล้ว genstring โดยการนับตำแหน่งอักษร
$Model = $data[0]['Model'];
$Car_Color = $data[0]['Car_Color'];
$License_Plete = $data[0]['License_Plete'];
$Year = $data[0]['Year'];
$Tank_Num = $data[0]['Tank_Num'];
$Broken_List=$data[0]['Broken_List'];

//backend---------------------------------------------------------
$Start_Date = $data[0]['Start_Date'];
$Finish_Date = $data[0]['Finish_Date'];
$Emp_ID_Owner = $data[0]['Emp_ID'];
$Remark=$data[0]['Remark'];
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$selectCheck = "SELECT * FROM Customer WHERE Cus_ID='$Cus_ID'";
$resultCus = $con->query($selectCheck);

$checkselect = array();
 while($row = $resultCus->fetch_assoc())
   $checkselect[] = $row;


if(COUNT($checkselect)==0){
    $query_CusTB="INSERT INTO Customer(Cus_ID, Cus_Fname, Cus_Lname, Phone_Num, Address, Email, LineID, Birthday, Create_date) VALUES ('".$Cus_ID."','".$Cus_Name."','".$Cus_Lname."','".$Cus_Tel."','".$Address."','".$Email."','".$LineID."','".$Birthday."','".$Start_Date."');";
    $re_cus=$con->query($query_CusTB);

    if($re_cus)
    {
        // echo "\r\nSuccess query_CusTB ".$query_CusTB."\r\n";
    }    
    else{
        // echo "\r\nError Customer".$query_CusTB."\r\n";
    }
}else{
    // echo "\r\n cus มีอยู้แล้ว";
}

$selectCarCheck = "SELECT * FROM Car WHERE License_plate='$License_Plete'";
$resultCar = $con->query($selectCarCheck);

$carCheck = array();
 while($row = $resultCar->fetch_assoc())
   $carCheck[] = $row;

if(COUNT($carCheck)==0){
    $query_Car="INSERT INTO Car(Car_ID, License_plate, Cus_ID, Body_Num, Brand, Model, Car_Year, Color) VALUES ('".$Car_ID."','".$License_Plete."','".$Cus_ID."','".$Tank_Num."','".$Cm_ID."','".$Model."','".$Year."','".$Car_Color."')";
    $re_car=$con->query($query_Car);
    // echo "\r\n".$query_Car;
    if($re_car){
        // echo "\r\nSuccess car ".$query_Car."\r\n";
    }else{
        // echo "\r\nError Customer ".$query_Car."\r\n";
    }
}else{

    $Car_ID= $carCheck[0]['Car_ID'];
    // echo "\r\n รถ มีอยู้แล้ว";
}


$query_WIP="INSERT INTO WorkInProcess(W_ID, Car_ID, Cus_ID, W_Desc, Emp_ID, Status, Start_Date, Finish_Date, Remark) VALUES ('".$W_ID."','".$Car_ID."','".$Cus_ID."','".$Broken_List."','".$Emp_ID_Owner."','1','".$Start_Date."','".$Finish_Date."','".$Remark."');";

$re_wip=$con->query($query_WIP);

if($re_wip){
    // echo "\r\nSuccess WIP ".$query_WIP."\r\n";
}    
else{
    // echo "\r\nError Customer ".$query_WIP."\r\n";
}
$GenUser=GenerateUserLogIn($con,$Cus_ID,$Cus_Tel,$Email);

function GenerateUserLogIn($con,$Cus_ID,$tel,$Email){
    
    $queryUser="INSERT INTO `users`(`id`, `User_Login`, `password`, `Owner_ID`, `User_Type`) VALUES (NULL,'".$Email."','".$tel."','".$Cus_ID."','Customer')";

    $reUser=$con->query($queryUser);

    if($reUser){
        // echo "\r\nSuccess WIP ".$query_WIP."\r\n";
        return true;
    }else{
        return false;
        // echo "\r\nError Customer ".$query_WIP."\r\n";
    }
}

function GenerateCar_ID($con, $cm_id){
    $query="SELECT * FROM `Car` WHERE Brand LIKE '$cm_id' ORDER BY Car_ID DESC LIMIT 1";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=$response[0]['Car_ID'];
    $int = 1+(int) filter_var($calID, FILTER_SANITIZE_NUMBER_INT);
    
    $genID=$cm_id;
    $loopgen=5-strlen((string)$int);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$int;
    return $genID;
}

function GenerateWID($con){
    $query="SELECT * FROM `WorkInProcess` ORDER BY W_ID DESC LIMIT 1";
    $result = $con->query($query);

    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=$response[0]['W_ID'];
    $int = 1+(int) filter_var($calID, FILTER_SANITIZE_NUMBER_INT);
    
    $genID="WID";
    $loopgen=7-strlen((string)$int);

    for($i=0;$i<$loopgen;$i++)
        $genID.="0";

    $genID.=(string)$int;
    return $genID;
}


exit();
?>