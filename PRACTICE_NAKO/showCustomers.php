<?php

require_once("dbConnect.php");
$count = 0;
$cusIDs = []; 
$cusNames = []; 
$cusCons = []; 
$cusAdds = []; 
$cusTypes = []; 
$i = 0;
$content = "";
//get all customer info
$sql = "SELECT * FROM `customer`";
$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $cusIDs[$i] = $row['cusID'];
    $cusNames[$i] = $row['cusName'];
    $cusCons[$i] = $row['cusContact'];
    $cusAdds[$i] = $row['cusAddress'];
    $cusTypes[$i++] = $row['cusType'];
  }
}
$content ="<table class='table table-borderless'><tr><th scope='col'>ID #</th><th scope='col'>Name</th><th scope='col'>Contact</th>
          <th scope='col'>Address</th><th scope='col'>Type</th></tr></thead>";
for($temp = 0; $temp < $i; $temp++){
  $content = $content . "<tr>";
  $content = $content . "<td><button type='submit' name='customerID".$cusIDs[$temp]."' class='btn btn-link'  data-dismiss='modal' onclick='saveID($cusIDs[$temp])'>$cusIDs[$temp]</button></td>";
  $content = $content . "<td class='pt-3 mt-3' name='name_$cusIDs[$temp]'>$cusNames[$temp]</td>";
  $content = $content . "<td class='pt-3 mt-3'>$cusCons[$temp]</td>";
  $content = $content . "<td class='pt-3 mt-3'>$cusAdds[$temp]</td>";
  $content = $content . "<td class='pt-3'>$cusTypes[$temp]</td>";
  $content = $content . "<tr>";
}
$content = $content . "</table>";
echo $content;
$conn->close();
?>