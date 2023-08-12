<?php

/**
 * Database connection made here
 *
 * @todo: move the connection string variables to a ENV file
 */
class Database {

    private string $server = 'db';
    private string $username = 'testdb';
    private string $password = 'testdb';
    private string $db = 'testdb';
    private PDO $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * get connection
     * @return PDO
     */
    public function conn(): PDO
    {
        return $this->conn;
    }

}