<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <title>Document</title>
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
            <a class="nav-link" href="KinangStore.html">Order
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="KinangContact.html">Contact Us</a>
          </li>
        </ul>
      </div>
    </nav>

        <div class="d-flex justify-content-center mt-4">
          <h3>Welcome, Initiate an Order!!!</h3>
        </div>

        <div class="row">
          
          <!--Fill up-->
            <div class="col-5 p-5">
                <form action="insert.php" method="post">
                    <div class="form-group">
                        <h2 align=center>Fill up Form</h2>
                        <caption>Customer Information</caption>
                        <hr>
                        <input type="text" class="form-control m-3" placeholder="Name" name="cusName">
                        <input type="text" class="form-control m-3" placeholder="Contact" name="cusCon">
                        <input type="text" class="form-control m-3" placeholder="Address" name="cusAdd">
                    </div>
                    <button type="button" class="btn btn-outline-success btn-lg float-right m-1" name="submit">New</button>
                </form>
            </div>
        </div>



  </body>
</html>