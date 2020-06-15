<?php


abstract class API_Template
{
    private const apiver = '0.01';

    private array $headers;

    private string $response;

    private int $responceCode;

    public function sendHeaders()
    {

    }

    private function validate()
    {

    }

    //режим JSON_UNESCAPED_UNICODE обязателен

    public function sendResponse()
    {

    }

    abstract public function get($params): array;

//    abstract public function post(stdClass $params): array;
    abstract public function post(string $str): array;

    abstract public function put($params);

    abstract public function head($params);

    abstract public function patch($params);

    abstract public function delete($params);

    abstract public function options($params);

}