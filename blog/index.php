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

$posts= $conn->query("SELECT * FROM posts")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #444;
        }
        .post {
            background: #2a2a2a;
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        .post h3 {
            margin: 0 0 10px;
            color: tomato;
        }
        .post p {
            color: ghostwhite;
        }
        .comment-section {
            margin-top: 15px;
            padding-left: 20px;
        }
        .comment-section p:first-child {
            color: limegreen;
        }
        .comment-section p:nth-child(2) {
            color: #bbb;
            margin: 10px 0;
            padding-left: 10px;
        }
        .comment {
            border-left: 2px solid #1e90ff;
            border-top: 2px solid #1a1a1a;
            padding-left: 10px;
            margin: 10px 0;
            color: #bbb;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
            transition: background 0.3s;
        }
        .btn-admin{
            background: red;
            float: right;
            margin-right: 10px;
        }
        .btn-admin:hover { background: #ff6347; }
        .btn-create { background: #1e90ff;
            margin-left:120px ;
        }
        .btn-create:hover { background: #1c86ee; }
        .btn-edit { background: #4682b4; }
        .btn-edit:hover { background: #4169e1; }
        .btn-delete { background: #ff4500; }
        .btn-delete:hover { background: #ff6347; }
        .btn-comment { background: #32cd32; }
        .btn-comment:hover { background: #228b22; }
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 5px;
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Blog</h1>
            <?php if (!isset($_SESSION['user'])): ?>
            <a href="Auth/login.html" class="btn btn-delete">Login</a>
            <?php endif;?>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="forms/createPost.html" class="btn btn-create">Create Post</a>
                <a href="functions/Auth/logout.php" class="btn btn-delete">Logout</a>
                <?php if($_SESSION['user']['permission']=="admin"): ?>
                    <a href="adminDash.php" class="btn btn-admin">admin Dash</a>
                <?php endif; ?>
            <?php endif; ?>

        </div>
        <?php foreach ($posts as $post): ?>
            <?php $user=$conn->query("SELECT * FROM `users` WHERE `id`= {$post["user_id"]}")->fetch_assoc(); ?>
        <div class="post">
            <h3><?= "{$user["name"]} ({$post["date"]})"; ?></h3>
            <p><?= $post["content"] ?></p>
            <div class="comment-section">
                <?php $comments=$conn->query("SELECT * FROM `comments` WHERE `post_id`={$post["id"]}")->fetch_all(MYSQLI_ASSOC);
                foreach ($comments as $comment): ?>

                <div class="comment">
                    <?php $user=$conn->query("SELECT * FROM `users` WHERE `id`= {$comment["user_id"]}")->fetch_assoc(); ?>
                    <p><?= "{$user["name"]} ({$comment["date"]})" ?></p>
                    <p><?= $comment["content"] ;?></p>
                    <?php if($comment["user_id"]==$user_id || $status=="admin"):?>
                    <a href="functions/comment/deleteComment.php?id=<?= $comment["id"] ?>" class="btn btn-delete">Delete</a>
                    <?php endif; ?>
                </div>
<!--                add comment-->
                <?php endforeach; ?>
                <form method="POST" action="functions/comment/addComment.php">
                    <input type="hidden" name="post_id" value="<?=$post["id"] ?>">
                    <textarea name="content" placeholder="Add a comment..." required></textarea>
                    <button type="submit" class="btn btn-comment">Add Comment</button>
                </form>
            </div>
            <?php if($post["user_id"]==$user_id || $status=="admin"):?>
            <a href="forms/editPost.php?id=<?= $post["id"] ?>" class="btn btn-edit">Edit</a>
            <a href="functions/post/deletePost.php?id=<?= $post["id"] ?>" class="btn btn-delete">Delete</a>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>