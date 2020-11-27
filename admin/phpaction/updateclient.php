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
    $id=$_POST['id_cln'];
    $tele=is_exist("tele","client","tele",$tel,"Id_Client",$id);
    $id_N=is_exist2("id_Na","client","id_Na",$id_Na,"Id_Client",$id);
    $cart=is_exist2("FULL_Name","client","FULL_Name",$full_name,"Id_Client",$id);
    if($id_N>=1)
    {
        $msg="<div class='alert alert-warning'><strong>Le numero  exist </strong></div>";
        echo $msg;
        exit();
    }
    if($id_N>=1)
    {
        $msg="<div class='alert alert-warning'><strong>La cart national  exist </strong></div>";
        echo $msg;
        exit();
    }
    if($cart>=1)
    {
        $msg="<div class='alert alert-warning'><strong>Le Nom  exist </strong></div>";
        echo $msg;
        exit();
    }
    if($full_name =='' || $full_name==null)
    {
        $msg="<div class='alert alert-warning'><strong>Le Nom  obliger </strong></div>"   ;
        echo $msg;
        exit();
    }else{
                $q="UPDATE client 
                SET client.FULL_Name=?,
                    client.id_Na=?,
                    client.tele=?
                 WHERE client.Id_Client=?";
                $stmt=$con->prepare($q);
                $stmt->bindParam(1,$full_name,PDO::PARAM_STR,255);
                $stmt->bindParam(2,$id_Na,PDO::PARAM_STR,55);
                $stmt->bindParam(3,$tel,PDO::PARAM_STR,20);
                $stmt->bindParam(4,$id,PDO::PARAM_INT);
                $stmt->execute();
                    if($stmt->rowcount()>0)
                {
                    $msg.="<div class='alert alert-success'><strong>Inforamtion on mise a jour </strong></div>";
                    echo $msg; 
                }
                else{
                        $msg.="<div class='alert alert-warning'><strong>N'pas de changement!_!</strong></div>"; 
                        echo $msg;          
                }
    }
}