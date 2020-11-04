<?php

namespace Src\Backend\Apis;

use Src\Backend\Connections\GetConnection;

class UrlAPi
{

    public function getUrlApi()
    {
        $accessToken = new Token;
        $accessToken = $accessToken->getToken();
        $url = 'https://api.inbenta.io/v1/apis';
        $headers = array(
            'x-inbenta-key: ' .  $accessToken['apiKey'],
            'Authorization: Bearer '. $accessToken['accessToken']
        );
        $getConnection = new GetConnection($url, $headers);
        $response = $getConnection->get();
        $chatBotApiUrl = $response->apis->chatbot . "/v1";


        return array(
            "chatBotApiUrl" => $chatBotApiUrl,
            "apiKey" => $accessToken['apiKey'],
            "accessToken" => $accessToken['accessToken']
        );
    }

}