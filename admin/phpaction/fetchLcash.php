<?php 
 include "../db_connect.php";
$i=0;

    $q="SELECT sell.Id_Sell,full_Name,DATE_FORMAT(sell.Dt_Sell,'%d-%m-%Y') as dt_sell,sell.Price,command.Redu
        FROM 	`client`,
		sell ,
        command
        WHERE
        command.ID_Client=client.Id_Client 
        and sell.ID_client=client.Id_Client
        AND sell.Id_Cmd=command.Id_Cmd
        ORDER by sell.Id_Sell DESC ";
    $stmt=$con->prepare($q);
    $stmt->execute();
$output=" <table class='table table-striped table-bordered table-hover table-blue' id='tb-cash'>
            <thead ><tr class='thd'>
            <th>NUM</th>
            <th>Nom client</th>
            <th>Date d'avant</th>
            <th>Prix total</th>
            <th>Reduction</th>
            <th>Control</th>
            </tr></thead>
            <tbody>";
  while ($table = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) 
       {
           $i++;
           $output.="<tr>
               <td>{$i}</td>
                <td >{$table[1]}</td>
                <td>{$table[2]}</td>
                <td>{$table[3]} DH</td>
                <td>{$table[4]} DH</td>
                <td test</td>
                </tr>";
      }
      $output.="     </tbody>
            </table>";
      echo $output;