<?php
require_once "../connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email Address";
        require_once "../../Auth/login.html";
        die();
    } else {
        $data=[
            "email"=>$_POST["email"],
            "password"=>$_POST["password"]
        ];
        $user = $conn->query("SELECT * FROM users WHERE email = '{$data["email"]}'")->fetch_assoc();

        if ($user && $data["password"] == $user['password']) {

            $_SESSION['user'] = [
                "id" => $user['id'],
                "name" => $user['name'],
                "permission" => $user['permission'],
                "session_time" => time(),
                "time" => 60*60*24
            ];
            header("Location: ../../index.php");

        } else {
            echo "Invalid Email or Password";
            require_once "../../Auth/login.html";
            die();
        }
    }



}else{header("location:../../index.php");}

