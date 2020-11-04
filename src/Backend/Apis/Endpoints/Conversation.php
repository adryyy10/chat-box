<?php

namespace Src\Backend\Apis\Endpoints;

use Src\Backend\Apis\UrlAPi;
use Src\Backend\Connections\PostConnection;

class Conversation
{
    public function start(){

        $urlApi = new UrlAPi;
        $urlApi = $urlApi->getUrlApi();

        $headers = array(
            'x-inbenta-key: ' .  $urlApi['apiKey'],
            'Authorization: Bearer '. $urlApi['accessToken']
        );
        $url = $urlApi['chatBotApiUrl'] . "/conversation";

        $response = new PostConnection($url, $headers, '');
        $response = $response->post();


        return array(
            "response" => $response,
            "apiKey" => $urlApi['apiKey'],
            "accessToken" => $urlApi['accessToken'],
            "urlConversation" => $url
        );
    }
}