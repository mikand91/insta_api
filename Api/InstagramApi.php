<?php

class InstagramApi
{
    public static function GetCode()
    {
        $ClientId = '83768e75468245a4bbb90614f3fa666f';
        $RedirectUri = 'http://mikand91.ayz.pl/api';
        header("Location: https://api.instagram.com/oauth/authorize/?client_id=$ClientId&redirect_uri=$RedirectUri&response_type=code&scope=public_content");
    }

    private static function Connect()
    {
        define('CLIENT_ID' , "XXXXX");
        define('CLIEN_SECRET' , 'XXXXX');

        $url = "https://api.instagram.com/oauth/access_token";
        $access_token_parameters = array(
            'client_id' => CLIENT_ID,
            'client_secret' => CLIEN_SECRET,
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://mikand91.ayz.pl/api',
            'code' => $_GET['code']
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_parameters);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);
        $token = $data['access_token'];
        return $token;
    }

    public static function GetInstagramData($hashtag , $limit)
    {
        $token = InstagramApi::connect();
        $url = "https://api.instagram.com/v1/tags/$hashtag/media/recent?access_token=$token&count=$limit";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);

        return $data['data'];
    }


}