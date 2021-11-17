<?php

    require_once("dbConnect.php");
    $cusID;
    $orderDate = '11/10/2020';
    $downpayment = 0.0;
    $shippingFee = 0.0;
    $subTotal = 0.0;
    $total = 0.0;
    //get customer ID
    $sql = "SELECT * FROM `customer` Where cusName = 'James Angelo Sarona'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $cusID =  $row['cusID'];
    }
    } else {
    echo "0 results";
    }

    //insert Order
    $sql = "INSERT INTO customer_order(Customer_cusID, orderDate, downpayment, shippingFee, subTotal, total) VALUES ($cusID, $orderDate, $downpayment, $shippingFee, $subTotal, $total)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>