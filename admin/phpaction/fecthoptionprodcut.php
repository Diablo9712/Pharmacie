<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $opt='';
    include "../db_connect.php";
    $s="SELECT id_Prod,P_name from product order by P_name";
    $stmt=$con->prepare($s);
    $stmt->execute();
    while($table=$stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
    {
        $opt .= "<option value='$table[0]'>{$table[1]}</option> \n";
    }   

    echo $opt;
}