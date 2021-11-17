<?php
    include "dbConnect.php";
    $itemID = $_GET["itemID"];
    $cusID = 0;
    $orderID = 0;
    $itemPrice = 0;
    $itemTotal = 0;
    $orderTotal = 0;

    $res = mysqli_query($link, "SELECT * FROM `order_item` WHERE `itemID` = $itemID");
    while($row=mysqli_fetch_array($res))
    {
        $cusID = $row['Customer_cusID'];
        $orderID = $row['customer_order_orderID'];
        $itemPrice = $row['itemPrice'];
    }

    $res = mysqli_query($link, "SELECT `itemTotal`, `total` FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderID` = $orderID");
    while($row=mysqli_fetch_array($res))
    {
        $itemTotal = $row['itemTotal'];
        $orderTotal = $row['total'];
    }
    $itemTotal = $itemTotal - $itemPrice;
    $orderTotal = $orderTotal - $itemPrice;
    
    mysqli_query($link, "UPDATE `customer_order` SET `itemTotal`= $itemTotal,`total` = $orderTotal WHERE `Customer_cusID` = $cusID AND `orderID` = $orderID");
    mysqli_query($link, "DELETE FROM `order_item` WHERE `itemID` = $itemID");
?>

<script type="text/javascript">
    window.location="KinangStore.php";
</script>