<?php
require_once "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email Address";
        require_once "../Auth/login_form.php";
    } else {
        $email = $_POST['email'];
        $check = $conn->query("SELECT * FROM users WHERE email = '$email'")->fetch_assoc();
        $password = $_POST['password'];
    }

    if (password_verify($password, $check['password'])) {
        session_start();
        $_SESSION['data'] = [
            "id" => $check['id'],
            "name" => $check['name'],
            "session_time" => time(),
            "time" => 60*2
        ];
        header("Location: ../index.php");

    } else {
        echo "Invalid Email or Password";
        require_once "../Auth/login_form.php";
    }


}