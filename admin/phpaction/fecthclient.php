<?php

 include "../db_connect.php";
 $rcrd;
 $page;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $rcrd= isset($_POST["rc_c"])?$_POST["rc_c"]:10;
    $page=isset($_POST["page"])?$_POST["page"]:1;
   
}else{
    $rcrd=10;
    $page=1;
}
$strf=($page-1)*$rcrd;
$i=$strf;
$stmx=$con->prepare("SELECT * FROM  client");
$stmx->execute();
$total=$stmx->rowcount();
$ttp=ceil($total/$rcrd);
$output="<div id='pg' class='pull pull-left'>";
for($X=$ttp;$X>0;$X--)
{
    $output.="<button id='{$X}' value='{$X}' data-val='pager' class='btn btn-success pull pull-right  pgnc'>{$X}</button>";
}
$output.="</div>";
$output.=" <table class='table col-md-5 col-ms-4' id='tb-client'>
<thead class='thead thead-dark'>
<tr class='thd'>
 <th>NUM</th> 
 <th>ID</th>
 <th>ID National</th>
 <th>Nom complete</th>
 <th>tele</th>
 <th>Controle</th> </tr><thead>
";
$q="SELECT * from client ORDER BY Id_Client desc LIMIT {$rcrd} OFFSET {$strf} ";
$stmt=$con->prepare($q);
    $stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
{
    $i++;
    $output.="<tbody><tr>
    <td>{$i}</td> 
    <td>{$row[0]}</td>
     <td>{$row[1]}</td> 
     <td>{$row[2]}</td> 
     <td>{$row[3]}</td> 
      <td>
    <button class='btn btn-success' data-toggle='modal' id='{$row[0]}' onclick='send_id(\"#id_cln\",{$row[0]});send_infoclient(\"#id_Nax\",{$row[0]})' data-target='#mo-editc'>Edit</button>
     <button data-toggle='modal' data-target='#mo-dc' onclick='send_id(\"#id_client\",{$row[0]})' class='btn btn-danger' >Remove</button>
    </td>    </tr></tbody>";
   //?actn=Edit&id={$row[0]} edit
}

$output.="</table>";
      echo $output;