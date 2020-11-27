<?php
 include "../db_connect.php";
 $rcrd;
 $page;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $rcrd= isset($_POST["rcrd"])?$_POST["rcrd"]:10;
    $page=isset($_POST["page"])?$_POST["page"]:1;
   
}else{
    $rcrd=10;
    $page=1;
}

$strf=($page-1)*$rcrd;
$i=$strf;
$stmx=$con->prepare("SELECT * FROM  product");
$stmx->execute();
$total=$stmx->rowcount();
$ttp=ceil($total/$rcrd);
$output="<div id='pg' class='pull pull-left'>";
for($X=$ttp;$X>0;$X--)
{
    $output.="<button id='{$X}' value='{$X}' data-val='pager' class='btn btn-success pull pull-right pgn'>{$X}</button>";
}
$output.="</div>";
$output.=" <table class='table table-bordered table-striped' id='tb-product'>
            <thead ><tr class='thd'>
            <th>NUM</th>
            <th>Image</th>
            <th>Nom produit</th>
            <th>Categorie</th>
            <th>Prix d'achat</th>
            <th>Prix de vente</th>
            <th>Quatite on stock</th>
            <th>Date d'expert</th>
            <th>Control</th>
            </tr></thead>
            <tbody>";
    $q="SELECT  `Id_Prod` ,`U_image`,`P_Name`,`Nom_cat`,`Px_buy`,`Px_unit`,`qts`,`dt_time`
    from   ((product
    INNER JOIN image ON product.Id_Img = image.ID_Img)
    INNER JOIN categorie ON product.Id_Cat=categorie.Id_Cat) ORDER by `Id_Prod` desc LIMIT {$rcrd}  OFFSET {$strf}  ";
    $stmt=$con->prepare($q);
    $stmt->execute();
  while ($table = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
       {
           $i++;
           $output.="<tr>
               <td>{$i}</td>
                <td> <img src='{$table[1]}' style='height:50px; width:50px;'> </td> 
                <td >{$table[2]}</td>
                <td>{$table[3]}</td>
                <td>{$table[4]}</td>
                <td>{$table[5]}</td>
                <td>{$table[6]}</td>
                <td>{$table[7]}</td>
                <td class='rem-pro'>
                <a class='btn btn-success' href='?actn=Edit&id={$table[0]}'><i class='fa fa-edit'></i> Edit</a>
                <button class='btn btn-danger' data-toggle='modal' data-target='#mo-d' type='button' onclick='send_id(\"#id-pr\",{$table[0]})'>
                 <i class='fa fa-remove'></i> Remove</button>
                  </td>
                </tr>";
      }
      $output.="     </tbody>
            </table>
        </div>";
      echo $output;