<?php

namespace Christiancannata\PhpApi\System;

class Request
{

    private $method;
    private $headers;
    private $body;
    private $uri;
    private $queryParams;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->headers = getallheaders();
        $this->queryParams = $_GET;
        $this->body = file_get_contents('php://input');
        $this->body = json_decode($this->body, true);
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getHeaders()
    {
        return $this->headers;
    }


    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function getBody()
    {
        return $this->body;
    }


    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }


    public function getQueryParams()
    {
        return $this->queryParams;
    }


    public function setQueryParams($queryParams)
    {
        $this->queryParams = $queryParams;
    }

    public function validate(array $validation)
    {

        $errors = [];

        $fields = array_keys($this->body);

        foreach ($validation as $fieldToValidate) {
            if (!in_array($fieldToValidate, $fields)) {
                $errors[] = $fieldToValidate;
            } else if (in_array($fieldToValidate, $fields) && empty($this->body[$fieldToValidate])) {
                $errors[] = $fieldToValidate;
            }
        }

        return $errors;

    }
}