<?php

class Redirect{

    public static function redirectToErrorPage($msg=null):void{
        if($msg){
            $_SESSION["err"]=$msg;
        }
        header("Location: ErrorPage.php");
        exit;
    }
}



?>