<?php
require_once "functions/connect.php";
session_start();

if(!isset($_SESSION['user'])){
    $status="visitors";
    $user_id=0;
}elseif (isset($_SESSION['user'])){
    if(time()-$_SESSION['user']['session_time'] > $_SESSION['user']['time']){
        session_destroy();
        $status="visitors";
        $user_id=0;
    }else {
        $status = $_SESSION['user']['permission'];
        $user_id = $_SESSION["user"]["id"];
    }
}

$num_posts= $conn->query("SELECT COUNT(*) FROM `posts`")->fetch_assoc();
$num_comments= $conn->query("SELECT COUNT(*) FROM `comments`")->fetch_assoc();
$num_users= $conn->query("SELECT COUNT(*) FROM `users`")->fetch_assoc();
$users= $conn->query("SELECT * FROM `users`")->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Modern Dark Blog</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        .dashboard-container {
            background: #2a2a2a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            width: 900px;
            text-align: center;
        }
        .dashboard-container h2 {
            margin: 0 0 20px;
            color: #fff;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }
        .stat-box {
            background: #1e90ff;
            padding: 15px;
            border-radius: 5px;
            width: 150px;
        }
        .section {
            background: #333;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: left;
        }
        .section h3 {
            color: #ddd;
            margin: 0 0 10px;
        }
        .item {
            padding: 10px;
            border-bottom: 1px solid #444;
            color: #bbb;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            transition: background 0.3s;
        }
        .btn-edit { background: #4682b4; }
        .btn-edit:hover { background: #4169e1; }
        .btn-delete { background: #ff4500; }
        .btn-delete:hover { background: #ff6347; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <div class="stats">
            <div class="stat-box">Posts: <?= $num_posts['COUNT(*)']?></div>
            <div class="stat-box">Comments: <?= $num_comments['COUNT(*)']?></div>
            <div class="stat-box">Users: <?= $num_users['COUNT(*)']?></div>
        </div>
<!--        <div class="section">-->
<!--            <h3>Posts</h3>-->
<!--            <div class="item">Post 1 - <a href="edit_post.php?id=1" class="btn btn-edit">Edit</a> <a href="delete_post.php?id=1" class="btn btn-delete">Delete</a></div>-->
<!--            <div class="item">Post 2 - <a href="edit_post.php?id=2" class="btn btn-edit">Edit</a> <a href="delete_post.php?id=2" class="btn btn-delete">Delete</a></div>-->
<!--        </div>-->
<!--        <div class="section">-->
<!--            <h3>Comments</h3>-->
<!--            <div class="item">Comment 1 on Post 1 - <a href="delete_comment.php?id=1" class="btn btn-delete">Delete</a></div>-->
<!--            <div class="item">Comment 2 on Post 2 - <a href="delete_comment.php?id=2" class="btn btn-delete">Delete</a></div>-->
<!--        </div>-->
        <div class="section">
            <h3>Users</h3>
            <?php foreach ($users as $user):?>
            <div class="item">
                <h4><?= "{$user["name"]} ({$user["permission"]})" ?></h4>
                <a href="forms/editPermission.php?id=<?= $user["id"] ?>" class="btn btn-edit">Edit Role</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>