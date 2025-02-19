<?php

class DatabaseConnection
{
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "turkey_challenge";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
?>
