<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q=" SELECT product.Id_Prod,product.P_Name,categorie.Nom_Cat
    FROM product,categorie
    WHERE categorie.Id_Cat=product.Id_Cat
    ORDER by product.Id_Prod DESC LIMIT 6 ;";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $output="<ul class='list-group'>
    <li class='list-group-item '>Nom produit
    <span class='badge border-right badge-primary'>categorie</span>
    </li>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
    $output.="<li class='list-group-item'>{$row[1]}
    <span class='badge badge-primary badge-pill'>{$row[2]}</span>
    </li>";
    }
    $output.="</ul>";
    echo $output;
}

?>