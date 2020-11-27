<?php 
 include "../db_connect.php";
 $rcrd;
 $page;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $rcrd= isset($_POST["rc_crnt"])?$_POST["rc_crnt"]:10;
    $page=isset($_POST["page"])?$_POST["page"]:1;
   
}else{
    $rcrd=10;
    $page=1;
}
$strf=($page-1)*$rcrd;
$i=$strf;
$stmx=$con->prepare("SELECT * FROM advance");
$stmx->execute();
$total=$stmx->rowcount();
$ttp=ceil($total/$rcrd);
$output="<div id='pg' class='pull pull-left'>";
for($X=$ttp;$X>0;$X--)
{
    $output.="<button id='{$X}' value='{$X}' data-val='pager' class='btn btn-success pull pull-right pgnadv'>{$X}</button>";
}
$output.="</div>";
$output.=" <table class='table table-striped table-bordered table-hover table-blue' id='tb-adv'>
            <thead ><tr class='thd'>
            <th>NUM</th>
            <th>Nom client</th>
            <th>Date d'epart</th>
            <th>Date d'expert</th>
            <th>Prix total</th>
            <th>Prix paye</th>
            <th>Prix on doit paye</th>
            <th>Jour rest</th>
            <th>Control</th>
            </tr></thead>
            <tbody>";
    $q="SELECT adv.Id_Adv,adv.ID_client,cl.FULL_Name,DATE_FORMAT(adv.dt_start,'%d-%m-%Y') as dt_strt,DATE_FORMAT(adv.dt_exp,'%d-%m-%Y') as dt_exrpt,adv.Total,adv.adv,(adv.Total-adv.adv),DATEDIFF(adv.dt_exp,Now())
    FROM
    advance as adv ,client as cl
    WHERE
    adv.ID_client=cl.Id_Client ORDER by Id_Adv  desc LIMIT {$rcrd}  OFFSET {$strf} ";
    $stmt=$con->prepare($q);
    $stmt->execute();
  while ($table = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
       {
           $i++;
           $output.="<tr>
               <td>{$i}</td>
                <td >{$table[2]}</td>
                <td>{$table[3]}</td>
                <td>{$table[4]}</td>
                <td>{$table[5]}</td>
                <td>{$table[6]}</td>
                <td>{$table[7]}</td>
                <td>{$table[8]}</td>
                <td class='rem-pro'>
                <button class='btn btn-success' data-toggle='modal' data-target='#madv_d' onclick='send_id(\"#id_adv\",{$table[0]})' type='button'><i class='fa fa-plus'></i> Add payement</button>
                <button class='btn btn-info' data-toggle='modal' data-target='#mo-crnt' type='button' data-tem=\"onclick='send_id(\"#id-pr\",{$table[0]})'\">
                 <i class='fa fa-book'></i> More details</button>
                  </td>
                </tr>";
      }
      $output.="     </tbody>
            </table>
        </div>";
      echo $output;