<?php
define('CURRENT_WORKING_DIR', str_replace("\\", '/', $dirname = dirname(__FILE__)));
require_once 'config/config.php';

$query = new Request();

if ($query->valid()) {
    echo 'valid!';
}
echo '33';