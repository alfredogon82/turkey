<?php
require 'Database.php';

class Turkey
{
    private $conn;

    public function __construct()
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    public function getAllTurkeys()
    {
        $stmt = $this->conn->prepare("SELECT * FROM turkeys");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
