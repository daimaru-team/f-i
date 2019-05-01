<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');
include "Config.php";
// $datajson="[{"Emp_ID":"10102","Emp_PID":"3333333333333",
//     "Emp_Name":"phonpisud","Emp_Lname":"sumagsa","Pos_ID":"CEO",
//     "Nickname":"ing","Birthday":"1980-03-02","Start_Date":"2019-03-31",
//     "Salary":"30000","Emp_Type":"FT",
//     "Phone_Num":"0999999999","Email":"ing@mail.com","LineID":"ingza555","speciality":null}]";
// $data=json_decode($_POST['data_insert'],true);


//($Cus_ID,$Cus_Name,$Cus_Lname,$Cus_Tel,$Address,$Email,$LineID,$Birthday,CURRENT_DATE())
//cus-----------------------------------------------------
$Cus_ID="1111111111111";//pid
$Cus_Fname = "anupha";
$Cus_Lname  = "supri";
$Address  = "asdc saddasdzcds asdsasdasdas123";
$Email  = "test@mail.com";
$LineID  = "rak";
$Cus_Tel = "0911111111";
$Birthday = "19930404";
//car-----------------------------------------------------
$W_ID=GenerateWID($con);
$Cm_ID  = "HON"; //brand
$Car_ID=GenerateCar_ID($con,$Cm_ID); //ใช้วิธี select count ละเอามาบวก 1 แล้ว genstring โดยการนับตำแหน่งอักษร
$Model  = "Jazz";
$Car_Color  = "แดง";
$License_Plete = "กท 123";
$Year  = "2019";
$Tank_Num = "sad2124afas23233";
$Broken_List="สตาร์ทไม่ติด เครื่องหลวม";

//backend---------------------------------------------------------
$Create_date  = "20190502";
$Start_Date  = "20190502";
$Finish_Date = "20190610";
$Emp_ID_Owner = "10101";
$Remark= "";

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$Email='feen@hotmail.com';

$query="UPDATE `Customer` SET `Cus_Fname`='".$Cus_Fname."',`Cus_Lname`='$Cus_Lname',`Phone_Num`='$Cus_Tel',`Address`='$Address',`Email`='$Email',`LineID`='$LineID',
`Birthday`='$Birthday',`Create_date`='$Create_date' WHERE `Cus_ID`='$Cus_ID'";

$re_cus=$con->query($query);

if($re_cus){
    echo "1";
}    
else{
    echo "0";
}


function GenerateWID($con){
    $query="SELECT COUNT(*) AS TOTAL FROM `WorkInProcess`";
    $result = $con->query($query);
    
    $response = array();
     while($row = $result->fetch_assoc())
       $response[] = $row;

    $calID=(int)$response[0]['TOTAL'];
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