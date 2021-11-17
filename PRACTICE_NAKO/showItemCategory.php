<?php

    require_once("dbConnect.php");
    $itemIDs = []; 
    $Customer_cusIDs = []; 
    $customer_order_orderIDs = [];
    $itemNames = [];
    $itemAccsTypes = [];
    $itemMatUseds = []; 
    $sizes = []; 
    $addons = [];
    $boxes = [];
    $itemStatus = [];
    $itemPrice = [];
    $i = 0;
    //get all customer info
    $sql = "SELECT * FROM `order_item`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $itemIDs[$i] = $row['itemID'];
            $Customer_cusIDs[$i] = $row['Customer_cusID'];
            $customer_order_orderIDs[$i] = $row['customer_order_orderID'];
            $itemNames[$i] = $row['itemName'];
            $itemAccsTypes[$i] = $row['itemAccsType'];
            $itemMatUseds[$i] = $row['itemMatUsed'];
            $sizes[$i] = $row['size'];
            $addons[$i] = $row['addons'];
            $boxes[$i] = $row['box'];
            $itemStatus[$i] = $row['itemStatus'];
            $itemPrice[$i++] = $row['itemPrice'];
        }
    }

    $conn->close();
?>