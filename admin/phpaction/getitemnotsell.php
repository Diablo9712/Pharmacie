<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q=" SELECT  product.P_Name,categorie.Nom_Cat,product.qts
    FROM	product,categorie
    WHERE product.Id_Prod not in(SELECT command_details.id_Prod FROM command_details)
    AND product.Id_Cat=categorie.Id_Cat";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $output="<table class='table table-bordered'>
                <thead class='bg-trns'>
                    <tr>
                        <th title='Le Nom de produit'>
                        les produits
                        </th>
                        <th>
                        Categorie
                        </th>
                        <th title='qunatite on stock'>
                        qts
                        </th>
                    </tr>
                </thead>
                <tbody>
                ";
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
    $output.="<tr>
                    <td>
                    {$row[0]}
                    </td>
                    <td>
                    {$row[1]}
                    </td>
                    <td>
                    {$row[2]}
                    </td>
                </tr>
                ";
    }
    $output.="</tbody>
                </table>";
    echo $output;
}

?>