<?php
include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $id=$_POST['id'];

$q="SELECT client.Id_Client,COUNT(client.Id_Client) FROM 
(client INNER JOIN command on client.Id_Client=command.ID_Client)
WHERE client.Id_Client=:id
GROUP BY client.Id_Client;";
 $stmt=$con->prepare($q);
  $stmt->bindParam(":id",$id,PDO::PARAM_INT);
  $stmt->execute();
$cnt=$stmt->rowcount();
    if($cnt==0)
    {

        $q="DELETE client FROM client WHERE ID_Client=?";
        $stmt=$con->prepare($q);
        // $stmt->bindParam(1,$id,PDO::PARAM_INT);
        $stmt->execute(array($id));
        $cnt=$stmt->rowcount();
        if($cnt>0)
        {
        echo"<div class='alert alert-success'>un
            <strong>{$cnt}</strong> client supprime
            </div>";
        }else{
            echo"<div class='alert alert-danger'>Il ya un 
            <strong> problem ou client nexist pas'</strong>
            </div>";
        }
    }else{
        echo"<div class='alert alert-danger'>
            <strong> Vous ne avez pas le droit pour supprime le client</strong>
            </div>";
    }
}