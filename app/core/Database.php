<?php

class database
{
    private $host = "localhost";
    private $user = "root";

    private $password = "nizar123";

    private $database = "veillehub";
    public $connection;

    public function __construct()
    {
        $this->connection = new PDO ("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

}