<?php

    require_once("dbConnect.php");
    $cusName;
    $cusID;
    $orderID;
    $itemName = "I love dvo";
    $itemAccsType = "Necklace";
    $itemMatUsed = "Stainless";
    $chainNum = 3;
    $chainSize = 17;
    $addons = "asd,asd";
    $box = "true";
    $itemStatus = "Active";
    $addonsQuantity = 0;
    $boxQuantity = 0;
    $boxPrice = 0;
    $addonsPrice = 0;
    $chainSizePrice = 0;
    $itemPrice = 0;
    $itemTotalPrice = 0;
    //get customer ID
    $sql = "SELECT * FROM `customer` Where cusName = 'James Angelo Sarona'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $cusID =  $row['cusID'];
        }
    } 
    else {
        echo "0 results";
    }

    $sql = "SELECT `Box` FROM `prices` WHERE `price_based` = (SELECT `cusType` FROM `customer` WHERE `cusID` = cusID)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $boxPrice =  $row['Box'];
        }
    } 
    else {
        echo "0 results";
    }
    

    //get order ID
    $sql = "SELECT COUNT(*) AS COUNT FROM `customer_order`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $orderID = $row['COUNT'];
        }
    }
    else {
        echo "0 results";
    }

    //get box price from prices
    $sql = "SELECT * FROM `prices` WHERE price_based = (SELECT `cusType` FROM `customer` WHERE cusID = $cusID)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $addonsPrice = $row['Addons'];
            $chainSize = $row['Chain'];
            $boxPrice = $row['Box'];
            $itemPrice = $row["$itemAccsType$itemMatUsed"]; //partial
        }
    }
    else {
        echo "0 results";
    }
    
    if($box == "true"){
        $boxQuantity = 1;
    }
    if(strlen($addons) > 0){
        $addonsQuantity = 1;
        if(substr_count($addons, ",") != 0){
            $addonsQuantity += substr_count($addons, ",");
        }
    }
    else{

    }
    //calculation for item
    $itemTotalPrice = ($addonsQuantity * $addonsPrice) + ($boxQuantity * $boxPrice) + $itemPrice;




    //calculate box,addons,size, item for total
    //insert box
    $sql = "INSERT INTO `order_item`(`Customer_cusID`, `customer_order_orderID`, `itemName`, `itemAccsType`, `itemMatUsed`, `chainNum`, `size`, `addons`, `box`, `itemStatus`, `itemPrice`) 
            VALUES ($cusID, $orderID, '$itemName', '$itemAccsType', '$itemMatUsed', $chainNum, $chainSize, '$addons', '$box', '$itemStatus', $itemTotalPrice)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>