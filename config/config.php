<?php

function loadClass($class)
{
//    $class_full_path = $_SERVER['PWD'].'/classes/' . mb_strtolower($class) . '.php';
    $class_full_path = CURRENT_WORKING_DIR. '/classes/' . mb_strtolower($class) . '.php';
    if (file_exists($class_full_path))
        include_once $class_full_path;
}

spl_autoload_register('loadClass');

//Register user. Return token, return id? or just a token??? also, return error if fields not set, if email already registered.
Router::add('POST', 'user\/register','users');

//login user. Return token or error
Router::add('POST', 'user\/login','users');

//return ok if everything is ok. Need users email (login) and token (if authenticated)
Router::add('POST', 'user\/set\/id([0-9]+)','users');

Router::add('GET','user\/get\/id([0-9]+)','users');

//Router::add('POST', 'user\/id([0-9]+)','users');


