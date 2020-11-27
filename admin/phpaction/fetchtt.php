<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q=" select (SELECT COUNT(command.Id_Cmd) FROM command) as tcm,
    (SELECT COUNT(product.Id_Prod) FROM product WHERE  product.Id_Cat=1) as tpara,
    (SELECT COUNT(product.Id_Prod) FROM product WHERE  product.Id_Cat=2) as tbtq,
    (SELECT COUNT(client.Id_Client) FROM client) as clnt,
    (SELECT COUNT(sell.Id_Sell) FROM sell)as vent;";
    $stmt=$con->prepare($q);
    $stmt->execute(array());
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
        $output[]=$row;
    }
    echo json_encode($output);
}

?>