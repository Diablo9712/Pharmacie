<?php
 include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $q="    
    SELECT (SELECT sum(product.qts*product.Px_unit) as capital FROM product) as capital,
            (SELECT SUM(command.qt*command.price_t) as venttotal from command) as vent,
            (SELECT SUM(advance.adv) as 'pure vent' from advance) as purvent;";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $rows=$stmt->fetchAll();
    echo json_encode($rows);
}

?>