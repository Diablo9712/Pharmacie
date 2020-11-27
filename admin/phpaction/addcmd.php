<?php 
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 include "../db_connect.php";
 $tbl_decodprod=json_decode($_POST['tbl_prod'],true);
 $tbl_decclient=json_decode($_POST['tbl_client'],true);
    $arr_id=array();
//insert into commad details
 $q="INSERT INTO command_details(id_Prod,qt,price) VALUES(?,?,?)";
 $stmt=$con->prepare($q);
 //get length of table product
$cnt=count($tbl_decodprod["productid"]);

    for ($i=0; $i <$cnt ; $i++) { 
        $id=$tbl_decodprod["productid"][$i];
        $qts=$tbl_decodprod["qts"][$i];
        $price=$tbl_decodprod["price"][$i];
        $stmt->execute(array($id,$qts,$price));
        //fetch id of cmd_details
        $q="SELECT `id_cd` FROM `command_details` 
        ORDER BY id_cd DESC LIMIT 1";
        $stf=$con->prepare($q);
        $stf->execute();
        $temp []=$stf->fetch()[0];
        $arr_id []=$temp[$i];
        //subtratc qts from product
        $q="UPDATE product SET qts=qts-? WHERE Id_Prod=?";
        $sqts=$con->prepare($q);
        $sqts->execute(array($qts,$id));
    }
 
//insert into command 
    $q="INSERT INTO command(`ID_Client`,`qt`,`Dt_Cmd`,`Redu`,`price_t`) VALUES(?,?,?,?,?)";
    $stmt=$con->prepare($q);
    $idcln=$tbl_decclient["idclient"];
    $cmd_dt=$tbl_decclient["cmd_dt"];
    $cmd_tm=$tbl_decclient["cmd_tm"];
    $qts_tt=$tbl_decclient["qts_ttl"];
    $price_ttl=$tbl_decclient["prix_total"];
    $rd=$tbl_decclient["rd"];
    $intof=$tbl_decclient["info_pay"];
    $fdate=date($cmd_dt." ".$cmd_tm);
    $test=array($idcln,$qts_tt,$fdate,$rd,$price_ttl);
    $stmt->execute($test);

//get cmd and cmd_detail to insert into cmd_cd
    $q="SELECT `Id_Cmd` FROM `command`
        ORDER by Id_Cmd DESC LIMIT 1 ";
    $stmt=$con->prepare($q);
    $stmt->execute();
    $temp=$stmt->fetch();
    $cmd_id=$temp[0];

        $q="INSERT INTO cmd_cd(`id_cd`,`id_cmd`)
            VALUES(?,?)";
        $stmt=$con->prepare($q);
        for ($i=0; $i <count($arr_id); $i++) { 
            $stmt->execute(array($arr_id[$i],$cmd_id));
        }
//check method of payement
    if(intval($intof[0])!==1 && isset($intof[0]))
    {
        $dt_strt=$intof[0];
        $dt_end=$intof[1];
        $adv=$intof[2];
        //insert into table advance
        $q="INSERT INTO advance(`ID_client`,`Id_Cmd`,`dt_start`,`dt_exp`,`Total`,`adv`) VALUES(?,?,?,?,?,?)";
        $stmt=$con->prepare($q);
        //advance should be sum of advance details
        $stmt->execute(array($idcln,$cmd_id, $dt_strt,$dt_end,$price_ttl,$adv));
        //get id of advance
        $q="SELECT `Id_Adv` FROM advance ORDER by Id_Adv DESC LIMIT 1";
        $stmt_adv=$con->prepare($q);
        $stmt_adv->execute();
        $temp_adv []=$stmt_adv->fetch()[0];
        $id_adv=$temp_adv[0];
        //insert into table of advance detail
        $q="INSERT INTO adv_details(`id_adv`,`price_p`,`dt_paye`) 
            VALUES(?,?,?)";
            $stmt=$con->prepare($q);
            $stmt->execute(array($id_adv,$adv,$dt_strt));
    }else{

        $q="INSERT INTO sell(`ID_client`,`Price`,`Dt_Sell`,`Id_Cmd`) VALUES(?,?,?,?)";
        $stmt=$con->prepare($q);
        $stmt->execute(array($idcln,$price_ttl,$fdate,$cmd_id));
    }

}
