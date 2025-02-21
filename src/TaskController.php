<?php

namespace Controller;

use Model\Task;

class TaskController
{
    private $taskModel;

    public function __construct($pdo)
    {
        $this->taskModel = new Task($pdo);
    }

    public function listTasks()
    {
        return $this->taskModel->getAllTasks();
    }

    public function addTask($title)
    {
        if (!empty($title)) {
            $this->taskModel->addTask($title);
        }
    }

    public function deleteTask($id)
    {
        $this->taskModel->deleteTask($id);
    }
}
