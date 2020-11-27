<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q="SELECT client.Id_Client,client.FULL_Name,SUM(command.price_t) as prix,SUM(command.qt) as qts
    FROM client,command
    WHERE client.Id_Client=command.ID_Client
    GROUP BY client.Id_Client
    ORDER BY prix DESC LIMIT 5";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $output="<table class='table table-bordered table-inverse'>
                <thead class='bg-trns'>
                    <tr>
                        <th>
                        Les clients
                        </th>
                        <th>
                        Prix
                        </th>
                        <th title='Nombre total des produit'>
                            Nbr produit
                        </th>
                    </tr>
                </thead>
                <tbody>
                ";
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
    $output.="<tr>
                    <td>
                    {$row[1]}
                    </td>
                    <td>
                    {$row[2]}
                    </td>
                    <td>
                    {$row[3]}
                    </td>
                </tr>
                ";
    }
    $output.="</tbody>
                </table>";
    echo $output;
}

?>