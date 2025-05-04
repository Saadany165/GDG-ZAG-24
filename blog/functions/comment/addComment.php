<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (!isset($_SESSION['user'])) {
        header("location:../../Auth/login.html");
    } else {
        require_once "../connect.php";
        $data = [
            "post_id" => $_POST["post_id"],
            "user_id" => $_SESSION["user"]["id"],
            "content" => $_POST["content"],
        ];
        $addComment = $conn->query("INSERT INTO `comments` (`post_id`,`user_id`,`content`) VALUES ('{$data["post_id"]}','{$data["user_id"]}','{$data["content"]}')");
        header("location:../../index.php");

    }
}else{
    header("location:../../index.php");
}