<?php
class db
{
    // Properties
    private $host = 'eu-cdbr-west-03.cleardb.net';
    private $user = 'b1d147da8a3466';
    private $password = '6bed2433';
    private $dbname = 'heroku_b2d687aa583590a';

    // Connect
    public function connect()
    {
        $mysql_connect_str = "mysql:host=$this->host;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}
