<?php
session_start();
$title="Client";
$userid=$_SESSION['userid'];
if(isset($_SESSION["username"]))
{
    include 'init.php';
    $actn=isset($_GET["actn"])?$_GET["actn"]:'Manage';
    switch($actn)
{

    case "Manage":
            $Q="SELECT *  FROM client ";
        $stmt=$con->prepare($Q);
        $stmt->execute();
        $i=1;
        ?>
            <div class="container  list-s">
              <div class="row">
               <div class="col-md-12">
                  <ul class="breadcrumb">
                        <li><a href="Dashboard.php">Home</a></li>
                        <li><span style="color:#fff">client</span></li>
                        <li><span style="color:#fff">List Client</span></li>
                    </ul>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Client
                        </div>
                        <div class="panel-body">
                                <div class="navbar-form navbar-right" role="search" method="POST" >
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="s_name" placeholder="Search by name" name="s_name">
                                    </div>
                                </div>
                               <button class="btn btn-success" data-target="#mo-addc" data-toggle="modal">add client</button>
                                <select  class="form-control" style="width:100px;" id='rc_c' name="rc_c" >
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="100000">all</option>
                                    </select>
                                
                                <div class="table-responsive table-bordered" id="tabledatac">
                               
                                </div>
                                </div>
                     <div class="panel-footer">Panel Footer</div>
                    </div>
                </div>
        </div>
 </div>
 <!-- remove dialog-->
 <div id="mo-dc" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove client</h4>
      </div>
      <form method="POST" id="frm-rclnt">
      <div class="modal-body">
     vous etes sure por suprime le client
        <input name="id" id="id_client" readonly type="hidden">
      
      </div>
      <div id="msg-clnt" class="msg">
      </div>
      <div class="modal-footer">
         <button type="button" id="remv-clnt"class="btn btn-danger" >Remove</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="empy_msg('#msg-clnt')">Close</button>
      </div>

      </form>
    </div>
  </div>
</div>

<!--_____________________________start edit client modal_______________________-->
<div id="mo-editc" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Client</h4>
      </div>
      <div class="modal-body">
       <!--___________________start from__________________________________-->
       <form class="form-horizontal"  method="POST" id="frm-editclnt">
                        
                        <!--start id national -->
                        <div class="form-group">
                        <div class="col-sm-4 col-md-5 col-md-push-4">
                            <input type="hidden" id="id_cln"/>
                            <input type="text" id="id_Nax" class="form-control" placeholder="La carte National" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <!--start username -->
                    <div class="form-group">
                    <div class="col-sm-4 col-md-5 col-md-push-4">
                        <input type="text" id="F_namex" class="form-control" placeholder="le nom complete" autocomplete="off" required="required"/>
                    </div>
                </div>
                        <!--start tele -->
                        <div class="form-group">
                        <div class="col-sm-4 col-md-5 col-md-push-4">
                            <input type="tel" id="telx" class="form-control" size="14" placeholder="Le Num Tele" autocomplete="off" required="required"/>
                        </div>
                    </div>
                </form>
                </div>
            <!--___________________end from__________________________________-->
      <div id="msg-editc" class="msg">
      </div>
      <div class="modal-footer">
         <button type="button" id="btn-editc"  value="Add" class="btn btn-success btn"> sauvegarder Edit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="empy_msg('#msg-editc')">fermer</button>
      </div>
    </div>
  </div>
</div>

<!--______________________________end edit client modal_______________________-->
<!--_____________________________start add client modal_______________________-->
<div id="mo-addc" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove product</h4>
      </div>
      <div class="modal-body">
       <!--___________________start from__________________________________-->
       <form class="form-horizontal"  method="POST" id="frm-client">
                        
                        <!--start id national -->
                        <div class="form-group">
                        <div class="col-sm-4 col-md-5 col-md-push-4">
                            <input type="text" id="id_Na" class="form-control" placeholder="La carte National" autocomplete="off" required="required"/>
                        </div>
                    </div>
                    <!--start username -->
                    <div class="form-group">
                    <div class="col-sm-4 col-md-5 col-md-push-4">
                        <input type="text" id="F_name" class="form-control" placeholder="le nom complete" autocomplete="off" required="required"/>
                    </div>
                </div>
                        <!--start tele -->
                        <div class="form-group">
                        <div class="col-sm-4 col-md-5 col-md-push-4">
                            <input type="tel" id="tel" class="form-control" size="14" placeholder="Le Num Tele" autocomplete="off" required="required"/>
                        </div>
                    </div>
                </form>
                </div>
            <!--___________________end from__________________________________-->
      <div id="msg-addc">
      </div>
      <div class="modal-footer">
         <button type="button" id="btn-addc"  value="Add" class="btn btn-success btn">add Client</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id='cl-add' onclick="empy_msg('#msg-addc')">Close</button>
      </div>
    </div>
  </div>
</div>
            
                
<?php   
   break;
    case "Carnet":
    ?>
        <!--?
            this is list of client must pay advance
        ?-->
        <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                                    <ul class="breadcrumb">
                                    <li><a href="Dashboard.php">Home</a></li>
                                    <li><a href="?actn=Manage">Client</a></li>
                                    </ul>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                Carnet de credit
                                </div>
                                <div class="panel-body">
                                <div class="navbar-form navbar-right" role="search" method="POST" >
                                    <div class="form-group">
                                    <input type="text" class="form-control" id="s_crnt" placeholder="Search by name" name="s_name">
                                    </div>
                                </div>
                               <!--hidden for autoload-->
                               <input type="hidden" id="pg_act" value="1">
                                <a class="btn btn-success" href="?actn=Manage">GO back</a>
                                <select  class="form-control" style="width:100px;" id='rc_crnt' name="rc_crnt" >
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="100000">all</option>
                                    </select>
                                <div class="panel-body" >
                                    <div id="id_pager">
                                    </div>
                                    <div class="table-responsive" id="table_carnet">
                                
                                    </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                foooooot
                                
                            </div>
                        </div>
                 </div>
        </div>
    <!--start modal form add-->
<!-- The Modal -->
<div class="modal fade" id="madv_d">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add payment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  class="form-horizontal">
            <div class="form-group">
                <label class=" col-md-4 col-sm-4 control-label">dt_paye</label>
                <div class="col-md-5 col-sm-6">
                     <input type="hidden" id="id_adv"/>
                    <input type="date" class="form-control" id="dt_paye" onchange="remv_error('#dt_paye')"/>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-4 col-sm-4 col-xs-2 control-label">Prix paye</label>
                <div class="col-md-5 col-sm-6 col-xs-5">
                    <input type="number" class="form-control" min='0' id="m_paye" onchange="remv_error('#m_paye')"/>
                </div>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="add-detail">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    <!--end modal form add-->
     <!--start modal more info-->
<!-- The Modal -->
<div class="modal fade" id="mo-crnt">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">full info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  class="form-horizontal">
            <div class="form-group">
                <label class=" col-md-4 col-sm-4 control-label">dt_paye</label>
                <div class="col-md-5 col-sm-6">
                     <input type="hidden"/>
                    <input type="date" class="form-control" id="dt_paye"/>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-4 col-sm-4 col-xs-2 control-label">Prix paye</label>
                <div class="col-md-5 col-sm-6 col-xs-5">
                    <input type="numeric" class="form-control" />
                </div>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
    <!--end modal more info-->
    <?php
    break;
    case "Edit":
                            if(isset($_POST["id"]))
                        {
                            $id=$_POST['id'];
                            $name=$_POST['n-name'];
                            if($id!="")
                            {
                            $q="UPDATE client SET FULL_Name=? WHERE ID_Client=?";
                            $stmt=$con->prepare($q);
                            $stmt->bindParam(1,$name,PDO::PARAM_STR,255);
                            $stmt->bindParam(2,$id,PDO::PARAM_INT );
                            $stmt->execute();
                            $cnt=$stmt->rowcount();
                            echo"<div class='alert alert-success'>
                                <strong>{$cnt}</strong> rows affected
                                </div>";
                                header("refresh:2; ?actn=List");
                            }
                            
                        }   ?>
                <!--_____________start from edit___________________-->
                    <div class="col-sm-7 col-md-7">
                        <form action="Client.php?actn=Edit" method="POST">

                        <div class="form-group">
                        <label class="col-sm-4 control-label">ID</label> 
                            <div class="col-sm-7 col-md-7">
                                <input type="text" name="id"  class="form-control"  value="<?php if(isset($_GET['id'])&& is_numeric($_GET['id']))echo $_GET['id'];?>" readonly autocomplete="off"required="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-4 control-label">Nom de client</label> 
                            <div class="col-sm-7 col-md-7">
                                <input type="text" name="n-name" class="form-control" placeholder="Nom de client" autocomplete="off"required="required"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-7 col-md-7  col-sm-offset-4">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                        </form>
                  </div>
<!--___________________end from edit___________________-->
                     </div>
                    <div class="panel-footer">Panel footer</div>
                    </div>
                    </div>
              </div>
         </div>
 </div>
    <?php
    break;
    default:
    echo "Page notfound ???";
    break;
}
    include $tpl.'footer.php';
}else{

header("Location:index.php");
exit();    
}?>