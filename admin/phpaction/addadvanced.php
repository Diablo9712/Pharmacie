<?php
session_start();
include "../db_connect.php";
include "../includes/functions/funct.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
$idv=$_POST["id"];
$dt_paye=$_POST["dt"];
$price_p=$_POST["money"];
//insert into table advace detail
$q="INSERT INTO adv_details(id_adv,dt_paye,price_p)VALUES(?,?,?)";
$stmt=$con->prepare($q);
$stmt->execute(array($idv,$dt_paye,$price_p));
//get the sum of price_paye
$stmt=$con->prepare("SELECT SUM(adv_details.price_p) FROM adv_details
                    WHERE adv_details.id_adv=?");
$stmt->execute(array($idv));
$sum=$stmt->fetch();
//update table advance
$stmt=$con->prepare("UPDATE advance SET advance.adv=?
                    WHERE advance.Id_Adv=?");
                    $stmt->execute(array($sum[0],$idv));
echo"update has been finished";
}