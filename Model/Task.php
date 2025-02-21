<?php

namespace Model;

class Task
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addTask($title)
    {
        $query = "INSERT INTO tasks (title) VALUES (:title)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
    }

    public function getAllTasks()
    {
        $query = "SELECT * FROM tasks";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
