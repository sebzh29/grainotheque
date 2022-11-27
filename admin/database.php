<?php

class Database
{

    // Local
    // private static $dbHost = "localhost";
    // private static $dbName = "grainotheque";
    // private static $dbUser = "root";
    // private static $dbUserPwd = "root"; 

    // Hosteur
    private static $dbHost = "sql-server.k8s-w0d46t4q";
    private static $dbName = "grainotheque";
    private static $dbUser = "sebzh29";
    private static $dbUserPwd = "Pr9A4kf3Rz"; 

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