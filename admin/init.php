<?php 
    include 'db_connect.php'; 
    $tpl='includes/templates/';
    $langP='includes/languages/';
    $func="includes/functions/";
    $css='layout/css/';
    $js='layout/js/';
    $paction="includes/phpaction";
    include $func.'funct.php';
    include $langP .'eng.php';
    include $tpl.'header.php';

    if(!isset($noNavBar))
    {
        include $tpl . 'navbar.php';
    }
?>
