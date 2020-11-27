<?php
session_start();
$title="cv";
if(isset($_SESSION["username"]))
{
    include 'init.php';
    $actn="";
   $actn=isset($_GET["actn"])?$_GET["actn"]:'Manage';
   switch($actn)
   {
       case "Manage":
       ?>
       <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="Dashboard.php">Home</a></li>
                        <li><a href="analystic.php">analystic</a></li>
                    </ul>
                    <div class="col-md-4">
                     <div class="panel panel-success ">
                            <div class="panel-heading">
                            </div>
                            <div class="panel-body">
                            ok
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
       break;
   }

}else{
    
}