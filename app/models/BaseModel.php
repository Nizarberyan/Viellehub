<?php
require_once '../../core/Database.php';

abstract class BaseModel
{
    protected $db;
    protected $connection;

    public function __construct()
    {
        $this->db = new database();
        $this->connection = $this->db->connection;
    }

    protected $id;
    protected $email;
    protected $password;
    protected $first_name;
    protected $last_name;
    protected $role;
    protected $status;
    protected $created_at;
    protected $updated_at;



}