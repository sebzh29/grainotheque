<?php

class Database
{

    private static $dbHost = "localhost";
    private static $dbName = "grainotheque";
    private static $dbUser = "root";
    private static $dbUserPwd = "root"; 

    private static $connection = null;

    public static function connect()
    {
        try
        {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPwd);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }

}

?>