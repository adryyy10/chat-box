<?php

namespace Src\Backend\Apis;

use Src\Backend\Connections\PostConnection;


class Token
{
    public function getToken()
    {
        $url = 'https://api.inbenta.io/v1/auth';
        $apiKey = 'nyUl7wzXoKtgoHnd2fB0uRrAv0dDyLC+b4Y6xngpJDY='; 
        $secret = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9qZWN0IjoieW9kYV9jaGF0Ym90X2VuIn0.anf_eerFhoNq6J8b36_qbD4VqngX79-yyBKWih_eA1-HyaMe2skiJXkRNpyWxpjmpySYWzPGncwvlwz5ZRE7eg';
        $headers = array(
            'x-inbenta-key: ' .  $apiKey,
            'Content-type: application/json'
        );
        $body = array(
            'secret' => $secret
        );


        $postConnection = new PostConnection($url,$headers,$body);
        $response = $postConnection->post();
        
        $accessToken = $response->accessToken;

        return array(
            "accessToken" => $accessToken,
            "url" => $url,
            "apiKey" => $apiKey
        );
    }
}