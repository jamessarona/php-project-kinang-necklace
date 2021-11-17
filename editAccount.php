<?php
  include "dbConnect.php";
  $cusID = $_GET["cusID"];
  $oldCusFname = '';
  $oldCusLname = '';
  $oldCusContact = 0;
  $oldCusAddress = '';
  $oldCusType = '';
  
  $res = mysqli_query($link, "SELECT * FROM `customer` WHERE `cusID` = $cusID");
  while($row=mysqli_fetch_array($res))
  {
    $oldCusFname = $row['cusFirstname'];
    $oldCusLname = $row['cusLastname'];
    $oldCusContact = $row['cusContact'];
    $oldCusAddress = $row['cusAddress'];
    $oldCusType = $row['cusType'];
  }
  //Give the info in input box
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
        
        
    <div class="row">
        <div class="col-3 p-5">
        </div>
        <!--Fill up-->
      <div class="col-5 p-5">
      <form action="" method="post">
        <div class="form-group">
            <h2 align=center>Edit Account</h2>
            <caption>
              <b>Fill up Form</b>
            </caption>
            <hr>
            <div class="input-group m-3">
              <input type="text" class="form-control" value="<?php echo $oldCusFname ?>" placeholder="Firstname" name="cusFName">
              <input type="text" class="form-control" value="<?php echo $oldCusLname ?>" placeholder="Lastname" name="cusLName">
            </div>
            <input type="number" class="form-control m-3" value="<?php echo $oldCusContact ?>" placeholder="Contact" name="cusCon">
            <input type="text" class="form-control m-3" value="<?php echo $oldCusAddress ?>" placeholder="Address" name="cusAdd">
            <div>
              <select class="custom-select m-3" name="cusType">
                
              <option value="Regular" <?php if($oldCusType == "Regular"){ echo "selected"; } ?>>Regular</option>
                <option value="Reseller" <?php if($oldCusType == "Reseller"){ echo "selected"; } ?>>Reseller</option>
              </select>
            </div>
            <button type="submit" name='newCustomer' class="btn btn-outline-success btn-lg float-right m-1">Save Changes</button>
            <a href="KinangStore.php"><button type="button" name='updateCustomer' class="btn btn-outline-dark btn-lg float-right m-1">Return</button></a>
          </div>
        </div>
      </form>
    </div>
    
  </body>
  <?php
    //insert Customer
    if(isset($_POST['newCustomer'])){
      $cusID = $_GET["cusID"];
      $firstName = $_POST['cusFName'];
      $lastName = $_POST['cusLName'];
      $contact = $_POST['cusCon'];
      $address = $_POST['cusAdd'];
      $type = $_POST['cusType'];

      if($firstName != null)
      {
        mysqli_query($link, "UPDATE `customer` SET `cusFirstname`= '$firstName' WHERE `cusID` = $cusID");
      }
      if($lastName != null)
      {
        mysqli_query($link, "UPDATE `customer` SET `cusLastname`= '$lastName' WHERE `cusID` = $cusID");
      }
      if($contact != null)
      {
        mysqli_query($link, "UPDATE `customer` SET `cusContact`= $contact WHERE `cusID` = $cusID");
      }
      if($address != null)
      {
        mysqli_query($link, "UPDATE `customer` SET `cusAddress`= '$address' WHERE `cusID` = $cusID");
      }
      if($type != null)
      {
        mysqli_query($link, "UPDATE `customer` SET `cusType`= '$type' WHERE `cusID` = $cusID");
      }
      echo "<script>window.location='KinangStore.php'</script>";
    }
  ?>
</html>