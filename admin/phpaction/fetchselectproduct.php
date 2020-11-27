<?php 
include "../db_connect.php";
$id_pro;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $id_pro=isset($_POST['s'])?$_POST['s']:0;
   //----------------------------------------------------------------------------------------//
    $q="SELECT  `Id_Prod` ,`Px_unit`,`qts`
    from product
    WHERE  Id_Prod={$id_pro}";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $prod_table=$stmt->fetch();
    echo json_encode($prod_table);
}