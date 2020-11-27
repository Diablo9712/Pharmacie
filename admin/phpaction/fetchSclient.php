<?php 
include "../db_connect.php";
include "../includes/functions/funct.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{  
    $id=$_POST['id'];
    $q="SELECT * from client  where id_client=? LIMIT 1";
    $stmt=$con->prepare($q);
    $stmt->execute(array($id));
    $row=$stmt->fetch();
     echo json_encode($row);

}