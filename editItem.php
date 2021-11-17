<?php
  include "dbConnect.php";
  $itemID = $_GET["itemID"];
  $Customer_cusID = 0;
  $customer_order_orderID = 0;
  $oldItemName = '';
  $oldItemAccs = '';
  $oldItemMat = '';
  $oldItemChain = 0;
  $oldItemSize = 0;
  $oldItemAdd = '';
  $oldItemBox = '';
  $oldItemPrice = 0;
  $res = mysqli_query($link, "SELECT * FROM `order_item` WHERE `itemID` = $itemID");
  while($row=mysqli_fetch_array($res))
  {
    $Customer_cusID = $row['Customer_cusID'];
    $customer_order_orderID = $row['customer_order_orderID'];
    $oldItemName = $row['itemName'];
    $oldItemAccs = $row['itemAccsType'];
    $oldItemMat = $row['itemMatUsed'];;
    $oldItemChain = $row['chainNum'];
    $oldItemSize = $row['size'];
    $oldItemAdd = $row['addons'];
    $oldItemBox = $row['box'];
    $oldItemPrice = $row['itemPrice'];
  }
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Document</title>
    <script type="text/javascript" language="javascript">
    </script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="KinangHome.html"><img src="images/ShopLogo.png" width="50" height="50"></a>
          
      <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="KiangFeatures.html">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="KinangStore.php">Order
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="KinangContact.html">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>
        <form action="" method="post" >
        
        <div class="row m-5 ">
        <div class="col-3">
        </div>
          <!--Fill up-->
          <div class="col-5 m-3">
            <div class="form-group">
            <!-- Button trigger modal -->


              <h2 align=center>Edit Item</h2>



              <div class="row">


              <caption>
                <button type="button"class="btn btn-link" data-toggle="modal" data-target="#showOrderHistory">
                  <b>Item Detail</b>
                </button>
              </caption>
              <hr>
              <input type="text" class="form-control m-3" value="<?php echo $oldItemName ?>" placeholder="Item Name"  name="itemName">
              <div class="input-group">
                <div class="input-group-prepend m-1 ml-3">
                  <span class="input-group-text">Accessory Type</span>
                </div>
                <select class="custom-select form-control m-1" name="accysType">
                  <option value="Necklace" <?php if($oldItemAccs == "Necklace"){ echo "selected"; } ?> >Necklace</option>
                  <option value="Bangle" <?php if($oldItemAccs == "Bangle"){ echo "selected"; } ?> >Bangle</option>
                  <option value="Bracelet" <?php if($oldItemAccs == "Bracelet"){ echo "selected"; } ?> >Bracelet</option>
                  <option value="PetTag" <?php if($oldItemAccs == "PetTag"){ echo "selected"; } ?> >Pet Tag</option>
                  <option value="Keychain" <?php if($oldItemAccs == "Keychain"){ echo "selected"; } ?> >Keychain</option>
                  <option value="Ring" <?php if($oldItemAccs == "Ring"){ echo "selected"; } ?> >Ring</option>
                </select>
                <div class="input-group-prepend m-1">
                  <span class="input-group-text">Material Used</span>
                </div>
                <select class="custom-select form-control m-1" name="matUsed">
                  <option value="Stainless" <?php if($oldItemMat != "Gold"){ echo "selected"; } ?> >Stainless</option>
                  <option value="Gold" <?php if($oldItemMat == "Gold"){ echo "selected"; } ?>>Gold</option>
                </select>
              </div>
              <div class="input-group m-3">
                <input type="number" class="form-control" value="<?php echo $oldItemChain ?>" placeholder="Chain Number" name="itemChain">
                <input type="number" step = 0.01 class="form-control" value="<?php echo $oldItemSize ?>" placeholder="Size" name="itemSize">
              </div>
              
              <input type="text" class="form-control m-3" value="<?php if($oldItemAdd != "n/a"){ echo $oldItemAdd; } ?>" placeholder="Add-ons  (Use ' , ' to sperate)" name="itemAdd">
              <div class="custom-control custom-switch btn-lg float-left m-1 ml-3">
                <input type="checkbox" class="custom-control-input" id="withBox" name="withBox" <?php if($oldItemBox == "on"){ echo "checked";} else{echo "unchecked";} ?>>
                <label class="custom-control-label" for="withBox">With Box</label>
              </div>
              <button type="submit" name="changeItemInfo" class="btn btn-outline-success btn-lg m-1 float-right">Save Changes</button>
            <a href="KinangStore.php"><button type="button" name='updateCustomer' class="btn btn-outline-dark btn-lg float-right m-1">Return</button></a>
            </div>
          </div>

        </div>
        </form>
  </body>
  <?php
    if(isset($_POST['changeItemInfo'])){
        $itemName = $_POST['itemName'];
        $accType = $_POST['accysType'];
        $matUsed = $_POST['matUsed'];
        $chain = $_POST['itemChain'];
        $size = $_POST['itemSize'];
        $addons = $_POST['itemAdd'];
        $box = "";
        $cusType = '';
        $newItemPrice = 0;
        $addCount = 0;
        $addPrice = 0;
        $boxPrice = 0;
        $itemTotalPrice = 0;
        $orderTotalPrice = 0;
        $chainPrice;
        //$oldItemPrice
        if(empty($_POST['withBox']))
        {
          $box = "off";
        }
        else
        {
          $box = $_POST['withBox'];
        }


        if($accType == 'Keychain' || $accType == 'Ring')
        {
          $matUsed = '';
        }
        if($chain <= 0 || $chain == NULL)
        {
          $chain = 0;
        }
        if($size <= 0 || $size == NULL)
        {
          $size = 0;
        }

        //get what type of customer Reseller or Regular
        $res = mysqli_query($link, "SELECT `cusType` FROM `customer` WHERE `cusID` = $Customer_cusID");
        while($row=mysqli_fetch_array($res))
        {
          $cusType = $row['cusType'];
        }

        //get item price from database
        $res = mysqli_query($link, "SELECT `$accType$matUsed` FROM `prices` WHERE `price_based` = '$cusType'");
        while($row=mysqli_fetch_array($res))
        {
          $newItemPrice = $row["$accType$matUsed"];
        }
        

        //get addons, chain, box price from database
        $res = mysqli_query($link, "SELECT `Addons`, `Chain`, `Box` FROM `prices` WHERE `price_based` = '$cusType'");
        while($row=mysqli_fetch_array($res))
        {
          $addPrice = $row['Addons'];
          $chainPrice = $row['Chain'];
          $boxPrice = $row["Box"];
        }
        

        
        if($addons != NULL || $addons == "n/a")
        {
          if(substr_count($addons, ",") > 0)
          {
            $addCount = substr_count($addons, ",");
          }
          $addCount += 1;
          $addPrice = $addPrice * $addCount;
        }
        else
        {
          $addPrice = 0;
          $addons = "n/a";
        }
       
        
        
        if($size < 19)
        {
          $chainPrice = 0;
          
        }
        if($box != 'on')
        {
          $boxPrice = 0;
          
        }

        $newItemPrice = $newItemPrice + $addPrice + $chainPrice + $boxPrice;
        if($itemName != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `itemName` = '$itemName' WHERE `itemID` = $itemID");
        }
        
        if($accType != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `itemAccsType` = '$accType' WHERE `itemID` = $itemID");
        }
        
        if($matUsed != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `itemMatUsed` = '$matUsed' WHERE `itemID` = $itemID");
        }
        if($chain != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `chainNum` = $chain WHERE `itemID` = $itemID");
        }
        if($size != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `size`= $size WHERE `itemID` = $itemID");
        }
        if($addons != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `addons`= '$addons' WHERE `itemID` = $itemID");
        }
        if($box != null)
        {
          mysqli_query($link, "UPDATE `order_item` SET `box`= '$box' WHERE `itemID` = $itemID");
        }
        
        mysqli_query($link, "UPDATE `order_item` SET `itemPrice`= $newItemPrice WHERE `itemID` = $itemID");
        
        $res = mysqli_query($link, "SELECT `itemTotal`, `total` FROM `customer_order` WHERE `orderID` = $customer_order_orderID");
        while($row=mysqli_fetch_array($res))
        {
          $itemTotalPrice = $row["itemTotal"];
          $orderTotalPrice = $row["total"];
        }
        $itemTotalPrice += $newItemPrice - $oldItemPrice;
        $orderTotalPrice += $newItemPrice - $oldItemPrice;

        mysqli_query($link, "UPDATE `customer_order` SET `itemTotal`= $itemTotalPrice, `total`= $orderTotalPrice WHERE `orderID` = $customer_order_orderID AND `Customer_cusID` = $Customer_cusID");

        echo "<script>window.location='KinangStore.php'</script>";
        
      }
  ?>

</html>