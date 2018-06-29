<?php
namespace Core;
use PDO;
/**
 * Post Model
 * PHP Version 5.6
 */
abstract class Model
{
    /**
     * Get the PDO database conncetion
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;
        if ($db ==null)
        {
            try{
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . 
                       Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
    }
}
return $db;
}
}