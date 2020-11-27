<?php
session_start();
include "../db_connect.php";
$msg='';
If($_SERVER["REQUEST_METHOD"]=="POST")
{  

 
    $exist=false;
    $upOk=1;
    $target='data/Uploads/default.png';
    $defaultid=1;
    $uploadOk = 1;
    if(isset($_FILES["url_img"]))
    {
    if($_FILES["url_img"]["size"]>0)
    {
        $target_dir = "data/Uploads/";
        $target_file = $target_dir . basename($_FILES["url_img"]["name"]);
        $target=$target_file;
        $original_info = getimagesize($_FILES["url_img"]["tmp_name"]);
        //get height and width of image
        $original_w = $original_info[0];
        $original_h = $original_info[1];
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["url_img"]["tmp_name"]);
            if($check !== false) {
                $msg+="File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $msg+="File is not an image.";
                $uploadOk = 0;
                $upOk=0;
            }
        }
        // Check if file already exists
        if (file_exists('../'.$target_file)) {
            $msg .="\n<div class='alert alert-info'><strong>file already exists</strong></div>";
            $exist=true;
        }
        //Check file size
        if ($_FILES["url_img"]["size"] > 105000000) {
            $msg .="\n Sorry, your file is too large.";
            $uploadOk = 0;
            $upOk=0;
        }
        //Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $msg .=" \n<div class='alert alert-danger'>Sorry, only <strong>JPG, JPEG, PNG & GIF </strong>files are allowed</div>";
            $uploadOk = 0;
            $upOk=0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg .= " \n<div class='alert alert-danger'>Sorry, your file was not uploaded</div>";
            
        }
        //change size of image
        else{
            if($imageFileType =="png")
            {
                $original_img =imagecreatefrompng($_FILES["url_img"]["tmp_name"]);
            }else{
                $original_img = imagecreatefromjpeg($_FILES["url_img"]["tmp_name"]);
            }    
            $thumb_w = 500;
            $thumb_h = 500;
            $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
            imagecopyresampled($thumb_img, $original_img,
                            0, 0,
                            0, 0,
                            $thumb_w, $thumb_h,
                            $original_w, $original_h);
            if($imageFileType =="png")
                {
                    $background = imagecolorallocate($thumb_img , 0, 0, 0);
                    // removing the black from the placeholder
                    imagecolortransparent($thumb_img, $background);
                    imagepng($thumb_img,'../'.$target_file,8);
                }else{
                    imagejpeg($thumb_img,'../'.$target_file);
                }
        
            imagedestroy($thumb_img);
            imagedestroy($original_img);
        }
    }
}
    //declare scop var
    $id_img=1;
    if($upOk==1)
    {
        //insert img
            if($target !='data/Uploads/default.png')
            {
                if($exist==false)
                {
                    $q="INSERT IGNORE INTO  para.image(U_image) VALUES(?)";
                    $stmt=$con->prepare($q);
                    $stmt->execute(array($target));
                }
        //fecth infromation
        // $msg .= '\n'. $target;
       
            $q="SELECT ID_Img FROM image WHERE U_image= ? LIMIT 1;";
            $stmt=$con->prepare($q);
             $stmt->execute(array($target));
            $fid_img=$stmt->fetch();
            $id_img=$fid_img[0];
            
             }
        //insert into product
            $p_name     =     $_POST["P_name"];
            $Px_unit   =      $_POST["Px_unit"];
            $Px_buy     =     $_POST["Px_buy"];
            $qts        =     $_POST["qts"];
            $id_cat     =     $_POST["catg"];
            $dt_time   =      $_POST["dt_time"];
             $q="insert into para.product(P_Name,Px_unit,Px_buy,qts,Id_Cat,ID_Img,dt_time) values(?,?,?,?,?,?,?)";
             $stmt=$con->prepare($q);
             $stmt->execute(array($p_name,$Px_unit,$Px_buy,$qts,$id_cat,$id_img,$dt_time));
             if($stmt->rowcount()>0){
                $msg .="\n <div class='alert alert-success'>Le produit bien Ajout</div>";
             }
             
    }
    echo  $msg;
}
?>