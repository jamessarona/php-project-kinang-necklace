<?php

    require_once("dbConnect.php");
    $cusID;
    $orderID;
    $boxQuantity = 20; //NEED INPUT
    $boxPrice;
    //get customer ID
    $sql = "SELECT * FROM `customer` 
            Where cusName = 'James Angelo Sarona'";
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
    $sql = "SELECT `box` FROM `prices` 
            WHERE price_based = (SELECT `cusType` FROM `customer` WHERE cusID = $cusID)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $boxPrice = $row['box'];
        }
    }
    else {
        echo "0 results";
    }
    $boxTotal = $boxPrice * $boxQuantity;
    
    //insert box
    $sql = "INSERT INTO `order_box`(`Customer_cusID`, `customer_order_orderID`, `boxQuantity`, `boxPrice`, `boxTotal`) 
            VALUES ($cusID, $orderID, $boxQuantity, $boxPrice, $boxTotal)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>