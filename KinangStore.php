<?php
  include "dbConnect.php";
  $orderDate = "";
  $itemName = "";
  
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
  <body class="bg-gradient-secondary text-dark">
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
        <div class="d-flex justify-content-center mt-4">
          <h3>Welcome, Initiate an Order!!!</h3>
        </div>
        
        <div class="row">
          
          <!--Fill up-->
          <div class="col-5 p-5">
            <div class="form-group">
            <!-- Button trigger modal -->


              <h2 align=center>Fill up Form</h2>
              <caption>
                <button type="button"class="btn btn-link" data-toggle="modal" data-target="#showAllCustomers">
                  <b>Customer Information</b>
                </button>
              </caption>


              <div class="row">
                <div class="col-8">
                <p class="">
                
                  <div class="input-group">
                  <button type="submit" class="input-group-text"><span>Select a Customer</span></button>
                  <select class="custom-select form-control m-1" name="selectedCustomer">
                  <option value="0">Choose here</option>
                    <?php
                    $res = mysqli_query($link, "SELECT * FROM `customer`");
                    while($row=mysqli_fetch_array($res))
                    {
                      echo "<option value=".$row['cusID'].">ID: ".$row['cusID']." | Name: ".$row['cusFirstname']." ".$row['cusLastname']."</option>";
                    }
                    

                    ?>
                      </select>
                    </div>
                  </p>
                </div>

                <div class="col-4">
                  <input type="date" class="form-control m-3" placeholder="Name" name="dateOrder" value="<?php echo $orderDate; ?>">
                </div>
              </div>

              <caption>
                <button type="button"class="btn btn-link" data-toggle="modal" data-target="#showOrderHistory">
                  <b>Item Detail</b>
                </button>
              </caption>
              <hr>
              <input type="text" class="form-control m-3" placeholder="Item Name" name="itemName">
              <div class="input-group">
                <div class="input-group-prepend m-1 ml-3">
                  <span class="input-group-text">Accessory Type</span>
                </div>
                <select class="custom-select form-control m-1" name="accysType">
                  <option value="Necklace">Necklace</option>
                  <option value="Bangle">Bangle</option>
                  <option value="Bracelet">Bracelet</option>
                  <option value="PetTag">Pet Tag</option>
                  <option value="Keychain">Keychain</option>
                  <option value="Ring">Ring</option>
                </select>
                <div class="input-group-prepend m-1">
                  <span class="input-group-text">Material Used</span>
                </div>
                <select class="custom-select form-control m-1" name="matUsed">
                  <option value="Stainless">Stainless</option>
                  <option value="Gold">Gold</option>
                </select>
              </div>
              <div class="input-group m-3">
                <input type="number" class="form-control" placeholder="Chain Number" name="itemChain">
                <input type="number" step = 0.01 class="form-control" placeholder="Size" name="itemSize">
              </div>
              
              <input type="text" class="form-control m-3" placeholder="Add-ons  (Use ' , ' to sperate)" name="itemAdd">
              <div class="custom-control custom-switch btn-lg float-left m-1 ml-3">
                <input type="checkbox" class="custom-control-input" id="withBox" name="withBox" unchecked="">
                <label class="custom-control-label" for="withBox">With Box</label>
              </div>
              <button type="submit" name="newItem" class="btn btn-outline-success btn-lg m-1 float-right">New Item</button>
              <!--
                <button type="submit" name="updateItem" class="btn btn-outline-danger btn-lg m-1 float-right ">Update</button>
              -->
              <button type="button" class="btn btn-outline-info btn-lg m-1 float-right" data-toggle="modal" data-target="#buyBoxes">More Box</button>
            </div>
          </div>




          <!--RESULT-->
          <div class="col-7 p-5">

            <h2 align=center>Order Detail</h2>
            <div class="row">
                <div class="col-2">
                </div>
                  
                <div class="col-5">
                <?php
                  if(isset($_POST['selectedCustomer']) || isset($_POST['newItem']) || isset($_POST['buyBoxes']))
                  {
                    $cusID = 0;
                    $orderID = 0;
                    $cusID = $_POST['selectedCustomer'];
                    $orderDate = $_POST['dateOrder'];
                    $cusFname = 0;
                    $cusLname = 0;
                    $cusAdd = 0;

                    if($cusID <= 0)
                    {
                      $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
                      while($row=mysqli_fetch_array($res))
                      {
                        $cusID = $row['Customer_cusID'];
                      }
                    }
              
                    if($orderDate == NULL)
                    {
                      $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                      while($row=mysqli_fetch_array($res))
                      {
                        $orderDate = $row['orderDate'];
                      }
                    }
                    //get order ID
                    $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
                    while($row=mysqli_fetch_array($res))
                    {
                      $orderID = $row['orderID'];
                    }

                    $res = mysqli_query($link, "SELECT * FROM `customer` WHERE `cusID` = $cusID");
                    while($row=mysqli_fetch_array($res))
                    {
                      $cusFname = $row['cusFirstname'];
                      $cusLname = $row['cusLastname'];
                      $Address = $row['cusAddress'];
                    }
                    echo "<p>Name: $cusFname $cusLname</p>";
                    echo "<p>Address: $Address</p>";
                  }
                  ?>
                </div>
                <div class="col-5">
                <?php
                  if(isset($_POST['selectedCustomer']) || isset($_POST['newItem']) || isset($_POST['buyBoxes']))
                  {
                    $cusID = 0;
                    $orderID = 0;
                    $cusID = $_POST['selectedCustomer'];
                    $orderDate = $_POST['dateOrder'];
                    $cusContact = 0;

                    if($cusID <= 0)
                    {
                      $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
                      while($row=mysqli_fetch_array($res))
                      {
                        $cusID = $row['Customer_cusID'];
                      }
                    }
              
                    if($orderDate == NULL)
                    {
                      $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                      while($row=mysqli_fetch_array($res))
                      {
                        $orderDate = $row['orderDate'];
                      }
                    }
                    //get order ID
                    $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
                    while($row=mysqli_fetch_array($res))
                    {
                      $orderID = $row['orderID'];
                    }

                    $res = mysqli_query($link, "SELECT * FROM `customer` WHERE `cusID` = $cusID");
                    while($row=mysqli_fetch_array($res))
                    {
                      $cusContact = $row['cusContact'];
                    }
                    echo "<p>Date: $orderDate</p>";
                    echo "<p>Contact #: $cusContact</p>";
                  }
                  ?>
                </div>
              </div>
            <table class="table table-hover">
              <thead>
                <tr class="table-dark">
                  <th scope="col">ID #</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Accessory Type</th>
                  <th scope="col">Material</th>
                  <th scope="col">Chain #</th>
                  <th scope="col">Size</th>
                  <th scope="col">Addons</th>
                  <th scope="col">Packaging</th>
                  <th scope="col">Price</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody name="KinangOrdercontent">
                <?php
                  //DISPLAY ORDER ITEMS IN TABLE
                  if(isset($_POST['selectedCustomer']) || isset($_POST['newItem']) || isset($_POST['buyBoxes']))
                  {
                    $cusID = 0;
                    $orderID = 0;
                    $cusID = $_POST['selectedCustomer'];
                    $orderDate = $_POST['dateOrder'];
                    if($cusID <= 0)
                    {
                      $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
                      while($row=mysqli_fetch_array($res))
                      {
                        $cusID = $row['Customer_cusID'];
                      }
                    }
              
                    if($orderDate == NULL)
                    {
                      $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                      while($row=mysqli_fetch_array($res))
                      {
                        $orderDate = $row['orderDate'];
                      }
                    }
                    //get order ID
                    $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
                    while($row=mysqli_fetch_array($res))
                    {
                      $orderID = $row['orderID'];
                    }
                    if($orderID > 0)
                    {
                      $res = mysqli_query($link, "SELECT * FROM `order_item` WHERE `Customer_cusID` = $cusID AND `customer_order_orderID` = $orderID");
                      while($row=mysqli_fetch_array($res))
                      {

                        echo "<tr class='table-warning'>";
                        echo "<td name='itemID".$row['itemID']."'>"; echo $row['itemID']; echo "</button></td>";
                        echo "<td>"; echo $row['itemName']; echo "</td>";

                        echo "<td ";
                        if($row['itemAccsType'] == "Necklace")
                        {
                          echo "class='text-info'";
                        }
                        else if($row['itemAccsType'] == "Bangle")
                        {
                          echo "class='text-success'";
                        }
                        else if($row['itemAccsType'] == "Bracelet")
                        {
                          echo "class='text-warning'";
                        }
                        else if($row['itemAccsType'] == "PetTag")
                        {
                          echo "class='text-danger'";
                        }
                        echo ">";
                        echo $row['itemAccsType']; echo "</td>";
                        
                        echo "<td "; 
                        if($row['itemMatUsed'] == "Gold")
                        {
                          echo "class='text-warning'";
                        }
                        else if($row['itemMatUsed'] == "Stainless")
                        {
                          echo "class='text-secondary'";
                        }
                        echo ">";
                        echo $row['itemMatUsed']; echo "</td>";
                        echo "<td>"; echo $row['chainNum']; echo "</td>";
                        echo "<td>"; echo $row['size']; echo "</td>";
                        echo "<td>"; echo $row['addons']; echo "</td>";
                        echo "<td>"; echo $row['box']; echo "</td>";
                        echo "<td>"; echo $row['itemPrice']; echo "</td>";

                        echo "<td>";
                        
                        echo "
                        <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
                        <button type='button' class='btn btn-info btn-sm'>Option</button>
                        <div class='btn-group' role='group'>
                          <button id='btnGroupDrop4' type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></button>
                          <div class='dropdown-menu' aria-labelledby='btnGroupDrop4' style=''>";
                          ?>
                            <a href="editItem.php?itemID=<?php echo $row['itemID']; ?>"><button type="button" class='dropdown-item'>Edit</button></a>
                            <a href="deleteItem.php?itemID=<?php echo $row['itemID']; ?>"><button  type="button" class='dropdown-item'>Delete</button></a>
                          </div>
                        </div>
                      </div>
                      <?php
                        echo "</td>";
                        echo "</tr>";
                      }
                    }
                  }
                ?>
              </tbody>
            </table>

            <div class="row">
              <div class="col-4 p-5">
              <caption>
                <button type="button" class="btn btn-link">
                  <b>Box Detail</b>
                </button>
              <table class="table table-hover ">
                  <thead>
                    <tr class="table-dark">
                      <th scope="col">Quantity</th>
                      <th scope="col">Price/Box</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody name="KinangBoxDetail">
                  <?php
                  //DISPLAY ORDER BOX IN TABLE
                    if(isset($_POST['selectedCustomer']) || isset($_POST['newItem']) || isset($_POST['buyBoxes']))
                    {
                      $cusID = 0;
                      $orderID = 0;
                      $cusID = $_POST['selectedCustomer'];
                      $orderDate = $_POST['dateOrder'];
                      if($cusID <= 0)
                      {
                        $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
                        while($row=mysqli_fetch_array($res))
                        {
                          $cusID = $row['Customer_cusID'];
                        }
                      }
                
                      if($orderDate == NULL)
                      {
                        $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                        while($row=mysqli_fetch_array($res))
                        {
                          $orderDate = $row['orderDate'];
                        }
                      }
                      //get order ID
                      $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
                      while($row=mysqli_fetch_array($res))
                      {
                        $orderID = $row['orderID'];
                      }
                      if($orderID > 0)
                      {
                        $res = mysqli_query($link, "SELECT * FROM `order_box` WHERE `Customer_cusID` = $cusID AND `customer_order_orderID` = $orderID");
                        while($row=mysqli_fetch_array($res))
                        {

                          echo "<tr class='table-warning'>";
                          echo "<td name='boxID".$row['boxID']."'>"; echo $row['boxQuantity']; echo "</td>";
                          echo "<td>"; echo $row['boxPrice']; echo "</td>";
                          echo "<td>"; echo $row['boxTotal']; echo "</td>";
                          echo "</tr>";
                        }
                      }
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <div class="col-8 p-5">
              <caption>
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#charges">
                  <b>Invoice</b>
                </button>
              <table class="table table-hover ">
                  <thead>
                    <tr class="table-dark">
                      <th scope="col">Downpayment</th>
                      <th scope="col">Shipping Fee</th>
                      <th scope="col">Box Subtotal</th>
                      <th scope="col">Item Subtotal</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody name="KinangInvoiceDetail">
                    <?php
                      if(isset($_POST['selectedCustomer']) || isset($_POST['newItem']) || isset($_POST['buyBoxes']))
                      {
                        $cusID = 0;
                        $orderID = 0;
                        $cusID = $_POST['selectedCustomer'];
                        $orderDate = $_POST['dateOrder'];
                        if($cusID <= 0)
                        {
                          $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
                          while($row=mysqli_fetch_array($res))
                          {
                            $cusID = $row['Customer_cusID'];
                          }
                        }
                  
                        if($orderDate == NULL)
                        {
                          $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                          while($row=mysqli_fetch_array($res))
                          {
                            $orderDate = $row['orderDate'];
                          }
                        }
                        //get order ID
                        $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
                        while($row=mysqli_fetch_array($res))
                        {
                          $orderID = $row['orderID'];
                        }
                        if($orderID > 0)
                        {
                          $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderID` = $orderID");
                          while($row=mysqli_fetch_array($res))
                          {

                            echo "<tr class='table-warning'>";
                            echo "<td name='orderID".$row['orderID']."'>"; echo $row['downpayment']; echo "</td>";
                            echo "<td>"; echo $row['shippingFee']; echo "</td>";
                            echo "<td>"; echo $row['boxTotal']; echo "</td>";
                            echo "<td>"; echo $row['itemTotal']; echo "</td>";
                            echo "<th class='text-danger'>"; echo $row['total']; echo "</th>";
                            echo "</tr>";
                            
                          }
                          
                        }
                        
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal Show Charge Fee -->
        <div class="modal fade" id="charges" tabindex="-1" role="dialog" aria-labelledby="chargesLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="chargesLabel">Charging Fees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Downpayment</span>
                  </div>
                  <input type="number" step="0.01" class="form-control" placeholder="" name="downpayment">
                  
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Shipping Fee</span>
                  </div>
                  <input type="number" step="0.01" class="form-control" placeholder="" name="shippingFee">
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="submit" name="addCharges" class="btn btn-warning">Submit</button>
              </div>
            </div>
          </div>
        </div> 


        <!-- Modal Buy Box -->
        <div class="modal fade" id="buyBoxes" tabindex="-1" aria-labelledby="buyBoxesLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="buyBoxesLabel">Want to buy more Box?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h5>₱10.00/box</h5>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Amount</span>
                  </div>
                  <input type="number" class="form-control" placeholder="" name="boxAmmount">
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="submit" name="buyBoxes" class="btn btn-warning">Submit</button>
              </div>
            </div>
          </div>
        </div>

        
        <!-- Modal Show Customer Order History-->
        <div class="modal fade bd-example-modal-lg" id="showOrderHistory" tabindex="-1" role="dialog" aria-labelledby="showOrderHistoryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="showOrderHistoryModalLabel">
                    <?php
                        echo "Order History ";
                        if(isset($_POST['selectedCustomer']))
                        {
                          $cusID = $_POST['selectedCustomer'];
                          echo "of <u>";
                          $res = mysqli_query($link, "SELECT * FROM `customer` WHERE `cusID` = $cusID");
                          while($row=mysqli_fetch_array($res))
                          {
                            echo $row['cusFirstname']." ".$row['cusLastname'];
                          }
                          echo "</u>";
                        }
                    ?>
              
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <table class='table table-borderless'>
                <thead>
                    <tr class="table-dark">
                      <th scope='col'>Order ID #</th>
                      <th scope='col'>Date</th>
                      <th scope='col'>Downpayment</th>
                      <th scope='col'>Shipping Fee</th>
                      <th scope='col'>Box Total</th>
                      <th scope='col'>Item Total</th>
                      <th scope='col'>Total</th>
                    </tr>
                </thead>

                <tbody>  
                  <?php
                    if(isset($_POST['selectedCustomer']))
                    {
                      $cusID = $_POST['selectedCustomer'];
                      $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID");
                      while($row=mysqli_fetch_array($res))
                      {
                        echo "<tr class='table-warning'>";
                        echo "<td>". $row['orderID'] ."</td>";
                        echo "<td>". $row['orderDate'] ."</td>";
                        echo "<td>". $row['downpayment'] ."</td>";
                        echo "<td>". $row['shippingFee'] ."</td>";
                        echo "<td>". $row['boxTotal'] ."</td>";
                        echo "<td>". $row['itemTotal'] ."</td>";
                        echo "<td>". $row['total'] ."</td>";
                        echo "</tr>";
                      }
                    }
                    ?>
                  </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        

        <!-- Modal Show Customers-->
        <div class="modal fade bd-example-modal-lg" id="showAllCustomers" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Registered Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table class='table table-borderless'>
                  <thead>
                    <tr class="table-dark">
                      <th scope='col'>ID #</th>
                      <th scope='col'>Lastname</th>
                      <th scope='col'>Firstname</th>
                      <th scope='col'>Contact</th>
                      <th scope='col'>Address</th>
                      <th scope='col'>Type</th>
                    </tr>
                  </thead>

                  <tbody>
                  
                  <br>
                  <?php
                    /*
                    function show_all_customer()
                    {
                      //require_once('showCustomers.php');
                    }
                    show_all_customer();
                    */
                    $i = 0;
                    $res = mysqli_query($link, "SELECT * FROM `customer`");
                    while($row=mysqli_fetch_array($res))
                    {
                      
                      
                      
                      echo "<tr class='table-warning'>";
                      
                      echo "<td name='cusID".$row['cusID']."'>";
                      ?>
                      <a href="editAccount.php?cusID=<?php echo $row['cusID']; ?>">
                        <button type="button" class='btn btn-link'>
                        <?php  echo $row['cusID']; ?>
                        </button>
                      </a>
                      
                      <?php
                      echo "</button></td>";
                      echo "<td>"; echo $row['cusFirstname']; echo "</td>";
                      echo "<td>"; echo $row['cusLastname']; echo "</td>";
                      echo "<td>"; echo $row['cusContact']; echo "</td>";
                      echo "<td>"; echo $row['cusAddress']; echo "</td>";
                      echo "<td>"; echo $row['cusType']; echo "</td>";
                      echo "</tr>";
                    }
                    ?>
                      <a href="createAccount.php"><button type='button' class='btn btn-link'>Create Account</button></a>
                  </tbody>
              </div>
              <!--
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              -->
              </div>
            </div>
          </div>
        </div>



        </form>
  </body>
  <?php
   
    //insert Customer
    if(isset($_POST['newCustomer'])){
      $firstName = $_POST['cusFName'];
      $lastName = $_POST['cusLName'];
      $contact = $_POST['cusCon'];
      $address = $_POST['cusAdd'];
      $type = $_POST['cusType'];
      if($firstName != null && $lastName != null && $contact != null && $address != null && $type != null){
        mysqli_query($link, "INSERT INTO `customer`(`cusFirstname`, `cusLastname`, `cusContact`, `cusAddress`, `cusType`) VALUES ('$firstName', '$lastName', $contact, '$address', '$type')");
        echo "<script>window.location='KinangStore.php'</script>";
      }
    }

    //insert Item
    if(isset($_POST['newItem'])){
      $cusID = $_POST['selectedCustomer'];
      $orderDate = $_POST['dateOrder'];
      $orderID = 0;
      $itemName = $_POST['itemName'];
      $accType = $_POST['accysType'];
      $matUsed = $_POST['matUsed'];
      $chain = $_POST['itemChain'];
      $size = $_POST['itemSize'];
      $addons = $_POST['itemAdd'];
      $box = "";
      $itemStatus = "Active";
      $itemPrice = 0;
      $addCount = 0;
      $addPrice = 0;
      $boxPrice = 0;
      $itemTotalPrice = 0;
      $orderTotalPrice = 0;
      $chainPrice;
      $cusType = '';
      $latestcusOrdered = '';
      $latestDateOrdered = '';
      
      if(empty($_POST['withBox']))
      {
        $box = "off";
      }
      else
      {
        $box = $_POST['withBox'];
      }

      //get the last customer who ordered when customer input is blank
      if($cusID <= 0)
      {
        $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
        while($row=mysqli_fetch_array($res))
        {
          $cusID = $row['Customer_cusID'];
        }
      }
    
      if($orderDate == NULL)
      {
        $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
        while($row=mysqli_fetch_array($res))
        {
          $orderDate = $row['orderDate'];
        }
      }

      //get order ID
      $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
      while($row=mysqli_fetch_array($res))
      {
        $orderID = $row['orderID'];
      }
      if($orderID == 0)
      {
        mysqli_query($link, "INSERT INTO `customer_order`(`Customer_cusID`, `orderDate`, `downpayment`, `shippingFee`, `boxTotal`, `itemTotal`, `total`) 
                              VALUES ($cusID, '$orderDate', 0, 0, 0, 0, 0)");
        
        $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
        while($row=mysqli_fetch_array($res))
        {
          $orderID = $row['orderID'];
        }
      }
      
      
      if($cusID > 0 && $itemName != null && $accType != null){
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
        $res = mysqli_query($link, "SELECT `cusType` FROM `customer` WHERE `cusID` = $cusID");
        while($row=mysqli_fetch_array($res))
        {
          $cusType = $row['cusType'];
        }
        

        //get item price from database
        $res = mysqli_query($link, "SELECT `$accType$matUsed` FROM `prices` WHERE `price_based` = '$cusType'");
        while($row=mysqli_fetch_array($res))
        {
          $itemPrice = $row["$accType$matUsed"];
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

        $itemPrice = $itemPrice + $addPrice + $chainPrice + $boxPrice;
        mysqli_query($link, "INSERT INTO `order_item`(`Customer_cusID`, `customer_order_orderID`, `itemName`, `itemAccsType`, `itemMatUsed`, `chainNum`, `size`, `addons`, `box`, `itemStatus`, `itemPrice`) 
                            VALUES ($cusID, $orderID, '$itemName', '$accType', '$matUsed', $chain, $size, '$addons', '$box', '$itemStatus', $itemPrice)");
        
        
        $res = mysqli_query($link, "SELECT `itemTotal`, `total` FROM `customer_order` WHERE `orderID` = $orderID AND `Customer_cusID` = $cusID");
        while($row=mysqli_fetch_array($res))
        {
          $itemTotalPrice = $row["itemTotal"];
          $orderTotalPrice = $row["total"];
        }
        $itemTotalPrice += $itemPrice;
        $orderTotalPrice += $itemPrice;

        //update the total price of the order when boxes are purchase
        mysqli_query($link, "UPDATE `customer_order` SET `itemTotal`= $itemTotalPrice, `total`= $orderTotalPrice WHERE `orderID` = $orderID AND `Customer_cusID` = $cusID");
      
      }
    }

    //insert Boxes
    if(isset($_POST['buyBoxes'])){
      $boxAmmount = $_POST['boxAmmount'];
      $boxPrice = 0;
      $boxTotalPrice = 0;
      $cusType = '';
      $cusID = $_POST['selectedCustomer'];
      $boxesTotalPrice = 0;
      $orderTotalPrice = 0;
      $orderDate = $_POST['dateOrder'];
      
      if($boxAmmount > 0)
      {
        if($cusID <= 0)
        {
          $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
          while($row=mysqli_fetch_array($res))
          {
            $cusID = $row['Customer_cusID'];
          }
        }

        if($orderDate == NULL)
        {
          $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
          while($row=mysqli_fetch_array($res))
          {
            $orderDate = $row['orderDate'];
          }
        }

        //get order ID
        $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
        while($row=mysqli_fetch_array($res))
        {
          $orderID = $row['orderID'];
        }

        //if order is not found this will create new order row in database
        if($orderID == 0)
        {
          mysqli_query($link, "INSERT INTO `customer_order`(`Customer_cusID`, `orderDate`, `downpayment`, `shippingFee`, `subTotal`, `total`) 
                                VALUES ($cusID, '$orderDate', 0, 0, 0, 0)");
          while($row=mysqli_fetch_array($res))
          {
            $orderID = $row['orderID'];
          }
          
        }

        //get what type of customer Reseller or Regular
        $res = mysqli_query($link, "SELECT `cusType` FROM `customer` WHERE `cusID` = $cusID");
        while($row=mysqli_fetch_array($res))
        {
          $cusType = $row['cusType'];
        }

        //get box price from database
        $res = mysqli_query($link, "SELECT `Addons`, `Chain`, `Box` FROM `prices` WHERE `price_based` = '$cusType'");
        while($row=mysqli_fetch_array($res))
        {
          $boxPrice = $row["Box"];
        }
        $boxTotalPrice = $boxPrice * $boxAmmount;

        mysqli_query($link, "INSERT INTO `order_box`(`Customer_cusID`, `customer_order_orderID`, `boxQuantity`, `boxPrice`, `boxTotal`) 
        VALUES ($cusID, $orderID, $boxAmmount, $boxPrice, $boxTotalPrice)");

        $res = mysqli_query($link, "SELECT `boxTotal`, `total` FROM `customer_order` WHERE `orderID` = $orderID AND `Customer_cusID` = $cusID");
        while($row=mysqli_fetch_array($res))
        {
          $boxesTotalPrice = $row["boxTotal"];
          $orderTotalPrice = $row["total"];
        }
        $boxesTotalPrice += $boxTotalPrice;
        $orderTotalPrice += $boxTotalPrice;

        //update the total price of the order when boxes are purchase
        mysqli_query($link, "UPDATE `customer_order` SET `boxTotal`= $boxesTotalPrice, `total`= $orderTotalPrice WHERE `orderID` = $orderID AND `Customer_cusID` = $cusID");
        echo "<script>window.location='KinangStore.php'</script>";
      }
    } 
    

    //Add charges
    if(isset($_POST['addCharges']))
    {
      $downpayment = $_POST['downpayment'];
      $shippingFee = $_POST['shippingFee'];
      $totalitemPrice = 0;
      $totalBoxPrice = 0;
      $totalPrice = 0;
      if($downpayment != NULL && $shippingFee != NULL)
      {
        
        $cusID = 0;
        $orderID = 0;
        $cusID = $_POST['selectedCustomer'];
        $orderDate = $_POST['dateOrder'];
        if($cusID <= 0)
        {
          $res = mysqli_query($link, "SELECT `Customer_cusID` FROM `customer_order`");
          while($row=mysqli_fetch_array($res))
          {
            $cusID = $row['Customer_cusID'];
          }
        }
                  
        if($orderDate == NULL)
        {
          $res = mysqli_query($link, "SELECT `orderDate` FROM `customer_order` WHERE `Customer_cusID` = $cusID");
          while($row=mysqli_fetch_array($res))
          {
            $orderDate = $row['orderDate'];
          }
        }
        //get order ID
        $res = mysqli_query($link, "SELECT * FROM `customer_order` WHERE `Customer_cusID` = $cusID AND `orderDate` = '$orderDate'");
        while($row=mysqli_fetch_array($res))
        {
          $orderID = $row['orderID'];
          $totalItemPrice = $row['itemTotal'];
          $totalBoxPrice = $row['boxTotal'];
        }
        if($orderID > 0)
        {
          $totalPrice =  $totalItemPrice + $totalBoxPrice + $shippingFee - $downpayment;
          mysqli_query($link, "UPDATE `customer_order` SET `downpayment`=$downpayment, `shippingFee`= $shippingFee, `total`= $totalPrice WHERE `orderID` = $orderID AND `Customer_cusID` = $cusID");
        }
                        
      }
    }
  ?>
  <!--
    Kulang:
      Update Custome -- not require
      Update Item
      Display Order Detail, Box Detail, Invoice
    FINISHED
      Insert Customer
      Display Customers
      Select a customer
      New Item
      More Box
  -->
</html>