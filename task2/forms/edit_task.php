<?php

require_once "../functions/connect.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $task=$conn->query("SELECT * FROM tasks WHERE id=3")->fetch_assoc();
}








?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <form action="../functions/update_task.php" method="post">
        <input type="text" name="name" placeholder="Name" value="<?= $task["name"] ?>">
        <input type="text" name="description" placeholder="Description" value="<?= $task["description"] ?>">
        <input type="datetime-local" name="date" value="<?= $task["date"] ?>">
        <input type="text" name="user_id" placeholder="UserId" value="<?= $task["user_id"] ?>">
        <input type="hidden" name="id" value="<?= $task["id"] ?>">
        <input type="submit" name="submit" value="update">
    </form>
</body>
</html>