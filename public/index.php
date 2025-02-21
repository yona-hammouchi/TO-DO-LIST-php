<?php
require_once '../config/Database.php';
require_once '../Model/Task.php';
require_once '../src/TaskController.php';

use Config\Database;
use Controller\TaskController;

$db = new Database();
$pdo = $db->pdo;

$taskController = new TaskController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $taskController->addTask($_POST['task']);
}

if (isset($_GET['delete'])) {
    $taskController->deleteTask($_GET['delete']);
}

$tasks = $taskController->listTasks();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List</title>
    <link rel="stylesheet" href="../public/styles/style.css">
</head>

<body>
    <div class="container">
        <h1 class="title">Ma To-Do List</h1>

        <form action="index.php" method="POST" class="task-form">
            <input type="text" name="task" placeholder="Ajouter une tâche..." required class="task-input">
            <button type="submit" class="add-btn">Ajouter</button>
        </form>

        <ul id="task-list" class="task-list">
            <?php foreach ($tasks as $task): ?>
                <li class="task-item">
                    <span class="task-title"><?php echo htmlspecialchars($task['title']); ?></span>
                    <a href="?delete=<?php echo $task['id']; ?>" class="delete-btn">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="../assets/js/script.js"></script>
</body>


</html>