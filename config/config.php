<?php

class Config
{
    private const salt = 'salt';

    public static function loadClass($class)
    {
//    $class_full_path = $_SERVER['PWD'].'/classes/' . mb_strtolower($class) . '.php';
        $class_full_path = CURRENT_WORKING_DIR . '/classes/' . mb_strtolower($class) . '.php';
        if (file_exists($class_full_path))
            include_once $class_full_path;
    }

    public static function salt()
    {
        return self::salt;
    }

    public static function init()
    {
        spl_autoload_register(array('Config', 'loadClass'));

//Register user. Return token on success, also, return error if fields not set, if email already registered.
//user send json with email, password, name, etc.
        Route::add('POST', 'user\/(register)', 'users');
//        Route::add('PUT', 'user\/(register)', 'users');
//        Route::add('GET', 'user\/(register)', 'users');

//login user.
//user send email, password, return new token or error
//to db - new token,
        Route::add('POST', 'user\/(login)', 'users');

//return ok if everything is ok. Need users email (login) and token (if authenticated)

//user send email, token, some sets information. If session expired, return link on auth.
//if last auth time - end of token lifetime, renew token and send to user new token.
//Router::add('POST', 'user\/(set)\/id([0-9]+)','users');
        Route::add('POST', 'user\/(set)', 'users');

//Router::add('GET','user\/(get)\/id([0-9]+)','users');
        Route::add('GET', 'user\/(get)', 'users');

//Router::add('POST', 'user\/id([0-9]+)','users');
    }
}

Config::init();