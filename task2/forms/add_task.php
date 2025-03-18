<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <form action="../functions/add_task.php" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="description" placeholder="Description">
        <input type="datetime-local" name="date" >
        <input type="text" name="user_id" placeholder="UserId">
        <input type="submit" name="submit" value="Add">
    </form>
</body>
</html>