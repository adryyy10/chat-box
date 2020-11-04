<?php

namespace Src\Backend\Connections;

class PostConnectionNoEncode
{

    private $url;
    private $headers;
    private $body;

    public function __construct($url, $headers, $body)
    {
        $this->url = $url;
        $this->headers = $headers;
        $this->body = $body;

    }

    public function post()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

}