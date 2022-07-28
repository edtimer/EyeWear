<?php
class db
{
    // Properties
    private $host = 'db-mysql-nyc3-61282-do-user-4807877-0.b.db.ondigitalocean.com';
    private $user = 'doadmin';
    private $password = 'AVNS_UyccxgOPJTkiEGe5Dxe';
    private $dbname = 'defaultdb';
    private $port='25060';

    // Connect
    public function connect()
    {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname,port=$this->port";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}
