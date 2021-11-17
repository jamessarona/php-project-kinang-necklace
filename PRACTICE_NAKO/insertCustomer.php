<?php

require_once("dbConnect.php");
$cusName = $_POST["cusName"];
$cusCon = $_POST["cusCon"];
$cusAdd = $_POST["cusAdd"];
$cusType = $_POST["cusType"];
if(strlen($cusName) > 0 && strlen($cusCon) > 0 && strlen($cusAdd) > 0){
    require_once("dbConnect.php");
    $sql = "INSERT INTO customer (cusName, cusContact, cusAddress, cusType) 
            VALUES ('$cusName','$cusCon','$cusAdd','$cusType')";
        
    if($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } 
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
                
    echo "<script>window.location='KinangStore.php'</script>"; // magload ang KinangStore.php para di maexecute usab ang query
    $conn->close();
}
?>