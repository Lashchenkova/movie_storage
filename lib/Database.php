<?php

class Database {

    public $db;
    private static $instance;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "moviesdb";

    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        try {
            $this->db = new mysqli($this->host, $this->username, $this->password, $this->database);
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    private function __clone(){}
    private function __wake(){}

    public static function query($sql)
    {
        $obj=self::$instance;
        return $obj->db->query($sql);
    }

}



