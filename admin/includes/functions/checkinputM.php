<?php

$HE=array();
if($username!==preg_replace("/[^a-zA-Z 0-9]+/","",$username))
{
    $HE[]="<div class='alert alert-danger col-sm-4 col-sm-offset-4'>
            <strong>username!</strong> this field can accept special character
         </div>";
}
 if(strlen($username)<4)
 {
    $HE[]="<div class='alert alert-danger col-sm-4 col-sm-offset-4'>
    <strong>username !</strong> please use more than 4 character
 </div>";
    
 }
 if(strlen($username)>20)
 {
    $HE[]="<div class='alert alert-danger col-sm-4 col-sm-offset-4'>
    <strong>username!</strong> please use less than 20 character
    </div>";
 }
foreach($HE as $key)
{
echo $key;
}
?>