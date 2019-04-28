<?php
include "Config.php";
$query = "SELECT Car_ID FROM Car WHERE Car_ID LIKE '%MIS%' ORDER BY Car_ID ASC"; 
  // GET THE LAST ID MAKE SURE IN TABLE YOU 9991
  $result = $con->query($query);

  $response = array();
   while($row = $result->fetch_assoc()){
     $response[] = $row;
  }
 echo json_encode($response);

?>