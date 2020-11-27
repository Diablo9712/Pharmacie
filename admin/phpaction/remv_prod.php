<?php
session_start();
include "../db_connect.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $id_prod=$_POST['id_pr'];
    $q="SELECT command_details.id_Prod FROM command_details
    WHERE Id_Prod=?";
    $stmt=$con->prepare($q);
    $stmt->execute(array($id_prod));
if($stmt->rowcount()==0)
{
        $q="DELETE product
        FROM product
        WHERE Id_Prod=?";
        $stmt=$con->prepare($q);
    $stmt->execute(array($id_prod));
        if($stmt->rowcount()>0)
        {
            echo "<div class='alert alert-success'>Le produit supprime</div>";
        }
        else{
            echo "<div class=' alert alert-warning'>Il ya un problem</div>";
        }

    }
    else{
        echo "<div class='alert alert-warning'>Ne peux pas le droit pour suprime le produit car il a utilise</div>";
    }
}