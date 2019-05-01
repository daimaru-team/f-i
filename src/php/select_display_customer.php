<?php

error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json; charset=utf-8');

include "Config.php";
$query="SELECT Cus_ID,CONCAT(Cus_Fname,' ',Cus_Lname)AS CusFullName,Phone_Num,Address,Email,
        IFNULL(Line_userId,'ไม่ได้ทำการเชื่อมต่อ') AS 'Line_userId',Birthday,Create_date 
        FROM `Customer`";

$result = $con->query($query);

$response = array();
 while($row = $result->fetch_assoc()){
   $response[] = $row;
}

for($i=0;$i<COUNT($response);$i++){
      
        $key=$response[$i]['Cus_ID'];
        $query="SELECT Car.Car_ID,Car.License_plate,Car.Cus_ID,
        Car.Body_Num,cm.CM_Name,Car.Model,Car.Car_Year,Car.Color  
        FROM Car, Car_Maker AS cm
        WHERE Car.Brand=cm.CM_ID
        AND Car.Cus_ID='$key'";

        $CarResult = $con->query($query);

        $carRes = array();
        if($CarResult){
                while($row = $CarResult->fetch_assoc())
                        $carRes[] = $row;
        
                if(COUNT($carRes)!=0)
                $response[$i]['Car_Detail']=$carRes;
        }else{
                $response[$i]['Car_Detail']=null;
        }
       

}

echo json_encode($response);
exit();

?>
