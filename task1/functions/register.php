<?php
require_once "connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data=[
        "name"=>$_POST['name'],
        "email"=>"",
        "password"=>password_hash($_POST['password'],PASSWORD_DEFAULT)
    ];
    (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ? die("Invalid Email Address") : $data["email"] = $_POST['email'];
    $conn->query("INSERT INTO users (name,email,password) VALUES ('$data[name]','$data[email]','$data[password]')");
    header("Location: ../Auth/login_form.php");
}
