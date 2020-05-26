<?php


class Request
{
    protected ?string $method;

    protected $headers = false;

    protected $body = NULL;

    protected ?string $uri;

    protected ?string $action;

    protected ?string $controller = NULL;

    protected bool $valid = false;

    public function __construct()
    {
//        isset($_SERVER['REQUEST_METHOD']) ? $this->method = mb_strtoupper($_SERVER['REQUEST_METHOD']) : '';
        $this->method = mb_strtoupper($_SERVER['REQUEST_METHOD']) ?? NULL;
        if (function_exists('apache_request_headers')) {
            $this->headers = apache_request_headers();
        } elseif (extension_loaded('http')) {
            $this->headers = http_get_request_headers();
        }

        $this->method !== 'GET' ? $this->body = file_get_contents('php://input') : NULL;
        $this->uri = trim($_SERVER['REQUEST_URI'],'/') ?? NULL;

        $this->validateRequest();
    }

    private function validateRequest()
    {
        $routes = Route::getRoutes();

        if (isset($this->method) && !is_null($this->uri)) {
            foreach ($routes[$this->method] as $pattern => $controller) {
                if (preg_match('/' . $pattern . '/', $this->uri, $matches)) {
                    $this->controller = $controller;
                    $this->valid = true;
                    $this->action = $matches[1] ?? NULL;
                    break;
                }
            }
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function method(): ?string
    {
        return $this->method;
    }

    /**
     * @return array|false
     */
    public function headers()
    {
        return $this->headers;
    }
    
    /**
     * @return false|string|null
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * @return string or NULL
     */
    public function controller(): ?string
    {
        return $this->controller;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->valid;
    }

    /**
     * @return string|null
     */
    public function action(): ?string
    {
        return $this->action;
    }

}