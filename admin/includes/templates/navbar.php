<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-data" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo ucfirst($_SESSION["username"])?></a>
    </div>
    <div class="collapse navbar-collapse" id="app-data">
      <ul class="nav navbar-nav">
      <li ><a href="#"><div class="fa fa-area-chart" aria-hidden="true"></div></a></li>
      <!--_________________start product_______________________-->
        <li >
          <a href="product.php?actn=Manage">Product</a>
        </li>
        <li><a href="#">Boutique</a></li>
        <li><a href="command.php">Command</a></li>
        <li class="dropdown">
          <a href="Client.php?actn=Manage" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">client<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Client.php?actn=Manage&userid=<?php echo $_SESSION['userid']?>">Manage Client</a></li>
            <li><a href="Client.php?actn=Carnet">Carnet De Credit</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">raport</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="Members.php?actn=Edit&userid=<?php echo $_SESSION['userid']?>">Edit Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
            <!--<li role="separator" class="divider"></li>-->
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>