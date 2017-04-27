<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Kasperek
 */
class db
{
    private $dbhost = 'localhost';
    private $dbuser = 'Pay';
    private $dbpass = 'root';
    private $dbname = 'service';

    public function connect()
    {
        $mysql_connection_string = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connection_string, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}
