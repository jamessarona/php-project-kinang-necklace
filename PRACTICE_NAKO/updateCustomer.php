<?php

    require_once("dbConnect.php");
    $newCusID = 1; 
    $newCusName = "Kaye Mare Milagrosa"; 
    $newCusCon = "";
    $newCusAdd = "";
    $newCusType = "Reseller";

    $oldCusName; 
    $oldCusCon;
    $oldCusAdd;
    $oldCusType;

    //get all customer info
    $sql = "SELECT * FROM `customer` WHERE `cusID` = $newCusID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $oldCusName =  $row['cusName'];
        $oldCusCon =  $row['cusContact'];
        $oldCusAdd =  $row['cusAddress'];
        $oldCusType =  $row['cusType'];
    }
    } else {
    echo "0 results";
    }

    if(strlen($newCusName) == 0){
        $newCusName = $oldCusName;
    }
    if(strlen($newCusCon) == 0){
        $newCusCon = $oldCusCon;
    }
    if(strlen($newCusAdd) == 0){
        $newCusAdd = $oldCusAdd;
    }
    if(strlen($newCusType) == 0){
        $newCusType = $oldCusType;
    }

    $sql = "UPDATE `customer` SET `cusName`='$newCusName',`cusContact`='$newCusCon',`cusAddress`='$newCusAdd',`cusType`='$newCusType' WHERE `cusID` = $newCusID";

    if ($conn->query($sql) === TRUE) {
    echo "record updated successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>