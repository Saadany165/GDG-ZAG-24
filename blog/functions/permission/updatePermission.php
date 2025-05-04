<?php
session_start();
require_once "../connect.php";
if ($_SESSION['user']['permission']=="admin") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['id'];
        $permission = $_POST['permission'];
        $user = $conn->query("UPDATE `users` SET permission = '$permission' WHERE id = '$user_id'");
        if ($user){
            header("location: ../../adminDash.php");
        }else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../index.php");
    }
}else {
    header("Location: ../index.php");
}

?>