<?php
session_start();
require_once "../functions/connect.php";
if ($_SESSION['user']['permission']=="admin"){
    if(isset($_GET['id'])){
        $user_id=$_GET['id'];
        $user=$conn->query("SELECT * FROM `users` WHERE `id`= '{$user_id}'")->fetch_assoc();
    }
}else{
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post - Modern Dark Blog</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .edit-container {
            background: #2a2a2a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            width: 400px;
            text-align: center;
        }
        .edit-container h2 {
            margin: 0 0 20px;
            color: #fff;
        }
        .edit-container input, .edit-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 5px;
            background: #333;
            color: #fff;
        }
        .edit-container button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background: #1e90ff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        .edit-container button:hover {
            background: #1c86ee;
        }
    </style>
</head>
<body>
<div class="edit-container">
    <h2>Edit Post</h2>
    <form method="POST" action="../functions/permission/updatePermission.php">
        <input type="hidden" name="id" value="<?= $user["id"] ?>" >
        <label for="options">Choose permission:</label>
        <select name="permission" id="permission">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>