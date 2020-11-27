<?php
session_start();
$title="Product";
if(isset($_SESSION["username"]))
{
    include "init.php";
    $actn="";
    $actn=isset($_GET["actn"])?$_GET["actn"]:'Manage';
    switch($actn)
     {
    case "Manage":?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Product</a></li>
                    </ul>
            <div class="panel panel-success">
                <div class="panel-heading">
                    Product
                </div>
                <div class="panel-body">
                    <!--start body panel-->
                        <div class="div-action pull pull-left">
                           <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
                               add Product 
                               <i class='glyphicon glyphicon-plus-sign'></i>
                            </button> 
                        </div>
                                <div class="div-action pull pull-left col-md-3 sl">
                                        <span style="float:left;margin-top:7px;">show</span> 
                                        <select  class="form-control" style="float:left; width:100px;" id='rcrd' name="rcrd" >
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                            </div>
                            <div class="navbar-form navbar-right" role="search" method="POST" action="Client.php?actn=List">
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="px_name" placeholder="Search by name" name="s_name">
                                            </div>
                                     </div>
                    <!--end body1 panel-->
                </div>
                <!--start body2 table-->
                <div class="panel-body" >
                <div class="table-responsive" id="tabledata">
                   

                </div>  
                </div>
                <!--start pane table-->
                <div class="panel-footer">
                    Panel Footer
                </div>
                
            </div>
        </div><!--col-md-12-->
    </div><!--row-->
</div><!--container-->
<!-- Modal upload -->
<!--form moda-->
<div class="modal fade"  id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <!--strat modal header-->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add product</h4>
                                    </div>
                                    <!--start body-->
                                <div class="modal-body" >
                                    <form class="form-horizontal"  id="pop-prod" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-sm-7 col-md-7">
                                                  <img id="p_sh" src="data/Uploads/default.png" alt="your img" width="300" height="300" class="col-md-offset-8 img-responsive ">
                                                </div>
                                            </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">image</label> 
                                                <div class="col-sm-7 col-md-7">
                                                <div class="input-group">
                                                        <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                        Browse&hellip; <input type="file" name="url_img" id="url_img" style="display: none;">
                                                        </span>
                                                    </label> 
                                                    <input  type="text" class="form-control" readonly>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Le Nom de produit</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="text" id="P_name" class="form-control"  placeholder="Le Nom de produit" autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Prix d'achat</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="number" id="Px_buy" min="0"  class="form-control" placeholder="Prix par d'achat" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Prix de vente</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="number" id="Px_unit" min="0"  class="form-control" placeholder="Prix de vent" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-4 control-label">Quantité on stock</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="number" id="qts" min="0" class="form-control"  placeholder="Quantité on stock" autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-4 control-label">Date d'expert</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="date" id="dt_time" min="0" class="form-control"  autocomplete="off"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-4 control-label">Categorie</label> 
                                                <div class="col-sm-7 col-md-7">
                                                    <select name="catg" id="catg" class="form-control">
                                                        <option value="1">Para</option>
                                                        <option value="2">Boutique</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-4 col-md-3 col-md-offset-4">
                                                <button type="button"  value="add" class="btn btn-success col-md-6" id="add_product">Add</button>
                                                </div>
                                            </div>
                                    </form>
                                </div> <!--end body-->
                                <div role="msg" id="md-product">
                                </div>
                                                <!--start footer-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" id="md-cls" data-dismiss="modal">Close</button>
      
                                            </div>
                                    </div>
                          </div>
                    </div>
<!--end form modal-->
<!--start modal delet -->
<div id="mo-d" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove product</h4>
      </div>
      <form id='rmv_prod' method="Post">
      <div class="modal-body">
      are you sure de remove this product
        <input name="id-p" id="id-pr"  type="hidden" >
        
      </div>
      <div id="rmv-msg" class="modal-body">
        
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-danger" id='btn-rmv'>Remove</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

      <form>
    </div>
  </div>
</div>
<!--end modal remove-->
    <?php break;
    case "Edit":
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $id=$_GET['id'];
        $q="SELECT `Id_Prod`,`P_Name`,`Px_unit`,`Px_buy`,`qts`,product.Id_Cat,`u_image`,`dt_time`
        from product
        INNER JOIN image ON product.Id_Img=image.ID_Img
        WHERE  Id_Prod=?";
        $stmtx=$con->prepare($q);
        $stmtx->execute(array($id));
        $row=$stmtx->fetch();
    ?>

<!-- snip -->
<script>
    var  myrow=new Array();
    var myrow = <?php echo json_encode($row, JSON_HEX_TAG); ?>; 
</script>
<!-- snip -->
 <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <ul class="breadcrumb">
                        <li><a href="Dashboard.php">Home</a></li>
                        <li><a href="product.php">Product</a></li>
                    </ul>
            <div class="panel panel-success">
                    <div class="panel-heading">
                       Edit  Product
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST"  action="updateProduct.php" enctype="multipart/form-data" id="formid">
                                               <div class="form-group">
                                                <div class="col-sm-4 col-md-4 col-md-offset-4 ">
                                                  <img id="p_sh" src="" alt="Image......" width="300" height="300" class="img-responsive ">
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">image</label> 
                                                <div class="col-sm-4 col-md-4">
                                                <div class="input-group">
                                                        <label class="input-group-btn">
                                                        <span class="btn btn-success">
                                                        Browse&hellip; <input type="file" name="url_img" id="url_img" style="display: none; ">
                                                        </span>
                                                    </label> 
                                                    <input  type="text" class="form-control" id="txurl_img" name="txurl_img" readonly>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Le Nom de produit</label> 
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="text" name="id_P" id="id_P" hidden/>
                                                    <input type="text" name="P_name" id="P_name"  class="form-control"  placeholder="Le Nom de produit" autocomplete="off" required="required"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Prix d'achat</label> 
                                                <div class="col-sm-4 col-md-4"> 
                                                    <input type="number" name="Px_buy" min="0"  id="Px_buy" class="form-control" placeholder="Prix par d'achat" autocomplete="off" required="required"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Prix de vente</label> 
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="number" name="Px_unit" min="0" id="Px_unit"  class="form-control" placeholder="Prix de vent" autocomplete="off" required="required"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-4 control-label">Quantité on stock</label> 
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="number" name="qts" min="0" id="qts"  class="form-control"   placeholder="Quantité on stock" autocomplete="off" required="required"/>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                            <label class="col-sm-4 control-label">Date expert</label> 
                                                <div class="col-sm-4 col-md-4">
                                                    <input type="date" name="dt_time" id="dt_time"  class="form-control"  value="" placeholder="Quantité on stock" autocomplete="off" required="required"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                            <label class="col-sm-4 control-label">Categorie</label> 
                                                <div class="col-sm-4 col-md-4">
                                                    <select name="catg" id="catg" class="form-control">
                                                        <option value="1">Para</option>
                                                        <option value="2">Boutique</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-4 col-md-3 col-md-offset-4">
                                                <button type="button"  value="add" class="btn btn-success col-md-6" id="btn_updateprod">Add</button>
                                                </div>
                                            </div>    
                        </form>
                    </div>
                    <!-- <div id="md-product">
                    </div> -->
                    <div class="panel-footer">
                        footer
                    </div>
                </div>
         </div>
     </div>
</div>
<div id='md-product'  class="msg col-md-4 col-sm-4">
 </div>
    <?php
    }
    break;
    case "Delete":
    echo "welcome to " .$actn;
    break;
    case "Update":
        echo "";
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $id=is_numeric($_POST['id'])?$_POST['id']:0;
            if($id!=0)
            {
                $q="DELETE FROM product where id_Prod=?";
                $stmt=$con->prepare($q);
                $stmt->execute(array($id));
                $cnt=$stmt->rowcount();
                if($cnt>0)
                {
                    echo "<div class='alert alert-success'>rows {$cnt}affected</div>";
                    header("refresh:2; product.php?actn=Manage");
                }
            }
        }else{
            header("Location:product.php?actn=Manage");
        }
    break;
    case "Remove":
    echo "this is your info" . $_GET['id'];
    break;
    default:
    echo "Page notfound ???";
    break;
}
    include $tpl."footer.php";;
}else{

    header("Location:index.php");
}
?>
