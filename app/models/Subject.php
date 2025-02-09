<?php
require_once '../core/Database.php';

class subject
{
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->connection;
    }
public function CreateSubject(): void
{
        $this->title = $_POST['title'] ?? '';
        $this->description = $_POST['description'] ?? '';
        $this->suggested_by = $_SESSION['user_id'] ?? '';
        $this->resources = $_POST['resources'] ?? '';
        $this->status = 'pending';
       try {
           $sql = "INSERT INTO subjects (title, description, suggested_by, status, resources) VALUES (:title, :description, :suggested_by, :status, :resources)";
           $stmt = $this->connection->prepare($sql);
           $stmt->bindParam(':title', $this->title);
           $stmt->bindParam(':description', $this->description);
           $stmt->bindParam(':suggested_by', $this->suggested_by);
           $stmt->bindParam(':status', $this->status);
           $stmt->bindParam(':resources', $this->resources);
           $stmt->execute();
              header('Location: ../views/subjects/list.php');
       }
         catch (PDOException $e) {
              die("Error: " . $e->getMessage());
         }
    }
    public function renderSubjects()
{
    try {
        $sql = "SELECT s.*, 
                   u.first_name, 
                   u.last_name, 
                   CONCAT(u.first_name, ' ', u.last_name) AS creator_full_name
            FROM subjects s
            LEFT JOIN users u ON s.suggested_by = u.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
}