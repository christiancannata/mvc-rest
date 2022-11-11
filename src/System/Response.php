<?php

namespace Christiancannata\PhpApi\System;

class Response
{

    public $body;
    public $headers;
    public $statusCode;

    public function __construct()
    {
        $this->headers = [];
    }

    public function renderJson(array $body = null, $statusCode = 200, $headers = [])
    {

        if (is_array($body)) {
            $this->setBody($body);
        }

        if (!empty($headers)) {
            foreach ($headers as $name => $value) {
                $this->addHeader($name, $value);
            }
        }


        if ($statusCode && is_numeric($statusCode)) {
            $this->setStatusCode($statusCode);
        }

        http_response_code($this->getStatusCode());
        header('Content-Type: application/json; charset=utf-8');

        foreach ($this->getHeaders() as $name => $value) {
            header($name . ': ' . $value);
        }

        echo json_encode($this->getBody());
        die();
    }

    public function getBody()
    {
        return $this->body;
    }


    public function setBody($body)
    {
        $this->body = $body;
    }


    public function getHeaders()
    {
        return $this->headers;
    }


    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }


    public function getStatusCode()
    {
        return $this->statusCode;
    }


    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }


}