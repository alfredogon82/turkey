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

    public function createTurkey($name, $weight, $age, $status, $color)
    {
        $stmt = $this->conn->prepare("INSERT INTO turkeys (name, weight, age, status, color, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        return $stmt->execute([$name, $weight, $age, $status, $color]);
    }

    public function editTurkey($id, $name, $weight, $age, $status, $color)
    {
        $stmt = $this->conn->prepare("UPDATE turkeys SET name = ?, weight = ?, age = ?, status = ?, color = ? WHERE id = ?");
        $result = $stmt->execute([$name, $weight, $age, $status, $color, $id]);
        return $result;
    }
}
?>
