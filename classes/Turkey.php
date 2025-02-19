<?php
require 'Database.php';

class Turkey
{
    private $conn;
    public $id;
    public $name;
    public $weight;
    public $age;
    public $status;
    public $color;
    public $created_at;

    public function __construct($id = null)
    {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
        if ($id) {
            $this->load($id);
        }
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
        return $stmt->execute([$name, $weight, $age, $status, $color, $id]);
    }

    public function getTurkeyById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM turkeys WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->conn->prepare("UPDATE turkeys SET name = ?, weight = ?, age = ?, status = ?, color = ? WHERE id = ?");
            return $stmt->execute([$this->name, $this->weight, $this->age, $this->status, $this->color, $this->id]);
        } else {
            $stmt = $this->conn->prepare("INSERT INTO turkeys (name, weight, age, status, color, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $result = $stmt->execute([$this->name, $this->weight, $this->age, $this->status, $this->color]);
            if ($result) {
                $this->id = $this->conn->lastInsertId();
            }
            return $result;
        }
    }

    public function load($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM turkeys WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->weight = $data['weight'];
            $this->age = $data['age'];
            $this->status = $data['status'];
            $this->color = $data['color'];
            $this->created_at = $data['created_at'];
        }
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM turkeys WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
