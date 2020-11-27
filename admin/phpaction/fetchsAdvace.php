<?php 
include "../db_connect.php";
include "../includes/functions/funct.php";
if($_SERVER["REQUEST_METHOD"]=="POST")
{  /*$arra []=Array();*/
    $id=$_POST['id'];
    $q="SELECT `id_advd`,`id_adv`,`price_p`, DATE_FORMAT(dt_paye,'%d-%m-%Y') as dt_paye  
        from adv_details WHERE adv_details.id_adv=?";
    $stmt=$con->prepare($q);
    $stmt->execute(array($id));
    $output=" <table class='table table-striped'>
        <thead class='thead thead-light'>
        <tr class='thd'>
         <th>date de payement</th> 
         <th>Prix paye</th> 
         </tr><thead>
         <tbody>
        ";
    while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
    {
            $output.="
                        <tr>
                            <td>{$row[3]}</td>
                             <td>{$row[2]}DH</td>
                        </tr>
            
            ";
    }
    $output.="
                </tbody>
                </table>
    ";
// echo json_encode($arra);
    echo $output;
}