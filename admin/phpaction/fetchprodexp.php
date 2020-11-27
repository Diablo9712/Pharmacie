<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q=" SELECT product.P_Name,DATEDIFF(product.dt_time,NOW()) as ds from product
    WHERE DATEDIFF(product.dt_time,NOW())<=0  ;";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $output="<ul class='list-group'>
    <li class='list-group-item sq-bg3'>Les Produit<span class='badge badge-primary badge-pill active'>jour passe</span></li>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
            $output.="<li class='list-group-item'>{$row[0]}<span class='badge label-primary badge-pill'>{$row[1]}</span></li>";
    }
    $output.="</ul>";
    echo $output;
}

?>