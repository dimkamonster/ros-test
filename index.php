<?php
define('CURRENT_WORKING_DIR', str_replace("\\", '/', $dirname = dirname(__FILE__)));
require_once 'config/config.php';


phpinfo();

//$routes = Router::get();
$controller = Router::getCotroller();
echo '33';