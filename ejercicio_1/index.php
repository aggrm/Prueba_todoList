<?php
// Archivo JSON donde se almacenarán las tareas
define('TASKS_FILE', 'tasks.json');

// Función para obtener las tareas del archivo JSON
function getTasks() {
    if (!file_exists(TASKS_FILE)) {
        return [];
    }
    $tasksJson = file_get_contents(TASKS_FILE);
    return json_decode($tasksJson, true);
}

// Función para guardar las tareas en el archivo JSON
function saveTasks($tasks) {
    $tasksJson = json_encode($tasks, JSON_PRETTY_PRINT);
    file_put_contents(TASKS_FILE, $tasksJson);
}

// Función para agregar una nueva tarea
function addTask($title, $description) {
    $tasks = getTasks();
    $id = count($tasks) > 0 ? end($tasks)['id'] + 1 : 1;
    $tasks[] = ['id' => $id, 'title' => $title, 'description' => $description];
    saveTasks($tasks);
}

// Procesar la solicitud para agregar una nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
    addTask($_POST['title'], $_POST['description']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Obtener las tareas para mostrarlas en la página
$tasks = getTasks();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
</head>
<body>
    <h1>Lista de Tareas</h1>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?= htmlspecialchars($task['title']) ?></strong>: <?= htmlspecialchars($task['description']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Agregar Nueva Tarea</h2>
    <form method="post">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required></textarea><br>
        <button type="submit">Agregar Tarea</button>
    </form>
</body>
</html>
