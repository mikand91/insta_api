<?php

require_once ("Api/InstagramApi.php");
require_once ("Csv/Csv.php");

class FrontController
{

    public static function indexAction()
    {
        require_once ("Views/index.html");
    }

    public static function csvAction()
    {
        InstagramApi::GetCode();
    }

    public static function codeAction()
    {
        Csv::StoreDataToCsv(InstagramApi::GetInstagramData("natural" , 100));
    }

    public static function thankyouAction()
    {
        require_once ("Views/thank.html");
    }



}