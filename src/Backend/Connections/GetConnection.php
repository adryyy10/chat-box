<?php

namespace Src\Backend\Connections;

class GetConnection
{

    private $url;
    private $headers;

    public function __construct($url, $headers)
    {
        $this->url = $url;
        $this->headers = $headers;

    }

    public function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }

}