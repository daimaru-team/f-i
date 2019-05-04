<?php
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json charset=utf-8');

include "Config.php";
$Cus_ID='PFR5350709';
//($Cus_ID,$Cus_Name,$Cus_Lname,$Cus_Tel,$Address,$Email,$LineID,$Birthday,CURRENT_DATE())
//cus-----------------------------------------------------
// $Cus_Name = $_POST['Cus_Name'];
// $Cus_Lname = $_POST['Cus_Lname'];
// $Address = $_POST['Address'];
// $Email = $_POST['Email'];
// $LineID = $_POST['LineID'];
// $Cus_Tel=$_POST['Tel'];
// $Birthday = $_POST['Birthday'];

$Cus_Name = "bryan";
$Cus_Lname = "Oconer";
$Address = "42 assadasdasdzxczsfdasrwqewqweqewq";
$Email = "Oconer@mail.com";
$LineID = "zaza010";
$Cus_Tel="0931222423";
$Birthday = "19910201";

//(HON00010,$License_Plete,$Cus_ID,$Tank_Num,$Cm_ID,$Model,$Year,$Car_Color)

//car-----------------------------------------------------
// $Cm_ID = $_POST['Cm_ID']; //brand
// $Model = $_POST['Model'];
// $Car_Color = $_POST['Car_Color'];
// $License_Plete = $_POST['License_Plete'];
// $Year = $_POST['Year'];
// $Tank_Num = $_POST['Tank_Num'];
// $Broken_List = $_POST['ฺBroken_List'];

$Cm_ID = 'HON'; //brand
$Model = 'Accord';
$Car_Color = 'qweqweasdassd';
$License_Plete = 'ถน 321';
$Year = '2010';
$Tank_Num = 'wqswqe-213412434324a112a';
$Broken_List = "wqewqeqw";

//backend---------------------------------------------------------
// $Start_Date = $_POST['Start_Date'];
// $Finish_Date = $_POST['Finish_Date'];
// $Emp_ID_Owner = $_POST['Phone_Num'];
// $Remark=$_POST['Remark'];

$Start_Date = '20190405';
$Finish_Date = '20190410';
$Emp_ID_Owner = '10101';
$Remark='';


if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully \r\n";


$query_CusTB="INSERT INTO Customer(Cus_ID, Cus_Fname, Cus_Lname, Phone_Num, Address, Email, LineID, Birthday, Create_date) VALUES ('".$Cus_ID."','".$Cus_Name."','".$Cus_Lname."','".$Cus_Tel."','".$Address."','".$Email."','".$LineID."','".$Birthday."',CURRENT_DATE());";

$re_cus=$con->query($query_CusTB);


echo "\r\n".$query_CusTB;
if($re_cus)
{
    echo "Success query_CusTB \r\n".$re_cus."\r\n";
}    
else{
    echo "Error Customer".$re_cus."\r\n";
}
$query_WIP="INSERT INTO WorkInProcess(W_ID, Car_ID, Cus_ID, W_Desc, Emp_ID, Status, Start_Date, Finish_Date, Note) VALUES ('WID0000104','HON00010','".$Cus_ID."','".$Broken_List."','".$Emp_ID_Owner."','INPRO','".$Start_Date."','".$Finish_Date."','".$Remark."');";

$re_cus=$con->query($query_WIP);
echo "\r\n".$query_WIP;

if($re_cus){
    echo "Success WIP \r\n".$re_cus."\r\n";
}    
else{
    echo "Error Customer \r\n".$re_cus."\r\n";
}


$query_Car="INSERT INTO Car(Car_ID, License_plate, Cus_ID, Body_Num, Brand, Model, Car_Year, Color) VALUES ('HON00010','".$License_Plete."','".$Cus_ID."','".$Tank_Num."','".$Cm_ID."','".$Model."','".$Year."','".$Car_Color."')";
$re_car=$con->query($query_Car);
echo "\r\n".$query_Car;
if($re_car){
    echo "Success car \r\n".$re_cus."\r\n";
}    
else{
    echo "Error Customer \r\n".$re_cus."\r\n";
}
exit();
?>
