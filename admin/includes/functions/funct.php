<?php
/*
-v1.0
-set title
*/
function gettitle()
{
 global $title;
 if(isset($title))
    {
        echo $title;
    }else{
        echo "default";
    }
}
/*
-v1.0
-check if item exist[accept prameters]
-select
-column=this pass by paramter
-from  
-table=paramter
-where
-value=pramter
*/
function is_exist($select,$table,$COL,$value)
{
    global $con;
    $q="SELECT {$select} FROM {$table} WHERE {$COL}=?";
    $exstmt=$con->prepare($q);
    $exstmt->execute(array($value));
    $rcount=$exstmt->rowcount();
    return $rcount;
}
/*-v1.1
-check if item exist[accept prameters]
-select
-column=this pass by paramter
-from  
-table=paramter
-where
-value=pramter
-difrent id
*/
function is_exist2($select,$table,$COL,$value,$id,$val_id)
{
    global $con;
    $q="SELECT {$select} FROM {$table} WHERE {$COL}=? AND {$id} !={$val_id}";
    $exstmt=$con->prepare($q);
    $exstmt->execute(array($value));
    $rcount=$exstmt->rowcount();
    return $rcount;
}