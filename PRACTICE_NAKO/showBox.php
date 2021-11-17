<?php

    require_once("dbConnect.php");
    $boxIDs = []; 
    $Customer_cusIDs = []; 
    $customer_order_orderIDs = [];
    $boxQuantities = [];
    $boxPrices = [];
    $boxTotals = [];
    $i = 0;
    //get all customer info
    $sql = "SELECT * FROM `order_box`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $itemIDs[$i] = $row['boxID'];
            $Customer_cusIDs[$i] = $row['Customer_cusID'];
            $customer_order_orderIDs[$i] = $row['customer_order_orderID'];
            $boxQuantities[$i] = $row['boxQuantity'];
            $boxPrices[$i] = $row['boxPrice'];
            $boxTotals[$i++] = $row['boxTotal'];

        }
    }

    $conn->close();
?>