<?php

require_once "functions/connect.php";

$tasks=$conn->query("SELECT * FROM tasks WHERE done= 0")->fetch_all(MYSQLI_ASSOC);
$tasksDone=$conn->query("SELECT * FROM tasks WHERE done= 1")->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>tasks undo</h1>
    <a href="forms/add_task.php">add_task</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>User_id</th>
        <th>Done</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php foreach($tasks as $task): ?>
    <tr>
        <td><?= $task["id"] ?></td>
        <td><?= $task["name"] ?></td>
        <td><?= $task["description"] ?></td>
        <td><?= $task["date"] ?></td>
        <td><?= $task["user_id"] ?></td>
        <td><a href="functions/done.php?id=<?= $task["id"] ?>">Done</a></td>
        <td><a href="forms/edit_task.php?id=<?= $task["id"] ?>">Update</a></td>
        <td><a href="functions/delete_task.php?id= <?= $task["id"] ?>">Delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>

    <h1>tasks done</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>User_id</th>
            <th>Done</th>
        </tr>
        <?php foreach($tasksDone as $task): ?>
            <tr>
                <td><?= $task["id"] ?></td>
                <td><?= $task["name"] ?></td>
                <td><?= $task["description"] ?></td>
                <td><?= $task["date"] ?></td>
                <td><?= $task["user_id"] ?></td>
                <td><?= $task["done"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
