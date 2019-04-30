<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";

//($Cus_ID,$Cus_Name,$Cus_Lname,$Cus_Tel,$Address,$Email,$LineID,$Birthday,CURRENT_DATE())
//cus-----------------------------------------------------
$Cus_ID=$_POST['Cus_ID'];//pid
$Cus_Name = $_POST['Cus_Name'];
$Cus_Lname = $_POST['Cus_Lname'];
$Address = $_POST['Address'];
$Email = $_POST['Email'];
$LineID = $_POST['LineID'];
$Cus_Tel=$_POST['Tel'];
$Birthday = $_POST['Birthday'];
//car-----------------------------------------------------
$W_ID=GenerateWID($con);
$Cm_ID = $_POST['Cm_ID']; //brand
$Car_ID=GenerateCar_ID($con,$Cm_ID); //ใช้วิธี select count ละเอามาบวก 1 แล้ว genstring โดยการนับตำแหน่งอักษร
$Model = $_POST['Model'];
$Car_Color = $_POST['Car_Color'];
$License_Plete = $_POST['License_Plete'];
$Year = $_POST['Year'];
$Tank_Num = $_POST['Tank_Num'];

//backend---------------------------------------------------------
$Start_Date = $_POST['Start_Date'];
$Finish_Date = $_POST['Finish_Date'];
$Emp_ID_Owner = $_POST['Phone_Num'];
$Remark=$_POST['Remark'];

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
        echo "Success query_CusTB \r\n".$re_cus."\r\n";
    }    
    else{
        echo "Error Customer".$re_cus."\r\n";
    }
}


$query_WIP="INSERT INTO WorkInProcess(W_ID, Car_ID, Cus_ID, W_Desc, Emp_ID, Status, Start_Date, Finish_Date, Remark) VALUES ('".$W_ID."','".$Car_ID."','".$Cus_ID."','".$Broken_List."','".$Emp_ID_Owner."','INPROCESS','".$Start_Date."','".$Finish_Date."','".$Remark."');";

$re_cus=$con->query($query_WIP);

if($re_cus){
    echo "Success WIP \r\n".$re_cus."\r\n";
}    
else{
    echo "Error Customer \r\n".$re_cus."\r\n";
}


$selectCarCheck = "SELECT * FROM Car WHERE License_plate='$License_Plete'";
$resultCar = $con->query($selectCarCheck);

$carCheck = array();
 while($row = $resultCar->fetch_assoc())
   $carCheck[] = $row;

if(COUNT($carCheck)==0){
    $query_Car="INSERT INTO Car(Car_ID, License_plate, Cus_ID, Body_Num, Brand, Model, Car_Year, Color) VALUES ('".$Car_ID."','".$License_Plete."','".$Cus_ID."','".$Tank_Num."','".$Cm_ID."','".$Model."','".$Year."','".$Car_Color."')";
    $re_car=$con->query($query_Car);
    echo "\r\n".$query_Car;
    if($re_car){
        echo "Success car \r\n".$re_cus."\r\n";
    }else{
        echo "Error Customer \r\n".$re_cus."\r\n";
    }
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