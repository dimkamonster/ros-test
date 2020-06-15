<?php


class Response
{
    protected const status = [
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        204 => "No Content",

        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        409 => "Conflict",
        422 => "Unprocessable Entity",
    ];

    public string $http_code;

    protected array $headers;

    protected $body;

    public string $Location;

    public Model $model;

    public function __construct($params)
    {
        //TODO: make construct. Think about struct of $params
    }

    public function sendHeaders()
    {
//В ответах 2хх с непустым телом обязательно наличие заголовка ответа
//Content-Type: application/json; charset=UTF-8
//        либо, при загрузке файлов,
//Content-Type: multipart/form-data
//
//и далее, в первой части
//Content-Type: application/json; charset=UTF-8
//Content-Disposition: form-data; name="data"
//
//после чего для каждого файла
//Content-Type: image/jpeg
//Content-Disposition: form-data; name="avatar"; filename="user.jpg"
//
//В ответе обязательно должны быть заголовки, касающиеся политики кэширования,
//т.к. браузеры активно кешируют GET и HEAD запросы.
//При остутствии какой-либо политики управления кэшем должно быть:
//Cache-Control: no-store, no-cache, must-revalidate
//Pragma: no-cache
    }

    public function sendBody()
    {

    }

    public function sendResponse(array $params)
    {
//        isset($params['status']) ?

        //TODO: В ответе сначала передаётся строка с версией http,
        //кодом и строковым статусом ответа (например HTTP/1.1 200 OK),
        //далее текстовые заголовки ответа,
        //потом пустая строка,
        //потом тело ответа.
    }

    public function headers(array $params = [])
    {
        if (!empty($params))
        {
            $this->headers = array_merge($this->headers, $params);
            return $this;
        }
        return $this->headers;
    }

    public function sendViaCode(int $code)
    {
        $this->headers = [
            'HTTP'              => strval($code),
            'Content-Type'      => 'application/json; charset=UTF-8',
            'Cache-Control'     => 'no-store, no-cache, must-revalidate',
            'Pragma'            => 'no-cache',
        ];

    }

}