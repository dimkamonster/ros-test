<?php


class Auth
{
    protected const salt = 'keyToGenerateTokensInAuthClass';

    protected $_authorized = false;

    public function __construct(Request $request)
    {
        //TODO: check for email, token valid form headers at request
    }

    public function isAuthorized()
    {
//        TODO: если пользователь не авторизован - логируем это в лог! и отпинываем пользователя
        return true;
    }

    public static function hashData(string $data, string $method = 'sha256')
    {
        $key = self::salt;
        return hash_hmac($method, $data, $key);
    }

    public static function getToken($num_bytes = 64)
    {
        return bin2hex(openssl_random_pseudo_bytes($num_bytes));
    }

    public static function getPWDHash($password): string
    {
        return password_hash($password.self::salt, CRYPT_SHA512);
    }

    protected static function PWDVerify(string $postPWD, string $dbPWD)
    {
        return password_verify($postPWD, $dbPWD);
    }

}