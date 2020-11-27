<?php
 include "../db_connect.php";
 $rcrd;
 $page;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $rcrd= isset($_POST["rc_cmd"])?$_POST["rc_cmd"]:10;
    $page=isset($_POST["page"])?$_POST["page"]:1;
   
}else{
    $rcrd=10;
    $page=1;
}

$strf=($page-1)*$rcrd;
$i=$strf;
$output=" <table class='table  table-striped' id='tbl-cmd'>
        <thead>
             <tr class='th'>
                <th>Num</th>
                <th>client</th>
                <th>quantite totla</th>
                <th>date command</th>
                <th>Reduction</th>
                <th>prix total</th>
                <th>Option</th>
              </tr>
        </thead>
        <tbody >";
    $q="SELECT client.Id_Client,client.FULL_Name,command.Id_Cmd,command.qt,
        DATE_FORMAT(command.Dt_Cmd,'%d-%M-%y %H:%i:%s') as date,command.Redu,command.price_t 
        from (command INNER JOIN client ON command.ID_Client = client.Id_Client)
         ORDER by command.Id_Cmd desc LIMIT {$rcrd} OFFSET {$strf}  ";
    $stmt=$con->prepare($q);
    $stmt->execute();
  while ($table = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
       {
           $i++;
           $output.="<tr>
               <td>{$i}</td>
                <td>{$table[1]}</td> 
                <td>{$table[3]}</td>
                <td>{$table[4]}</td>
                <td>{$table[5]}</td>
                <td>{$table[6]}</td>
                <td class='rem-pro'>
                 <div class='dropdown'>
                      <button class='btn btn-success dropdown-toggle' type='button' data-toggle='dropdown'>Controle
                      <span class='caret'></span></button>
                      <ul class='dropdown-menu'>
                      <li><a href='?actn=Edit&id={$table[2]}'><i class='fa fa-edit'></i> Edit</a></li>
                       <li data-toggle='modal' data-target='#mo-d'  class='prod-val'><a  href='#={$table[2]}'
                        value='$table[2]'> <i class='fa fa-remove'></i> Remove</a></li>
                      </ul>
                      </div>
                  </td>
                </tr>";
      }
      $output.="     </tbody>
            </table>
        </div>";

      $stmx=$con->prepare("SELECT * FROM  command");
      $stmx->execute();
      $total=$stmx->rowcount();
      $ttp=ceil($total/$rcrd);
      $output.="<div id='pg' class='pull pull-left'>";
      for($X=$ttp;$X>0;$X--)
      {
          $output.="<button id='{$X}' value='{$X}' data-val='pager' class='btn btn-success pull pull-right pgncmd'>{$X}</button>";
      }
      $output.="</div>";
      echo $output;