<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Inventory System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"><i class="fa fa-home">&nbsp;</i>Home <span class="sr-only">(current)</span></a>
      </li>

      <?php

        if(isset($_SESSION["userid"])){

          ?>



      <li class="nav-item active">
        <a class="nav-link" href="getorder.php"><i class="fa fa-list">&nbsp;</i>All Orders <span class="sr-only">(current)</span></a>
      </li>


       <li class="nav-item active">
        <a class="nav-link" href="product_stock.php"><i class="fa fa-plus">&nbsp;</i>Stock Products <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="customerorder.php"><i class="fa fa-address-book">&nbsp;</i>Customer Order <span class="sr-only">(current)</span></a>
      </li>

      <?php } ?>
      
        <?php

        if(isset($_SESSION["userid"])){
          ?>
            <li class="nav-item active">
            <a class="nav-link" href="logout.php"><i class="fa fa-user">&nbsp;</i>Logout</a>
            </li>
            
            <?php } ?>

      
     
    </ul>
  </div>
</nav>