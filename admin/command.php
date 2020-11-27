<?php 
session_start();
$title="command";
if(isset($_SESSION["username"]))
{
    include 'init.php';
    $actn="";
    $actn=isset($_GET["actn"])?$_GET["actn"]:'Manage';
    switch($actn)
     {
        case 'Manage':
        ?>
        <div class="container">
         <div class="row">
            <div class="col-md-12">
                  <ul class="breadcrumb">
                        <li><a href="Dashboard.php">Home</a></li>
                        <li><a href="#">Command</a></li>
                    </ul>
                <div class="panel panel-success">
                
                    <div class="panel-heading">
                        Command
                    </div>

                    <div class="panel-body" >
                        <div class="div-action pull pull-left">
                                <a class="btn btn-success" href="?actn=add">add Command 
                                 <i class='glyphicon glyphicon-plus-sign'></i> </a>
                            </div>
                            <!--select number-->
                            <div class="div-action pull pull-left col-md-3 sl">
                                        <span style="float:left;margin-top:7px;">show</span> 
                                        <select  class="form-control" style="float:left; width:100px;" id='rc_cmd' name="rc_cmd" >
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                            </div>
                            <!--search -->
                            <div class="navbar-form navbar-right" role="search" method="POST" action="Client.php?actn=List">
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="s_cmd" placeholder="Search by name" name="s_cmd">
                                            </div>
                                     </div>
                    </div>
                    <div class="panel-body">
                             <div class="tb" id="tb-cmd">
                                     <!--this table-->
                                    <div class="table-responsive table-bordered" id="tabledatacmd">

                                    </div>
                         </div> 
                     </div>
                    <div class="panel-footer">
                        this is footer
                    </div>
                </div>

            </div>
         </div>
    </div>
 <?php
        break;
        case 'List':
        break;
        case 'add':
?>
<div class="container">
         <div class="row">
            <div class="col-md-12">
                  <ul class="breadcrumb">
                        <li><a href="Dashboard.php">Home</a></li>
                        <li><a href="#">Command</a></li>
                    </ul>
                <div class="panel panel-success">
                
                    <div class="panel-heading" id="cmd_msg" >
                        Command
                    </div>
                    
                    <div class="panel-body" >
                    <div class="tb" id="tb-cmd">
                           <!--end form-->
                            <form class="form-horizontal" action="#" method="POST" id="frm-cmd" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <div class="col-sm-2 col-md-2">
                                                   <select class="form-control"  id='S_clnt' onchange="remv_error('#S_clnt')">
                                                   <option selected disabled>Nom de client</option>
                                                   <!--start fetch client-->
                                                   <?php 
                                                                    $q="SELECT Id_Client,FuLL_Name from client order by FULL_Name";
                                                                    $stmt=$con->prepare($q);
                                                                    $stmt->execute();
                                                                  while($table=$stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                                                                  {
                                                                        echo "<option value='$table[0]'>{$table[1]}</option>";
                                                                    }   
                                                                ?>
                                                    <!--end fetch client-->
                                                   </select>
                                                </div>

                                                <div class="col-sm-2 col-md-2" >
                                                    <div class='' >
                                                        <input id="dt" type="date" class="form-control"    onchange="remv_error('#dt')" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-2">
                                                    <div class='' >
                                                        <input id="tm" type="time" class="form-control"  onchange="remv_error('#tm')" />
                                                    </div>
                                                </div>

                                                <div class="col-sm-2 col-md-2">
                                                    <input type="number" placeholder="quantite de total" min="1" class="form-control"  readonly onchange="remv_error('#qts-total')" id='qts-total'/>
                                                 </div>
                                                 
                                             <div class="col-sm-2 col-md-2">
                                                <input type="number" placeholder="reduction" min='0' max='100' class="form-control" onchange="price_total(); remv_error('#reduction')" id='reduction' />
                                            </div>

                                            </div>
                                            
                                              <div class="table-responsive">
                                                <table class="table-hover table col-md-5 col-ms-4 info" id="cmd">
                                                    <thead> <tr>
                                                        <th>product name</th> 
                                                        <th>quantite</th>
                                                        <th>price</th>
                                                        <th>delete cmd</th> 
                                                    </tr> </theah>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                            <!--select client-->
                                                                <select class="form-control s" id='s1' name='s1' onchange="getprice(1);qts_total();rmvs_readonly(1)"  style="position:relative">
                                                                <option selected disabled>Le Produit</option>
                                                                <!--start fecth prodcut-->
                                                                <?php 
                                                                    $q="SELECT id_Prod,P_name from product ORDER BY P_name";
                                                                    $stmt=$con->prepare($q);
                                                                    $stmt->execute();
                                                                  while($table=$stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
                                                                  {
                                                                        echo "<option value='$table[0]'>{$table[1]}</option>";
                                                                  }   
                                                                ?>
                                                                <!--end fecth product-->
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-7 col-md-7">
                                                            <input type="number" min='1' class="form-control q"   id='q1' onchange="cal_price(1);qts_total();"  />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-sm-7 col-md-7">
                                                            <input type="number" class="form-control p" readonly  id='p1' data-price=''/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                             <div class="col-sm-7 col-md-7">
                                                                <button type="button" class="btn btn-danger" onclick=""><i class="fa fa-trash-o"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-3 col-md-3 pull pull-right">
                                                     <input type="number" placeholder='prix total' class="form-control " id='prix-total'readonly onchange="remv_error('#prix-total)"/>
                                                </div>
                                                <div class="col-sm-3 col-md-3 pull pull-right">
                                                <!--start type payment-->
                                                <select class="form-control" id='tp-py' onchange="set_type_payment();remv_error('#tp-py')">
                                                    <option selected disabled>method</option>
                                                    <option value='1' >Payement</option>
                                                    <option value='2'>Credit</option>
                                                </select>
                                                    <div class='hidden' id='dv-crdt'>
                                                    <div class='rltv'>  <span>date depart</span>   <input type="date"  id="dt_strt" class='form-control'  onchange="remv_error('#dt_strt')"/> </div>
                                                    <div class='rltv'>  <span>date expert </span>  <input type="date"  id="dt_expert" class='form-control'  onchange="remv_error('#dt_expert')"/> </div>
                                                        <div class='rltv'>
                                                         <span>advance </span>  <input type="number"  id="adv_p" class='form-control'  onchange="remv_error('#adv_p')"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-3 col-md-3">
                                                   <button  type="button" class="btn btn-success" id="add-cmdr">Add cmd details</button>
                                                </div>
                                                <div class="col-sm-3 col-md-3 pull pull-right">
                                                   <button  type="button" onclick="get_info_cmd()" class="btn btn-success">save change</button>
                                                </div>
                                            </div>

                                    </form>
                                    <!--end form-->
                         </div> 
                        </div>
                    <div  class="panel-footer panel-success">
                       Command operation
                    </div>
                </div>

            </div>
         </div>
    </div>
<?php
        break;
        case 'edit':
        break;
        default:
        echo 'nathing here';
        break;
     }
    include $tpl.'footer.php';
}else{

header("Location:index.php");
exit();    
}?>