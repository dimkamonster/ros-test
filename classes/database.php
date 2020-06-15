<?php


class Database
{
    protected static ?mysqli $_instance = null;

    private const DB_HOST = 'localhost';
	private const DB_NAME = 'rosberry';
	private const DB_USER = 'rosberry';
	private const DB_PASS = 'qwerty12!';

    public const SELECT = 'SELECT';
    public const INSERT = 'INSERT';
    public const UPDATE = 'UPDATE';
    public const DELETE = 'DELETE';
    public const DESCRIBE = 'DESCRIBE';

    public static string $lastQuery;

    private function __construct()
    {
        try
        {
            self::$_instance = new mysqli(self::DB_HOST,self::DB_USER,self::DB_PASS,self::DB_NAME);
            if (self::$_instance->connect_errno) {
                throw new Exception('Error while connecting to DB. ' . self::$_instance->connect_error);
            }
        }
        catch (Exception $e)
        {
            // No connection exists
            self::$_instance = NULL;
            return NULL;
        }
        self::$_instance->set_charset('utf8mb4');
    }


	private function __clone () {}
	private function __wakeup () {}

    /**
     * Get instance of Mysqli
     * @return mysqli|null
     */
    public static function getInstance(): ?mysqli
    {
        if (!is_null(self::$_instance))
            return self::$_instance;

        $inst = new self;

        return self::$_instance;
    }

}