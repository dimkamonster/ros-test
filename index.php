<?php
define('CURRENT_WORKING_DIR', str_replace("\\", '/', $dirname = dirname(__FILE__)));
require_once 'config/config.php';

$request = new Request();

if ($request->valid()) {
    $controller = $request->controller();
    $result = (new $controller($request))->action($request->action());

    //TODO: generate Response class based on response of action method. Set headers, body and then send it to user
    $response = new Response($result);
    if ($response instanceof Response)
    {
//        $response->sendResponse();
    }

    echo 'valid!';
}
echo '33';