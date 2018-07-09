<?php

class RequestRouting
{

    public static function GetActionName()
    {
        require_once ("FrontController.php");

        if(!empty($_GET))
        {
            reset($_GET);
            $ActionNameFromGet = key($_GET)."Action";
        }else{
            $ActionNameFromGet = "indexAction";
        }

        if(method_exists('FrontController' , $ActionNameFromGet))
        {
            FrontController::$ActionNameFromGet();
        }else{
            FrontController::IndexAction();
        }
    }
}