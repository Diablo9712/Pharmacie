<?php
session_start();
include "../db_connect.php";
include "../includes/functions/funct.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{   
    $msg=''; 
    $full_name=$_POST['F_name'];
    $id_Na=$_POST['id_Na'];
    $tel=$_POST['tel'];
    $roun=is_exist("id_Na","client","id_Na",$id_Na);
    $cart=is_exist("FULL_Name","client","FULL_Name",$full_name);
    if($cart>0)
    {
        echo "<div class='alert alert-info'><strong>Le Nom Exist</strong></div>";
        exit();
    }

    if($full_name =='' || $full_name==null)
    {
        $msg="<div class='alert alert-warning'><strong>Le Nom  obliger </strong></div>";
        
    }else{
        if($roun==0)
        { 
                $q="INSERT INTO client(id_Na,FULL_Name,tele) Values(?,?,?)";
                $stmt=$con->prepare($q);
                $stmt->bindParam(1,$id_Na,PDO::PARAM_STR,55);
                $stmt->bindParam(2,$full_name,PDO::PARAM_STR,255);
                $stmt->bindParam(3,$tel,PDO::PARAM_STR,20);
                $stmt->execute();
                    if($stmt->rowcount()>0)
                {
                    $msg.="<div class='alert alert-success'><strong>Client Bient ajout</strong></div>";
                }
                else{
                        $msg.="<div class='alert alert-warning'><strong>Il ya un problem !_!</strong></div>";           
                }
        }else{
            $msg.="<div class='alert alert-info'><strong>Le numero de cart  Exist</strong></div>";
        }
    }
   echo $msg;
}