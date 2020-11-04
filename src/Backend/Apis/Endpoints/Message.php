<?php

namespace Src\Backend\Apis\Endpoints;

use Src\Backend\Connections\PostConnectionNoEncode;

class Message
{

    public function sendMessage()
    {

        $conversation = new Conversation;
        $conversation = $conversation->start();
        $url = $conversation['urlConversation'] . "/message";
        $headers = array(
            'x-inbenta-key: ' .  $conversation['apiKey'],
            'Authorization: Bearer '. $conversation['accessToken'],
            'x-inbenta-session: Bearer ' . $conversation['response']->sessionToken
        );
        $message = 'Hello my friend';
        $body = array(
            'message' => $message
        );

        $response = new PostConnectionNoEncode($url,$headers,$body);
        $response = $response->post();
        
        return array(
            "response" => $response,
            "url" => $url
        );
    }
}