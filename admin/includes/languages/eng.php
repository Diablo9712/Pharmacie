<?php

    function lang($phrase)
    {
            static $lang=array(
                "MESSAGE"=>"Welcome",
                "admin"=>"administratore"
            );

            return $lang[$phrase];
    }
?>